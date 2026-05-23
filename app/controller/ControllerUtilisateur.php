<?php
require_once ROOT . '/app/model/ModelUtilisateur.php';

class ControllerUtilisateur {
    
    public static function readAll($params = []) {
        $results = ModelUtilisateur::getAll();
        require ROOT . '/app/view/utilisateur/viewAll.php';
    }

    public static function createConducteur(){
        $userRole = 'conducteur';
        require ROOT . '/app/view/utilisateur/viewInsert.php';
    }

    public static function createPassager(){
        $userRole = 'passager';
        require ROOT . '/app/view/utilisateur/viewInsert.php';
    }

    public static function utilisateurCreated(){
        $nom = htmlspecialchars($_GET['nom']);
        $prenom = htmlspecialchars($_GET['prenom']);
        
        $login = strtolower($nom . $prenom);
        
        $results = ModelUtilisateur::insert(
            $nom,
            $prenom,
            $login,
            htmlspecialchars($_GET['password']),
            htmlspecialchars($_GET['userRole']),
            htmlspecialchars($_GET['solde'])
        );
        require ROOT . '/app/view/utilisateur/viewInserted.php';
    }
}