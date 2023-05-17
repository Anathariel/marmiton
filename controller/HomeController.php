<?php

class HomeController extends Controller
{
    public function home()
    {
        global $router;
        // RECIPES
        $recipeModel = new RecipeModel();
        $recipes = $recipeModel->getLastTenRecipes();

        // CATEGORIES
        $categories  = new CategoryModel();
        $cats  = $categories->getAllCategory();

        // USERS
        $userModel = new UserModel();
        $users = $userModel->getAllUsers();

        // Render the homepage template with data
        echo self::getRender('homepage.html.twig',['recipes' => $recipes, 'users' => $users]);
    }
}
