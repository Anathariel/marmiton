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
            echo self::getRender('registration.html.twig', ['link' => $link]);
        }
    }

    public function connection()
    {
        global $router;
        session_start();
        if (isset($_SESSION['connect']) && $_SESSION['connect'] === true) {
            header('Location:' . $router->generate('home'));
        }

        if (isset($_POST['username'], $_POST['password'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];

            $model = new UserModel();
            $user = $model->checklogin();

            if($user){
                $_SESSION['uid'] = $user->getUid();
                $_SESSION['email'] = $user->getEmail();
                $_SESSION['connect'] = true;
                exit();
            }else{
                $message = "L'adresse email ou le mot de passe est incorrect.";
            }
        }
        $linkconnection = $router->generate('connectionPage');
        $linklogout = $router->generate('logout');
        echo self::getRender('inscription.html.twig', ['link' => $linkconnection, 'logout' => $linklogout, 'message' => $message]);
    }

    public function logout()
    {
        session_start();
        if ($_SESSION['connect'] = true) {
            session_destroy(); // Détruire la session

            header('Location: ./');
        }
    }
}
