<?php
require_once ROOT . '/app/model/ModelTrajet.php';
require_once ROOT . '/app/model/ModelVille.php';
require_once ROOT . '/app/model/ModelVehicule.php';

class ControllerTrajet
{
    public static function readMyTrajets($args)
    {
        if ($_SESSION['role'] !== 'conducteur') {
            header('Location: index.php?controller=accueil&action=home');
            exit();
        }

        $userId = $_SESSION['user_id'];
        $trajets = ModelTrajet::readByConducteurId($userId);

        require_once ROOT . '/app/view/trajet/viewAll.php';
    }

    public static function create($args)
    {
        if ($_SESSION['role'] !== 'conducteur') {
            header('Location: index.php?controller=accueil&action=home');
            exit();
        }

        $error = '';
        $userId = $_SESSION['user_id'];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $villeDepart  = $_POST['ville_depart'] ?? '';
            $villeArrivee = $_POST['ville_arrivee'] ?? '';
            $vehiculeId   = $_POST['vehicule_id'] ?? '';
            $prix          = $_POST['prix'] ?? '';
            $dateDepart   = $_POST['date_depart'] ?? '';
            $heureDepart  = $_POST['heure_depart'] ?? '';

            if ($villeDepart === $villeArrivee) {
                $error = "La ville de départ doit être différente de la ville d'arrivée.";
            } else {
                $result = ModelTrajet::insert($villeDepart, $villeArrivee, $userId, $vehiculeId, $prix, $dateDepart, $heureDepart);

                if ($result) {
                    header('Location: index.php?controller=trajet&action=readMyTrajets');
                    exit();
                } else {
                    $error = "Erreur lors de la création du trajet.";
                }
            }
        }

        $villes = ModelVille::readAll();
        $vehicules = ModelVehicule::readByProprietaireId($userId);

        require_once ROOT . '/app/view/trajet/viewInsert.php';
    }


    public static function selectActiveTrajetForPassengers($args)
    {
        if ($_SESSION['role'] !== 'conducteur') {
            header('Location: index.php?controller=accueil&action=home');
            exit();
        }

        $userId = $_SESSION['user_id'];
        $trajetId = $_POST['trajet_id'] ?? null;

        if ($trajetId !== null) {
            $trajet = ModelTrajet::readById($trajetId);
            $passagers = ModelTrajet::readPassengersByTrajetId($trajetId);

            require_once ROOT . '/app/view/trajet/viewPassengers.php';
        } else {
            $trajets = ModelTrajet::readActiveByConducteurId($userId);

            require_once ROOT . '/app/view/trajet/viewSelectActive.php';
        }
    }
}
