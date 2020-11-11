<?php

namespace Core\Controller;

use App\App;
use Core\i18n\i18n;

/**
 * Class Controller
 *
 * @package Core\Controller
 */
class Controller {

    /**
     * @var Le chemin qui mene vers le fichier
     */
    protected $viewPath;
    /**
     * @var
     */
    protected $template;

    /**
     * @param $view
     * @param array $variables
     */
    protected function render($view, $variables = []){
        ob_start();
        extract($variables);
        $lang = new i18n();
        require($this->viewPath . str_replace('.', '/', $view) . '.php');
        $content = ob_get_clean();

        $url = explode('.', $view);

        $base = $url['0'];
        $page = $url['1'];


        if($view === 'publics.index'){
            require(ROOT . '/templates/' . $this->template . '-index.php');
        }
        else {

            if($base === 'admins'){
                echo '<meta http-equiv="Cache-control" content="no-cache, no-store, max-age=0, must-revalidate">';
                if($page !== 'login'){
                    $this->Auth()->isNotLogin('a');
                    App::getInstance()->getTable('Admin')->userInfo($_SESSION['authA']);
                    require(ROOT . '/templates/' . $this->template . '-admin.php');
                }
                elseif($page === 'login') {
                    $this->Auth()->isLogin('a');
                    require(ROOT . '/templates/' . $this->template . '-login.php');
                }
                else{
                    $this->Auth()->isLogin('a');
                    require(ROOT . '/templates/' . $this->template . '.php');
                }
            }
            elseif($base === 'users'){ //Si c'est un espace utilisateur
                echo '<meta http-equiv="Cache-control" content="no-cache, no-store, max-age=0, must-revalidate">';
                if($page === 'login') { //Si l'utilisateur accede a la page login
                    $this->Auth()->isLogin('u');
                    require(ROOT . '/templates/' . $this->template . '-login.php');
                }
                elseif($page === 'signup') {
                    $this->Auth()->isLogin('u');
                    require(ROOT . '/templates/' . $this->template . '-login.php');
                }
                elseif($page === 'forgetpw') {
                    $this->Auth()->isLogin('u');
                    require(ROOT . '/templates/' . $this->template . '-login.php');
                }
                elseif($page === 'forgetactivate') {
                    $this->Auth()->isLogin('u');
                    require(ROOT . '/templates/' . $this->template . '-login.php');
                }
                elseif($page !== 'login'){ //Si la personne accede a une autre page user a par la page login
                    $this->Auth()->isNotLogin('u');
                    //App::getInstance()->getTable('User')->userInfo($_SESSION['authU'], 'profils');
                    require(ROOT . '/templates/' . $this->template . '-users.php');
                }
                else{
                    $this->Auth()->isLogin('u');
                    require(ROOT . '/templates/' . $this->template . '.php');
                }
            }
            else {
                require(ROOT . '/templates/' . $this->template . '.php');
            }

        }

    }

    /**
     * @param $url
     */
    public function redirection($url){
        header('Location: '.$url);
        exit();
    }

    /**
     * renvoie une errreur 403 si l'acces à la page est interdit
     */
    protected function forbidden(){
        header('HTTP/1.0 403 Forbidden');
        die('Acces interdit');
    }

    /**
     * Renvoie l'erreur 404 si la page n'est pas trouvée
     */
    public function notfound(){
        header("HTTP/1.0 404 Not Found");
        $url = App::getInstance()->app_info('app_url').'/404';
        $this->redirection($url);
    }

    /**
     * @param $data : Le texte à transformer en lien
     * @return string : Le slug
     */
    public function slug($data) {

        $data = str_replace("'", " ", $data);
        $data = str_replace("(", "", $data);
        $data = str_replace(")", "", $data);
        $data = str_replace("[", "", $data);
        $data = str_replace("]", "", $data);
        $data = str_replace("/", "", $data);
        $data = str_replace("\\", "", $data);
        $data = str_replace("?", "", $data);
        $data = str_replace("_", "", $data);
        $data = str_replace("-", "", $data);
        $data = str_replace("&", "", $data);
        $data = str_replace("~", "", $data);
        $data = str_replace("#", "", $data);
        $data = str_replace("{", "", $data);
        $data = str_replace("}", "", $data);
        $data = str_replace("|", "", $data);
        $data = str_replace("`", "", $data);
        $data = str_replace("^", "", $data);
        $data = str_replace("€", "", $data);
        $data = str_replace("@", "", $data);
        $data = str_replace(",", "", $data);
        $data = str_replace(":", "", $data);
        $data = str_replace(".", "", $data);
        $data = str_replace("!", "", $data);
        $data = str_replace("§", "", $data);

        $data = htmlentities($data, ENT_NOQUOTES, 'utf-8', false);
        $data = strtr($data, 'ÁÀÂÄÃÅÇÉÈÊËÍÏÎÌÑÓÒÔÖÕÚÙÛÜÝ', 'AAAAAACEEEEEIIIINOOOOOUUUUY');
        $data = strtr($data, 'áàâäãåçéèêëíìîïñóòôöõúùûüýÿ', 'aaaaaaceeeeiiiinooooouuuuyy');

        $data = preg_replace('#&([A-za-z])(?:acute|cedil|caron|circ|grave|orn|ring|slash|th|tilde|uml);#', '\1', $data);
        $data = preg_replace('#&([A-za-z]{2})(?:lig);#', '\1', $data);
        $data = preg_replace('#&[^;]+;#', '', $data);
        $data = preg_replace('#[;.,!-:]#', '', $data);

        $data = explode(' ', $data);
        $data = array_filter($data);
        $data = implode('-', $data);
        $lien = strtolower($data);

        if (empty($lien)) {
            return 'eida-consulting';
        }

        return $lien;
    }

    /**
     * @param $message
     * @param string $type
     */
    public function alertDefine($message, $type = 'info'){
        $_SESSION['notification']['message'] = $message;
        $_SESSION['notification']['type'] = $type;
    }

    /**
     * @param array $array
     */
    protected function MyArrayMap($array = [], $function){
        $get = array_map($array, $function);
        return $get;
    }

    /**
     * Permet d'entourer les varible avec la fonction HTMLSPECIALCHARS
     * @param $get : Information à sécuriser
     */
    protected function secureData(array $get = []): array
    {
        foreach ($get AS $k => $v){
            $type[$k] = htmlspecialchars($v, ENT_QUOTES, 'UTF-8');
        }
        return $type;
    }



    /**
     * Fonction de deconnexion des utilisateurs
     * @param string $type : Permet de definir le type d'utilisateur (user|admin)
     */
    public function sign_out($type = 'u') {
        $session = 'auth'.ucfirst($type);
        unset($_SESSION[$type]);
        unset($_SESSION[$session]);
        unset($_SESSION['user_token']);
        $url = App::getInstance()->app_info('app_url');
        $this->redirection($url);
    }

    /**
     * Function qui permet de faire le var_dump d'une information. Evite d'ecrire le var_dump
     * et de faire encore un die() ensuite.
     * @param array $datas : Les paramètre qui doit être un tableau standard [$valeur]
     *                     quand il s'agit de plusieurs valeurs, il faut les séparer d'une
     *                     virgule [$valeur1, $valeur2, ...]
     */
    static function dd($datas){
        if(is_array($datas) && count($datas) > 0){
            echo '<pre>';
            foreach ($datas as $key => $data){
                if(is_array($data)){
                    echo print_r($data);
                }
                else {
                    var_dump($key, $data);
                }
            }
            echo '</pre>';
        }
        else {
            var_dump($datas);
        }

        die();
    }

}
