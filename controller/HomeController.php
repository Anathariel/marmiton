<?php

class HomeController extends Controller
{
    public function home()
    {
        // RECIPES
        $recipeModel = new RecipeModel();
        $recipes = $recipeModel->getLastTenRecipes();

        echo self::getRender('homepage.html.twig',['recipes' => $recipes]);
    }
}
