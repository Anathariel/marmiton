<?php
class RecipeModel extends Model {

    public function getLastTenRecipes(){
        $recipes = [];

        $req = $this->getDb()->query('SELECT `id`, `author`, `title`, `duration`, `thumbnail`, `content`, `created_at` FROM `recipe` ORDER BY `id` DESC LIMIT 10');

        while($recipe = $req->fetch(PDO::FETCH_ASSOC)){
            $recipes[] = new Recipe($recipe);
        }

        return $recipes;
    }

    public function getOneRecipe(int $id){

        $req = $this->getDb()->prepare('SELECT `id`, `author`, `title`, `duration`, `thumbnail`, `content`, `created_at` FROM `recipe` WHERE `id`= :id');
        $req->bindParam('id',$id,PDO::PARAM_INT);
        $req->execute();

        $recipe = new Recipe($req->fetch(PDO::FETCH_ASSOC));

        return $recipe;
    }

    public function addRecipe (Recipe $recipe){
        $author = $recipe->getAuthor();
        $title = $recipe->getTitle();
        $duration = $recipe->getDuration();
        $content = $recipe->getContent();

        $req = $this->getDb()->prepare('INSERT INTO `recipe`(`author`, `title`, `duration`, `content`) VALUES (:author, :title, :duration, :content)');

        $req->bindParam('author', $author, PDO::PARAM_INT);
        $req->bindParam('title', $title, PDO::PARAM_STR);
        $req->bindParam('duration', $duration, PDO::PARAM_STR);
        $req->bindParam('content', $content, PDO::PARAM_STR);

        $req->execute();
    }
}