<?php
class UserController extends Controller
{
    public function showAll()
    {
        // logic for fetching users from the database
        $model = new UserModel();
        $users = $model->getAllUsers();

        echo self::getTwig()->render('homepage.html.twig',['users' => $users]);
    }

    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $email = $_POST['email'];

            $userController = new UserController();
            $userController->register($username, $password, $email);

            $userModel = new UserModel();
            $userModel->createUser($username, $email, $password);
        } else {
            global $router;
            $categories  = new CategoryModel();
            $cats  = $categories->getAllCategory();
            $link3  = $router->generate('register');
        echo self::getTwig()->render('registration.html.twig',['cats' => $cats,'link' => $link3]);
        }
    }
}
