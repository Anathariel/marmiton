<?php
class UserModel extends Model {
    public function getAllUsers(){
        $users = [];

        $req = $this->getDb()->query('SELECT `uid`, `username`, `password`, `email`, `favoris`, `joined_date` FROM `user`');

        while ($user = $req->fetch(PDO::FETCH_ASSOC)) {
            $users[] = new Recipe($user);
        }

        $req->closeCursor();
        return $users;
    }

    public function createUser(User $user){
        $username = $user->getUsername();
        $password = $user->getPassword();
        $email = $user->getEmail();

        $req = $this->getDb()->prepare("INSERT INTO `user` (`password`, `username`, `email`) VALUES (:password, :username, :email)");
        $req->bindParam(":password", $password, PDO::PARAM_STR);
        $req->bindParam(":username", $username, PDO::PARAM_STR);
        $req->bindParam(":email", $email, PDO::PARAM_STR);

        $req->execute();

        $req->closeCursor();
    }

    public function getUserByEmail(string $email){
        $req = $this->getDb()->prepare("SELECT `uid`, `username`, `password`, `email`, `favoris`, `joined_date` FROM `user` WHERE `email` = :email");
        $req->bindParam(":email", $email, PDO::PARAM_STR);
        $req->execute();

        return $req->rowCount() === 1 ? new User($req->fetch(PDO::FETCH_ASSOC)) : false;
    }

    public function getUserRecipes(int $userId){
        $recipes = [];

        $req = $this->getDb()->prepare('SELECT `recipe`.`id`, `recipe`.`author`, `recipe`.`title`, `recipe`.`duration`, `recipe`.`thumbnail`, `recipe`.`content`, `recipe`.`created_at`, `user`.`uid`, `user`.`username`, `user`.`email`, `user`.`favoris`, `user`.`joined_date`, `user`.`password`
            FROM `recipe`
            INNER JOIN `user`
            ON `recipe`.`author` = `user`.`uid`
            WHERE `recipe`.`author` = :id');
        $req->bindParam(':id', $userId, PDO::PARAM_INT);
        $req->execute();

        while ($recipeData = $req->fetch(PDO::FETCH_ASSOC)) {
            $recipes[] = new Recipe($recipeData);
        }

        $req->closeCursor();
        return $recipes;
    }
}