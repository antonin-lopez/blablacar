<?php
require_once ROOT . '/app/model/UserModel.php';

class LoginController
{
    public static function login($args = [])
    {
        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $login = $_POST['login'] ?? '';
            $password = $_POST['password'] ?? '';

            try {
                $user = UserModel::verifyCredentials($login, $password);

                if ($user) {
                    $_SESSION['user_id']    = $user->getId();
                    $_SESSION['last_name']  = $user->getLastName();
                    $_SESSION['first_name'] = $user->getFirstName();
                    $_SESSION['user_role']  = $user->getRole();
                    $_SESSION['balance']    = $user->getBalance();

                    header('Location: index.php?controller=home&action=home');
                    exit();
                } else {
                    $errors[] = 'Identifiant ou mot de passe incorrect.';
                }
            } catch (Exception $e) {
                $errors[] = $e->getMessage();
            }
        }

        require ROOT . '/app/view/login/viewLogin.php';
    }

    public static function logout($args = [])
    {
        session_destroy();
        header('Location: index.php?controller=home&action=home');
        exit();
    }
}