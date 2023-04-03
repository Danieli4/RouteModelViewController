<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit8c2ca7bf11a021a6d506049d15ab4cdd
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
            0 => __DIR__ . '/../..' . '/app',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit8c2ca7bf11a021a6d506049d15ab4cdd::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit8c2ca7bf11a021a6d506049d15ab4cdd::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit8c2ca7bf11a021a6d506049d15ab4cdd::$classMap;

        }, null, ClassLoader::class);
    }
}
