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
            self::$twig = new \Twig\Environment(self::getLoader());
            self::$twig->addGlobal('session', $_SESSION);
            self::$twig->addGlobal('get', $_GET);

        }
        return self::$twig;
    }

    protected static function setRender(string $template, $datas){
        global $router;

        //LINKS
        $oneRecipe = $router->generate('baseRecipe');
        $categorieslink = $router->generate('baseCats');
        $login = $router->generate('login');
        $register = $router->generate('register');
        $logout = $router->generate('logout');
        $home = $router->generate('home');

        // CATEGORIES
        $categories  = new CategoryModel();
        $cats  = $categories->getAllCategory();

        $new = [
            'home' => $home,
            'cats' => $cats,
            'oneRecipe' => $oneRecipe,
            'categorieslink' => $categorieslink,
            'login' => $login,
            'register' => $register,
            'logout' => $logout
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
