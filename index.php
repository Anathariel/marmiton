<?php
session_start();
require_once './vendor/altorouter/altorouter/AltoRouter.php';
require_once './vendor/autoload.php';

$router = new AltoRouter();
$router->setBasePath('/projets/marmiton');



// CONTROLLER#ACTION , string
$router->map('GET', '/', 'HomeController#home', 'home');

// Rewrite URLs
$router->map('GET', '/recipe/', '', 'baseRecipe');
$router->map('GET', '/recipe/[i:id]', 'RecipeController#getOne', '');
$router->map('GET','/category/','','baseCats');

// Log-in/out form route
$router->map('GET|POST','/login', 'UserController#login', 'login');
$router->map('GET','/logout', 'UserController#logout', 'logout');
// Register
$router->map('GET|POST','/registration', 'UserController#register', 'register');



// User Account
// $router->map('GET','/account', 'UserController#login', 'account');



$match = $router->match();
// var_dump($match);

if (is_array($match)) {
    list($controller, $action) = explode('#', $match['target']);
    $obj = new $controller();


    if (is_callable(array($obj, $action))) {
        call_user_func_array(array($obj, $action), $match['params']);
    }
}
