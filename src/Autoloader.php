<?php

namespace Core;

class Autoloader
{

    static function register ()
    {
        spl_autoload_register([__CLASS__, 'autoload']);
    }

    static function autoload ($class)
    {
        if (strpos($class, __NAMESPACE__ . '\\') === 0) {
            //Sup primer le name space en le remplacant par du vide
            $class = str_replace(__NAMESPACE__ . '\\', '', $class);
            //Remplacer les \ par des /
            $class = str_replace('\\', '/', $class);
            //Charger la class correspondante
            require __DIR__ . '/' . $class . '.php';
        }
    }
}