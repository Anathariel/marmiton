<?php
class RecipeController extends Controller {

    public function getOne($id){
        global $router;
        $model = new RecipeModel();
        $recipe = $model->getOneRecipe($id);
        $oneRecipe = $router->generate('baseRecipe');
        echo self::getRender('recipe.html.twig', ['recipe' => $recipe, 'oneRecipe' => $oneRecipe]);
    }

    public function getAll(){
        global $router;
        $model = new RecipeModel();
        $recipes = $model->getAllRecipes();

        $recipeindex = $router->generate('recipeindex');
        echo self::getRender('recipeindex.html.twig', ['recipes' => $recipes, 'recipeindex' => $recipeindex]);
    }

    public function getUserRecipe(){
        if ($_SESSION['connect']) {
            $userId = $_SESSION['uid'];
    
            $model = new RecipeModel();
            $userRecipes = $model->getUserRecipes($userId);
    
            global $router;
            echo self::getRender('account.html.twig', ['userRecipes' => $userRecipes, 'router' => $router]);
        }
}

    // C R U D
    public function createRecipe(){
        global $router;
        if (!$_POST) {
            echo self::getRender('addrecipe.html.twig', []);
        } else {
            if (isset($_POST['submit'])) {
                $title = $_POST['title'];
                $duration = $_POST['duration'];
                $content = $_POST['content'];
                $author = $_SESSION['uid'];

                $recipe = new Recipe([
                    'title' => $title,
                    'duration' => $duration,
                    'content' => $content,
                    'author' => $author,
                ]);

                $model = new RecipeModel();
                $model->addRecipe($recipe);
                header('Location: ' . $router->generate('account'));
            } else {
                $message = 'Oops, something went wrong sorry. Try again later';
                echo self::getrender('addrecipe.html.twig', ['message' => $message]);
            }
        }
    }

    public function edit(int $id){
    $model = new RecipeModel();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $title = $_POST['title'];
        $duration = $_POST['duration'];
        $content = $_POST['content'];

            $recipe = new Recipe([
                'id' => $id,
                'title' => $title,
                'duration' => $duration,
                'content' => $content
            ]);

            $model->editRecipe($recipe);

            global $router;
            header('Location: ' . $router->generate('account'));
            exit();
        
    }

    $recipe = $model->getOneRecipe($id);
    
    global $router;
    echo self::getRender('editRecipe.html.twig', ['recipe' => $recipe, 'router' => $router, 'message' => $message ?? '']);
}    

    public function delete(int $id) {
        if($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['_method'] === 'DELETE') {
            $model = new RecipeModel();
            $model->deleteRecipe($id);
    
            global $router;
            header('Location: ' . $router->generate('account'));
        }
    }    
}