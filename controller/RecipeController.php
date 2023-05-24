<?php
class RecipeController extends Controller
{

    public function getOne($id)
    {

        $model = new RecipeModel();
        $recipe = $model->getOneRecipe($id);

        echo self::getRender('recipe.html.twig', ['recipe' => $recipe]);
    }

    public function createRecipe()
    {
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
}
