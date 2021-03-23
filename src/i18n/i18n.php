<?php


namespace Core\i18n;


use App\App;
use Core\Config;
use Core\Entity\Entity;

/**
 * Class i18n
 *
 * @package Core\i18n
 */
class i18n
{
    /**
     * @var
     */
    private $session;
    /**
     * @var string
     */
    private $file;
    /**
     * @var string
     */
    private $folder = ROOT . '/i18n/';
    /**
     * @var array|mixed
     */
    private $settings = [];
    /**
     * @var
     */
    private $url;
    /**
     * @var string[]
     */
    private $authorized_language = ['fr', 'en'];

    /**
     * i18n constructor.
     */
    public function __construct ()
    {
        $this->start();
        $this->file = $this->folder . $this->session . '.php';
        $this->settings = require($this->file);
    }

    /**
     * @param $data
     */
    private function setting ($data)
    {
        $this->session = $data;
        $this->url = $_SERVER['REQUEST_URI'] . '?lang=' . $data;
    }

    /**
     * @param string $key
     * @return mixed
     */
    private function getContent(string $key){
        if (!isset($this->settings[$key])) {
            $files = require($this->folder . Config::getInstance()->get('app_default_lang').'.php');
            $content = $files[$key];
        } else {
            $content = $this->settings[$key];
        }
        return $content;
    }

    /***
     *
     */
    private function start ()
    {
        if(isset($_GET['lang']) && $_GET['lang'] != ''){

            $lang = htmlspecialchars(trim($_GET['lang']));

            if(in_array($lang, $this->authorized_language)){
                $_SESSION["lang"] = $lang;
                $this->setting($lang);
            }
            else {
                $this->session = Config::getInstance()->get('app_default_lang');
            }
        }
        elseif(isset($_SESSION["lang"]) && !empty($_SESSION["lang"])){

            if(in_array($_SESSION["lang"], $this->authorized_language)){
                $this->setting($_SESSION['lang']);
            }
            else {
                $this->session = Config::getInstance()->get('app_default_lang');
            }
        }
        else {
            $this->session = Config::getInstance()->get('app_default_lang');
        }
    }

    /**
     * @return mixed
     */
    public function getUrl ()
    {
        $first = explode('?', $this->url);
        return $first[0];
    }

    /**
     * @param $key
     * @return mixed|null
     */
    public function get ($key, $data = null)
    {
        if (isset($data) && $data != null) {
            return str_replace('%s', $data, $this->getContent($key));
        }
        else {
            return str_replace('%s', '', $this->getContent($key));
        }
    }

    /**
     * To get the information from database in term of the selected language
     * @param object $param
     * @param string $champ
     * @return mixed
     */
    public function getData (object $param, string $champ)
    {
        if (isset($_SESSION['lang']) && ($_SESSION['lang']) !== "fr") {
            $champLang = $champ . '_' . $this->session;
            if (array_key_exists($champLang, $param)) {
                return $param->$champLang;
            }
        }
        return $param->$champ;
    }

    /**
     * Function qui permet de recuperer une information en fonction de son ID
     *
     * @param object $param
     * @param string $champ
     * @param string $table
     * @param int    $id
     * @return mixed
     */
    public function getDataFromId (object $param, string $champ, string $table, int $id)
    {
        $entity = new Entity();
        $getting = $entity->nameFromID($table, $id);
        if (isset($_SESSION['lang']) && ($_SESSION['lang']) !== "fr") {
            $champLang = $champ . '_' . $this->session;
            if (array_key_exists($champLang, $getting)) {
                return $getting->$champLang;
            }
        }
        return $getting->$champ;
    }

    /**
     * Specify the field according to the selected language
     * @param $field
     * @return string
     */
    public function getField($field){
        if(isset($_SESSION['lang']) && ($_SESSION['lang']) !== "fr" ){
            return $field.'_'.$this->session;
        }
        return $field;
    }

    /**
     * To put the current language
     * @return mixed
     */
    public function getCurrentLanguage (){
        return $this->session;
    }

    /**
     * @param string $key
     * @param array  $variables
     * @return string|string[]|null
     */
    public function getWithVariable (string $key, $variables = [])
    {
        if (isset($variables) && is_array($variables)) {

            $search = array_keys($variables);
            $replace = array_values($variables);
            $value = str_replace($search, $replace, $this->getContent($key));

            return $value;

        }
        return $this->getContent($key);
    }

}
