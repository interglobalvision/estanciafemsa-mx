<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitc10ee43a81896320bade805088a5a080
{
    public static $prefixLengthsPsr4 = array (
        'M' => 
        array (
            'Moment\\' => 7,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Moment\\' => 
        array (
            0 => __DIR__ . '/..' . '/fightbulc/moment/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitc10ee43a81896320bade805088a5a080::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitc10ee43a81896320bade805088a5a080::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
