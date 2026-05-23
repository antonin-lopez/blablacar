<?php
require_once ROOT . '/app/model/ModelUtilisateur.php';

class ControllerConnexion
{
    public static function login($args = [])
    {
        $errors = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $login = $_POST['login'] ?? '';
            $password = $_POST['password'] ?? '';

            try {
                $user = ModelUtilisateur::verifierCredentials($login, $password);

                if ($user) {
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['nom'] = $user['nom'];
                    $_SESSION['prenom'] = $user['prenom'];
                    $_SESSION['role'] = $user['role'];
                    $_SESSION['solde'] = $user['solde'];

                    header('Location: index.php?controller=accueil&action=home');
                    exit();
                } else {
                    $errors = 'Identifiant ou mot de passe incorrect.';
                }
            } catch (Exception $e) {
                $errors = $e->getMessage();
            }
        }

        require ROOT . '/app/view/connexion/viewLogin.php';
    }


    public static function logout($args = [])
    {
        session_destroy();

        header('Location: index.php?controller=accueil&action=home');
        exit();
    }
}
