<?php
require_once ROOT . '/app/model/ModelVehicule.php';
require_once ROOT . '/app/model/ModelUtilisateur.php';

class VehicleController
{
    public static function readMyVehicles($args)
    {
        if ($_SESSION['role_utilisateur'] !== 'conducteur') {
            header('Location: index.php?controller=accueil&action=home');
            exit();
        }

        $idUtilisateur = $_SESSION['id_utilisateur'];
        $vehicules = ModelVehicule::readByProprietaireId($idUtilisateur);

        require_once ROOT . '/app/view/vehicule/viewAll.php';
    }


    public static function readAll($args)
    {
        if ($_SESSION['role_utilisateur'] !== 'administrateur') {
            header('Location: index.php?controller=accueil&action=home');
            exit();
        }

        $vehicules = ModelVehicule::readAll();

        require_once ROOT . '/app/view/vehicule/viewAll.php';
    }


    public static function create($args)
    {
        if ($_SESSION['role_utilisateur'] !== 'administrateur') {
            header('Location: index.php?controller=accueil&action=home');
            exit();
        }

        $errors = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $marqueNouveauVehicule          = $_POST['marque_nouveau_vehicule'] ?? '';
            $modeleNouveauVehicule          = $_POST['modele_nouveau_vehicule'] ?? '';
            $anneeNouveauVehicule           = $_POST['annee_nouveau_vehicule'] ?? '';
            $immatriculationNouveauVehicule = $_POST['immatriculation_nouveau_vehicule'] ?? '';
            $proprietaireIdNouveauVehicule  = $_POST['id_proprietaire_nouveau_vehicule'] ?? '';

            $nouveauVehicule = ModelVehicule::insert(
                $marqueNouveauVehicule,
                $modeleNouveauVehicule,
                $anneeNouveauVehicule,
                $immatriculationNouveauVehicule,
                $proprietaireIdNouveauVehicule
            );

            if ($nouveauVehicule) {
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
