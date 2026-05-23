<?php
require_once ROOT . '/app/model/ModelVehicule.php';
require_once ROOT . '/app/model/ModelUtilisateur.php';

class ControllerVehicule
{
    public static function readMyVehicles($args)
    {
        if ($_SESSION['role'] !== 'conducteur') {
            header('Location: index.php?controller=accueil&action=home');
            exit();
        }

        $userId = $_SESSION['user_id'];
        $vehicules = ModelVehicule::readByProprietaireId($userId);

        require_once ROOT . '/app/view/vehicule/viewAll.php';
    }
    
    public static function readAll($params = []) {
        $results = ModelVehicule::getAll();
        require ROOT . '/app/view/vehicule/viewAll.php';
    }

    public static function createVehicule(){
        $conducteurs = ModelUtilisateur::getConducteurs();
        require ROOT . '/app/view/vehicule/viewInsert.php';
    }

    public static function vehiculeCreated(){
        $marque = htmlspecialchars($_GET['marque']);
        $modele = htmlspecialchars($_GET['modele']);
        $annee = htmlspecialchars($_GET['annee']);
        $immatriculation = htmlspecialchars($_GET['immatriculation']);
        $proprietaire_id = htmlspecialchars($_GET['proprietaire_id']);
        
        $results = ModelVehicule::insert(
            $marque,
            $modele,
            $annee,
            $immatriculation,
            $proprietaire_id
        );
        
        require ROOT . '/app/view/vehicule/viewInserted.php';
    }
}
?>