<?php
class UserController extends Controller
{
    public function register()
    {
        $model = new UserModel();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $rawPass = $_POST['password'];
            $password = password_hash($rawPass, PASSWORD_DEFAULT);
            $email = filter_var($_POST["email"], FILTER_VALIDATE_EMAIL);

            $userData = new User([
                'username' => $username,
                'password' => $password,
                'email' => $email
            ]);

            $user = ($userData);
            $result = $model->createUser($user);

            global $router;
            header('Location:' . $router->generate('home'));
            exit();
        } else {
            global $router;
            $link = $router->generate('baseLog');
            echo self::getRender('registration.html.twig',['link' => $link]);
        }
    }
}
