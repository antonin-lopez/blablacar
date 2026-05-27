<?php
require_once ROOT . '/app/model/UserModel.php';

class UserController
{
    public static function index($args)
    {
        if ($_SESSION['user_role'] !== 'admin') {
            header('Location: index.php?controller=home&action=home');
            exit();
        }

        $users = UserModel::readAll();

        require_once ROOT . '/app/view/user/viewAll.php';
    }

    public static function create($args)
    {
        if ($_SESSION['user_role'] !== 'admin') {
            header('Location: index.php?controller=home&action=home');
            exit();
        }

        $errors = [];
        $roleNewUser = $_POST['role'] ?? $_GET['role'] ?? 'passenger';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $lastName  = $_POST['last_name'] ?? '';
            $firstName = $_POST['first_name'] ?? '';
            $password  = $_POST['password'] ?? 'secret';
            $balance   = $_POST['balance'] ?? 0;

            $login = $lastName . $firstName;

            $success = UserModel::insert(
                $lastName,
                $firstName,
                $login,
                $password,
                $roleNewUser,
                $balance
            );

            if ($success) {
                require_once ROOT . '/app/view/user/viewSuccess.php';
                exit();
            } else {
                $errors[] = "Erreur lors de la création de l'utilisateur.";
            }
        }

        require_once ROOT . '/app/view/user/viewCreate.php';
    }
}