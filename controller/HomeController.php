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

        // LINK
        $link = $router->generate('baseRecipe');
        $link2 = $router->generate('baseCats');
        $link3 = $router->generate('register');

        // Render the homepage template with data
        echo self::getTwig()->render('homepage.html.twig', [
            'recipes' => $recipes,
            'cats' => $cats,
            'users' => $users,

            'link' => $link,
            'link2' => $link2,
            'link3' => $link3
        ]);
    }
}
