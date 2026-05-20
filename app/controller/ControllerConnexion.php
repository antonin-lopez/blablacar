<?php
require_once ROOT . '/app/model/ModelUtilisateur.php';

class ControllerConnexion
{
    public static function login($args = [])
    {
        $erreur = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $login = $_POST['login'] ?? '';
            $password = $_POST['password'] ?? '';

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
                $erreur = 'Identifiant ou mot de passe incorrect.';
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
