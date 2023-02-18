<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitadd797a7c09b4b9065f4c04cd777683f
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'PHPMailer\\PHPMailer\\' => 20,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'PHPMailer\\PHPMailer\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpmailer/phpmailer/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitadd797a7c09b4b9065f4c04cd777683f::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitadd797a7c09b4b9065f4c04cd777683f::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitadd797a7c09b4b9065f4c04cd777683f::$classMap;

        }, null, ClassLoader::class);
    }
}
