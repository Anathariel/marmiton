<?php
session_start();
require_once './vendor/altorouter/altorouter/AltoRouter.php';
require_once './vendor/autoload.php';

$router = new AltoRouter();
$router->setBasePath('/projet/marmiton');


// HOMEPAGE
$router->map('GET', '/', 'HomeController#home', 'home');
// CONTROLLER#ACTION , string
$router->map('GET', '/recipe/', '', 'baseRecipe');
$router->map('GET', '/recipe/[i:id]', 'RecipeController#getOne', '');

$router->map('GET','/category/','','baseCats');
$router->map('GET', '/category/[i:id]', 'CategoryController#getOne', '');

// CATEGORIES
$router->map('GET','/search/','RecipeController#getAll','recipeindex');

// Log-in/out form route
$router->map('GET|POST','/login', 'UserController#login', 'login');
$router->map('GET','/logout', 'UserController#logout', 'logout');
// Register
$router->map('GET|POST','/registration', 'UserController#register', 'register');

// USER
$router->map('GET', '/account', 'RecipeController#getUserRecipe', 'account');

// CRUD RECIPE
$router->map('GET|POST', '/addrecipe', 'RecipeController#createRecipe', 'recipeAdd');

$router->map('GET|POST', '/recipe/edit/[i:id]', 'RecipeController#edit', 'editRecipe');

$router->map('POST|DELETE', '/recipe/delete/[i:id]', 'RecipeController#delete', 'deleteRecipe');


// SEARCH
$router->map('GET|POST', '/search', 'SearchController#searchResult', 'search');

$match = $router->match();
// var_dump($match);

if (is_array($match)) {
    list($controller, $action) = explode('#', $match['target']);
    $obj = new $controller();


    if (is_callable(array($obj, $action))) {
        call_user_func_array(array($obj, $action), $match['params']);
    }
}
