<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit5b71b583dd2f56e8cdcdf11b562ca748
{
    public static $prefixLengthsPsr4 = array (
        'M' => 
        array (
            'Modules\\' => 8,
        ),
        'G' => 
        array (
            'Global\\' => 7,
        ),
        'C' => 
        array (
            'Core\\' => 5,
        ),
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Modules\\' => 
        array (
            0 => __DIR__ . '/../..' . '/modules',
        ),
        'Global\\' => 
        array (
            0 => __DIR__ . '/../..' . '/global',
        ),
        'Core\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit5b71b583dd2f56e8cdcdf11b562ca748::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit5b71b583dd2f56e8cdcdf11b562ca748::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
