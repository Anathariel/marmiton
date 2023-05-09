<?php
class RecipeController {

    private static function getTwig(){
        static $twig = null;
        if($twig === null){
            $loader = new \Twig\Loader\FilesystemLoader('./view');
            $twig = new \Twig\Environment($loader, ['cache' => false,]);
        }
        return $twig;
    }

    public function homePage(){
        global $router;
        $model = new RecipeModel();
        $datas = $model->getLastTenRecipes();

        $twig = self::getTwig();

    $link = $router->generate('baseRecipe');
    echo $twig->render('homepage.html.twig',['recipes'=> $datas, 'link' => $link]);
    }

    public function getOne($id){
        $model = new RecipeModel();
        $recipe = $model->getOneRecipe($id);
    
        $twig = self::getTwig();
    
        echo $twig->render('recipe.html.twig',['recipe'=> $recipe]);
    }    
}