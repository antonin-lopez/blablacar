<?php
require_once ROOT . '/app/model/ModelUtilisateur.php';

class ControllerUtilisateur
{
    public static function readAll($args)
    {
        if ($_SESSION['role_utilisateur'] !== 'administrateur') {
            header('Location: index.php?controller=accueil&action=home');
            exit();
        }

        $utilisateurs = ModelUtilisateur::readAll();

        require_once ROOT . '/app/view/utilisateur/viewAll.php';
    }


    public static function create($args)
    {
        if ($_SESSION['role_utilisateur'] !== 'administrateur') {
            header('Location: index.php?controller=accueil&action=home');
            exit();
        }

        $errors = '';

        $roleNouvelUtilisateur = $_POST['role_nouvel_utilisateur'] ?? $_GET['role_nouvel_utilisateur'] ?? 'passager';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nomNouvelUtilisateur    = $_POST['nom_nouvel_utilisateur'] ?? '';
            $prenomNouvelUtilisateur = $_POST['prenom_nouvel_utilisateur'] ?? '';
            $mdpNouvelUtilisateur    = $_POST['mdp_nouvel_utilisateur'] ?? '';
            $soldeNouvelUtilisateur  = $_POST['solde_nouvel_utilisateur'] ?? 0;

            $loginNouvelUtilisateur = $nomNouvelUtilisateur . $prenomNouvelUtilisateur;

            $nouvelUtilisateur = ModelUtilisateur::insert(
                $nomNouvelUtilisateur,
                $prenomNouvelUtilisateur,
                $loginNouvelUtilisateur,
                $mdpNouvelUtilisateur,
                $roleNouvelUtilisateur,
                $soldeNouvelUtilisateur
            );

            if ($nouvelUtilisateur) {
                require_once ROOT . '/app/view/utilisateur/viewInserted.php';
                exit();
            } else {
                $errors = "Erreur lors de la création de l'utilisateur.";
            }
        }

        require_once ROOT . '/app/view/utilisateur/viewInsert.php';
    }
}
