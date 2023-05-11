<?php
class RecipeModel extends Model {
    public function getLastTenRecipes(){
        $recipes = [];

        $req = $this->getDb()->query('SELECT `id`, `id_user`, `title`, `duration`, `img`, `content`, `created_at` FROM `recipe` ORDER BY `id` DESC LIMIT 10');

        while($recipe = $req->fetch(PDO::FETCH_ASSOC)){
            $recipes[] = new Recipe($recipe);
        }

        $req->closeCursor();
        return $recipes;
    }

    public function getOneRecipe(int $id){

        $req = $this->getDb()->prepare('SELECT `id`, `id_user`, `title`, `duration`, `img`, `content`, `created_at` FROM `recipe` WHERE `id`= :id');
        $req->bindParam('id',$id,PDO::PARAM_INT);
        $req->execute();

        $recipe = new Recipe($req->fetch(PDO::FETCH_ASSOC));
        
        $req->closeCursor();
        return $recipe;
    }
}