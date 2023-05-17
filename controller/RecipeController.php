<?php
class RecipeController extends Controller{
  
    public function getOne($id){
        global $router;
        $model = new RecipeModel();
        $recipe = $model->getOneRecipe($id);

        // CATEGORIES
        $categories  = new CategoryModel();
        $cats  = $categories->getAllCategory();
        
        $link3  = $router->generate('register');
        
        echo self::getTwig()->render('recipe.html.twig',['recipe'=> $recipe,'cats' => $cats,'link' => $link3]);
    }
}