<?php
abstract class Controller
{
    private static $loader;
    private static $twig;

    private static function setLoader()
    {
        self::$loader = new \Twig\Loader\FilesystemLoader('./view');
    }

    private static function setTwig()
    {
        self::$twig = new \Twig\Environment(self::getLoader(), ['cache' => false,]);
    }

    protected static function getLoader()
    {
        if (self::$loader === null) {
            self::setLoader();
        }
        return self::$loader;
    }

    protected static function getTwig()
    {
        if (self::$twig === null) {
            self::setTwig();
        }
        return self::$twig;
    }
}

