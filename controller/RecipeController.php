<?php
class RecipeController extends Controller{
  
    public function getOne($id){
        
        $model = new RecipeModel();
        $recipe = $model->getOneRecipe($id);

        echo self::getRender('recipe.html.twig',['recipe' => $recipe]);
    }
}