<?php

namespace Core;

class Config
{
    private static $_instance;
    private static $file = ROOT . '/config/config.php';
    private $settings = [];

    public function __construct ()
    {
        $this->settings = require(self::$file);
    }

    public static function getInstance ()
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new Config(self::$file);
        }

        return self::$_instance;
    }

    public function get ($key)
    {
        if (!isset($this->settings[$key])) {
            return null;
        }

        return $this->settings[$key];
    }

}