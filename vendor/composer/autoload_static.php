<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit6ce55c5520209fa2ef77b2ab89eba454
{
    public static $prefixLengthsPsr4 = array (
        'p' => 
        array (
            'project\\library\\' => 16,
        ),
        'V' => 
        array (
            'Valitron\\' => 9,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'project\\library\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
        'Valitron\\' => 
        array (
            0 => __DIR__ . '/..' . '/vlucas/valitron/src/Valitron',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit6ce55c5520209fa2ef77b2ab89eba454::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit6ce55c5520209fa2ef77b2ab89eba454::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit6ce55c5520209fa2ef77b2ab89eba454::$classMap;

        }, null, ClassLoader::class);
    }
}
