<?php
abstract class Controller
{
    private static $loader;
    private static $twig;
    private static $render;

    private static function getLoader()
    {
        if (self::$loader === null) {
            self::$loader = new \Twig\Loader\FilesystemLoader('./view');
        }
        return self::$loader;
    }

    protected static function getTwig()
    {
        if (self::$twig === null) {
            self::$twig = new \Twig\Environment(self::getLoader(), ['cache' => false]);
        }
        return self::$twig;
    }

    protected static function setRender(string $template, $datas)
    {
        global $router;
        //LINKS
        $link = $router->generate('baseRecipe');
        $link2 = $router->generate('baseCats');
        $link3 = $router->generate('baseLog');
        // CATEGORIES
        $categories  = new CategoryModel();
        $cats  = $categories->getAllCategory();

        $new = [
            'cats' => $cats,
            'link' => $link,
            'link2' => $link2,
            'link3' => $link3
        ] + $datas;
        echo self::getTwig()->render($template, $new);
    }

    protected static function getRender($template, $datas)
    {
        if (self::$render === null) {
            self::setRender($template, $datas);
        }
        return self::$render;
    }
}
