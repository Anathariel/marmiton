<?php
abstract class Controller
{
    private static $loader;
    private static $twig;

    private static function getLoader() {
        if (self::$loader === null) {
            self::$loader = new \Twig\Loader\FilesystemLoader('./view');
        }
        return self::$loader;
    }

    protected static function getTwig(){
        if (self::$twig === null) {
            self::$twig = new \Twig\Environment(self::getLoader(), ['cache' => false]);
        }
        return self::$twig;
    }
}
