<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit22d10f8989bdc483ca089ad7b439b3f4
{
    public static $files = array (
        'a5f882d89ab791a139cd2d37e50cdd80' => __DIR__ . '/..' . '/tgmpa/tgm-plugin-activation/class-tgm-plugin-activation.php',
        'fa030fcbe095b60414acb64498d5ab4b' => __DIR__ . '/../..' . '/inc/helpers/constant.php',
        '96d8a4eeb862d38908665952c9c235b8' => __DIR__ . '/../..' . '/inc/helpers/conditional.php',
        '9557542ad22adf48095da603ad1a1a78' => __DIR__ . '/../..' . '/inc/helpers/template-tags.php',
        'c39e5e966364f845b8dc03db0a1c135c' => __DIR__ . '/..' . '/aristath/kirki/kirki.php',
    );

    public static $prefixLengthsPsr4 = array (
        'w' => 
        array (
            'wpcmart\\' => 8,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'wpcmart\\' => 
        array (
            0 => __DIR__ . '/../..' . '/inc',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit22d10f8989bdc483ca089ad7b439b3f4::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit22d10f8989bdc483ca089ad7b439b3f4::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit22d10f8989bdc483ca089ad7b439b3f4::$classMap;

        }, null, ClassLoader::class);
    }
}