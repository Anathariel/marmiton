<?php
class UserModel extends Model
{
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
        
        // Prepare the SQL query
        $query = $this->getDb()->prepare('INSERT INTO `user`(`username`, `password`, `email`) VALUES (:username, :password, :email)');

        // Bind the values to the parameters
        $query->bindValue(':username', $username, PDO::PARAM_STR);
        $query->bindValue(':password', $password, PDO::PARAM_STR);
        $query->bindValue(':email', $email, PDO::PARAM_STR);

        // Execute the query
        $query->execute();
    }

    public function checklogin(){
        $username = $_POST['username'];
        $password = $_POST['password'];

        $query = $this->getDb()->prepare('SELECT `uid`, `username`, `password`, `email`, `favoris`, `joined_date` FROM `user` WHERE `username` = :username AND `password` = :password');

        $query->bindValue(':username', $username, PDO::PARAM_STR);
        $query->bindValue(':password', $password, PDO::PARAM_STR);
        $query->execute();

        $user = $query->fetch(PDO::FETCH_OBJ);

        return $user;
    }
}
