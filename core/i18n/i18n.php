<?php


namespace Core\i18n;


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
    public function __construct()
    {
        $this->start();
        $this->file = $this->folder.$this->session.'.php';
        $this->settings = require($this->file);
    }

    /***
     *
     */
    private function start(){
        if(isset($_GET['lang']) && !empty($_GET['lang'])){
            $_SESSION["lang"] = $_GET['lang'];
            $this->setting($_GET['lang']);
        }
        elseif(isset($_SESSION["lang"]) && !empty($_SESSION["lang"])){
            $this->setting($_SESSION['lang']);
        }
        else {
            $this->session = 'fr';
        }
    }

    /**
     * @param $data
     */
    private function setting($data){
        $this->session = $data;
        $this->url = $_SERVER['REQUEST_URI'].'?lang='.$data;
    }

    /**
     * @return mixed
     */
    public function getUrl(){
        $first = explode('?', $this->url);

        return $first[0];
    }


    /**
     * @param $key
     * @return mixed|null
     */
    public function get($key, $data = null)
    {
        if (!isset($this->settings[$key])) {
            $datas = require($this->folder.'fr.php');
            $value = $datas[$key];
        }
        else {
            $value = $this->settings[$key];

            if(isset($data) && $data != null){
                $value = str_replace('%s', $data, $value);
            }
        }

        return $value;
    }

}