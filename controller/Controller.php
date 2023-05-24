<?php
abstract class Controller{
    private static $loader;
    private static $twig;
    private static $render;

    private static function getLoader(){
        if (self::$loader === null) {
            self::$loader = new \Twig\Loader\FilesystemLoader('./view');
        }
        return self::$loader;
    }

    protected static function getTwig(){
        if (self::$twig === null) {
            $loader = self::getLoader();
            self::$twig = new \Twig\Environment($loader);
            self::$twig->addGlobal('session', $_SESSION);
            self::$twig->addGlobal('get', $_GET);

            // Add the path function to Twig environment
            self::$twig->addFunction(new \Twig\TwigFunction('path', function ($routeName) {
                global $router;
                return $router->generate($routeName);
            }));
        }
        return self::$twig;
    }

    protected static function setRender(string $template, $datas){

        global $router;

        //LINKS
        $oneRecipe = $router->generate('baseRecipe');
        $categorieslink = $router->generate('baseCats');

        // CATEGORIES
        $categories  = new CategoryModel();
        $cats  = $categories->getAllCategory();

        // LINKS TABLE + NEW ONES
        $new = [
            'cats' => $cats,
            'oneRecipe' => $oneRecipe,
            'categorieslink' => $categorieslink,
        ] + $datas;
        
        echo self::getTwig()->render($template, $new);
    }

    protected static function getRender($template, $datas){
        if (self::$render === null) {
            self::setRender($template, $datas);
        }
        return self::$render;
    }
}
