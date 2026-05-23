<?php
require_once ROOT . '/app/model/ModelUtilisateur.php';

class ControllerUtilisateur
{
    public static function readAll($args)
    {
        if ($_SESSION['role'] !== 'administrateur') {
            header('Location: index.php?controller=accueil&action=home');
            exit();
        }

        $utilisateurs = ModelUtilisateur::readAll();

        require_once ROOT . '/app/view/utilisateur/viewAll.php';
    }

    public static function create($args)
    {
        if ($_SESSION['role'] !== 'administrateur') {
            header('Location: index.php?controller=accueil&action=home');
            exit();
        }

        $errors = '';

        $userRole = $_POST['userRole'] ?? $_GET['role'] ?? 'passager';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nom      = $_POST['nom'] ?? '';
            $prenom   = $_POST['prenom'] ?? '';
            $password = $_POST['password'] ?? '';
            $solde    = $_POST['solde'] ?? 0;

            $login = $nom . $prenom;

            $result = ModelUtilisateur::insert($nom, $prenom, $login, $password, $userRole, $solde);

            if ($result) {
                header('Location: index.php?controller=utilisateur&action=readAll');
                exit();
            } else {
                $errors = "Erreur lors de la création de l'utilisateur.";
            }
        }

        require_once ROOT . '/app/view/utilisateur/viewInsert.php';
    }
}
