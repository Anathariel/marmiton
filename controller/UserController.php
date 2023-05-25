<?php
class UserController extends Controller {
    public function register(){
        global $router;
        $model = new UserModel();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $rawPass = $_POST['password'];
            $password = password_hash($rawPass, PASSWORD_DEFAULT);
            $email = filter_var($_POST["email"], FILTER_VALIDATE_EMAIL);

            $user = new User([
                'username' => $username,
                'password' => $password,
                'email' => $email
            ]);

            $model->createUser($user);
            header('Location: ' . $router->generate('login'));
        } else {
            echo self::getRender('registration.html.twig', []);
        }
    }

    public function login(){
        if (!$_POST) {
            echo self::getRender('login.html.twig', []);
        } else {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $model = new UserModel();
            $user = $model->getUserByEmail($email);

            if ($user) {
                if (password_verify($password, $user->getPassword())) {
                    $_SESSION['uid'] = $user->getUid();
                    $_SESSION['username'] = $user->getUsername();
                    $_SESSION['connect'] = true;

                    echo self::getRender('account.html.twig', []);
                } else {
                    echo 'ECLATAX';
                }
            } else {
                $message = "Email / mot de passe incorrect !";
                echo self::getRender('login.html.twig', ['message' => $message]);
            }
        }
    }

    public function logout(){
        session_start();
        session_destroy();

        global $router;
        header('Location: ' . $router->generate('home'));
        exit();
    }

    public function account(){
        if ($_SESSION['connect']) {
            $userId = $_SESSION['uid'];

            $model = new UserModel();
            $userRecipes = $model->getUserRecipes($userId);

            echo self::getRender('account.html.twig', ['userRecipes' => $userRecipes]);
        } else {
            // Redirect to login page if not logged in
            global $router;
            header('Location: ' . $router->generate('login'));
            exit();
        }
    }
}