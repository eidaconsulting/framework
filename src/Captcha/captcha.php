<?php

namespace Core\Captcha;

use Core\Config;

class captcha
{

    protected $site_key;

    protected $secret_key;

    protected $instance;

    protected $reponse;

    protected $remoteip;

    protected $decode;

    public function __construct ()
    {
        $this->instance = new Config();
        $this->site_key = $this->instance->get('captcha_site_key');
        $this->secret_key = $this->instance->get('captcha_secret_key');
        $this->reponse = $_POST['g-recaptcha-response'];
        $this->remoteip = $_SERVER['REMOTE_ADDR'];
    }

    protected function constuct_url ()
    {
        $url = "https://www.google.com/recaptcha/api/siteverify?secret="
            . $this->secret_key
            . "&response=" . $this->reponse
            . "&remoteip=" . $this->remoteip;

        return json_decode(file_get_contents($url), true);
    }

    public function verif_captcha ()
    {
        return $this->constuct_url()['success'];
    }


}