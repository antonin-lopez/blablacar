<?php
require_once ROOT . '/app/model/UserModel.php';

class UserController
{
    public static function index($args)
    {
        if ($_SESSION['user_role'] !== 'administrateur') {
            header('Location: index.php?controller=home&action=home');
            exit();
        }

        $users = UserModel::readAll();
        require_once ROOT . '/app/view/user/viewAll.php';
    }

    public static function create($args)
    {
        if ($_SESSION['user_role'] !== 'administrateur') {
            header('Location: index.php?controller=home&action=home');
            exit();
        }

        $errors = [];
        $roleNewUser = $_POST['role'] ?? $_GET['role'] ?? 'passager';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $newLastName  = $_POST['last_name'] ?? '';
            $newFirstName = $_POST['first_name'] ?? '';
            $newPassword  = $_POST['password'] ?? 'secret';
            $newBalance   = $_POST['balance'] ?? 0;
            $newLogin     = $newLastName . $newFirstName;

            $success = UserModel::insert(
                $newLastName,
                $newFirstName,
                $newLogin,
                $newPassword,
                $roleNewUser,
                $newBalance
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
