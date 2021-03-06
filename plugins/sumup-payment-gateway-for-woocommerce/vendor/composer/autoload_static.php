<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitf6f592c1a0ca979f934bfe5c114d2ae3
{
    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'SumUp\\' => 6,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'SumUp\\' => 
        array (
            0 => __DIR__ . '/..' . '/sumup/sumup-ecom-php-sdk/src/SumUp',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitf6f592c1a0ca979f934bfe5c114d2ae3::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitf6f592c1a0ca979f934bfe5c114d2ae3::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
