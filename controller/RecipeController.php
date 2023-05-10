<?php
class RecipeController extends Controller{
    public function homepage(){
        $model = new RecipeModel();
        $datas = $model->getLastTenRecipes();
        echo self::getTwig()->render('homepage.html.twig',['recipes' => $datas]);
    }
    
    public function getOne($id){
        $model = new RecipeModel();
        $datas = $model->getOneRecipe($id);
        echo self::getTwig()->render('recipe.html.twig',['recipe'=> $datas]);
    } 
}