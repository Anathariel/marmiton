<?php
session_start();
require_once './vendor/altorouter/altorouter/AltoRouter.php';
require_once './vendor/autoload.php';

$router = new AltoRouter();
$router->setBasePath('/projets/marmiton');


// HOMEPAGE
$router->map('GET', '/', 'HomeController#home', 'home');
// CONTROLLER#ACTION , string
$router->map('GET', '/recipe/', '', 'baseRecipe');
$router->map('GET', '/recipe/[i:id]', 'RecipeController#getOne', '');
$router->map('GET','/category/','','baseCats');

// CATEGORIES
$router->map('GET','/search/','RecipeController#getAll','recipeindex');


// Log-in/out form route
$router->map('GET|POST','/login', 'UserController#login', 'login');
$router->map('GET','/logout', 'UserController#logout', 'logout');
// Register
$router->map('GET|POST','/registration', 'UserController#register', 'register');

// USER
$router->map('GET', '/account', 'UserController#account', 'account');

// CRUD RECIPE
$router->map('GET|POST', '/addrecipe', 'RecipeController#createRecipe', 'recipeAdd');

// SEARCH
$router->map('GET', '/search', 'SearchController#searchrecipe', 'search');


$match = $router->match();
// var_dump($match);

if (is_array($match)) {
    list($controller, $action) = explode('#', $match['target']);
    $obj = new $controller();


    if (is_callable(array($obj, $action))) {
        call_user_func_array(array($obj, $action), $match['params']);
    }
}
