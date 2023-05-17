<?php
class UserModel extends Model {
public function getAllUsers(){
    $users = [];

    $req = $this->getDb()->query('SELECT `uid`, `username`, `password`, `email`, `favoris`, `joined_date` FROM `user`');

        while($user = $req->fetch(PDO::FETCH_ASSOC)){
            $users[] = new Recipe($user);
        }

        $req->closeCursor();
        return $users;
}

public function createUser($username, $email, $password) {
    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Prepare the SQL query
    $query = 'INSERT INTO `user`(`username`, `password`, `email`, `joined_date`) VALUES (:username, :password, :email, NOW())';
    $stmt = $this->getDb()->prepare($query);

    // Bind the values to the parameters
    $stmt->bindValue(':username', $username, PDO::PARAM_STR);
    $stmt->bindValue(':password', $hashedPassword, PDO::PARAM_STR);
    $stmt->bindValue(':email', $email, PDO::PARAM_STR);

    // Execute the query
    $stmt->execute();
}
}