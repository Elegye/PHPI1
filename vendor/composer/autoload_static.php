<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit9af83736d495f773c9aa9b0bbe9a45ce
{
    public static $prefixLengthsPsr4 = array (
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit9af83736d495f773c9aa9b0bbe9a45ce::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit9af83736d495f773c9aa9b0bbe9a45ce::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}