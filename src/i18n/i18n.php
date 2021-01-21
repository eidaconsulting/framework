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
     * i18n constructor.
     */
    public function __construct ()
    {
        $this->start();
        $this->file = $this->folder . $this->session . '.php';
        $this->settings = require($this->file);
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
        if (!isset($this->settings[$key])) {
            $datas = require($this->folder . 'fr.php');
            $value = $datas[$key];
        } else {
            $value = $this->settings[$key];
        }

        if (isset($data) && $data != null) {
            $value = str_replace('%s', $data, $value);
        }
        else {
            $value = str_replace('%s', '', $value);
        }

        return $value;
    }

    private function getDefaultLanguage(){
        return Config::getInstance()->get('app_default_lang');
    }

    /***
     *
     */
    private function start ()
    {

        if (isset($_GET['lang']) && !empty($_GET['lang'])) {
            $_SESSION["lang"] = $_GET['lang'];
            $this->setting($_GET['lang']);
        } elseif (isset($_SESSION["lang"]) && !empty($_SESSION["lang"])) {
            $this->setting($_SESSION['lang']);
        } else {
            $this->session = App::getInstance()->app_info('app_default_lang');
        }
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

}
