<?php
require_once './vendor/altorouter/altorouter/AltoRouter.php';
require_once './vendor/autoload.php';

$router = new AltoRouter();
$router->setBasePath('/projets/marmiton');


// map users details page using controller#action string
// EXEMPLE :
$router->map( 'GET', '/', 'RecipeController#homepage', 'home' );
$router->map('GET', '/[i:id]', 'RecipeController#getOne', 'recipe');

$match = $router->match();

if (is_array($match)) {
    list($controller, $action) = explode('#', $match['target']);
    $obj = new $controller();


    if (is_callable(array($obj, $action))) {
        call_user_func_array(array($obj, $action), $match['params']);
    }
}