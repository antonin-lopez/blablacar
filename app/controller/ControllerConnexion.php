<?php
require_once ROOT . '/app/model/ModelUtilisateur.php';

class ControllerConnexion
{
    public static function login($args = [])
    {
        $errors = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $login = $_POST['login_utilisateur'] ?? '';
            $password = $_POST['password_utilisateur'] ?? '';

            try {
                $utilisateur = ModelUtilisateur::verifierCredentials($login, $password);

                if ($utilisateur) {
                    $_SESSION['id_utilisateur'] = $utilisateur['id'];
                    $_SESSION['nom_utilisateur'] = $utilisateur['nom'];
                    $_SESSION['prenom_utilisateur'] = $utilisateur['prenom'];
                    $_SESSION['role_utilisateur'] = $utilisateur['role'];
                    $_SESSION['solde_utilisateur'] = $utilisateur['solde'];

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
