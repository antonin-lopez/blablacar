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

    
    public static function readAll($args)
    {
        if ($_SESSION['role'] !== 'administrateur') {
            header('Location: index.php?controller=accueil&action=home');
            exit();
        }

        $vehicules = ModelVehicule::readAll();

        require_once ROOT . '/app/view/vehicule/viewAll.php';
    }


    public static function create($args)
    {
        if ($_SESSION['role'] !== 'administrateur') {
            header('Location: index.php?controller=accueil&action=home');
            exit();
        }

        $errors = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $marque          = $_POST['marque'] ?? '';
            $modele          = $_POST['modele'] ?? '';
            $annee           = $_POST['annee'] ?? '';
            $immatriculation = $_POST['immatriculation'] ?? '';
            $proprietaireId  = $_POST['proprietaire_id'] ?? '';

            $result = ModelVehicule::insert($marque, $modele, $annee, $immatriculation, $proprietaireId);

            if ($result) {
                header('Location: index.php?controller=vehicule&action=readAll');
                exit();
            } else {
                $errors = "Erreur lors de la création du véhicule.";
            }
        }

        $conducteurs = ModelUtilisateur::readConducteurs();

        require_once ROOT . '/app/view/vehicule/viewInsert.php';
    }
}
