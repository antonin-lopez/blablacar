<?php
require_once ROOT . '/app/model/ModelReservation.php';
require_once ROOT . '/app/model/ModelTrajet.php';
require_once ROOT . '/app/model/ModelVille.php';
require_once ROOT . '/app/model/ModelVehicule.php';

class ControllerReservation
{
    public static function readMyReservations($args)
    {
        if ($_SESSION['role_utilisateur'] !== 'passager') {
            header('Location: index.php?controller=accueil&action=home');
            exit();
        }

        $idUtilisateur = $_SESSION['id_utilisateur'];
        $reservations = ModelReservation::readByPassagerId($idUtilisateur);

        require_once ROOT . '/app/view/reservation/viewAll.php';
    }


    public static function create($args)
    {
        if ($_SESSION['role_utilisateur'] !== 'passager') {
            header('Location: index.php?controller=accueil&action=home');
            exit();
        }

        $errors = '';
        $idPassager = $_SESSION['id_utilisateur'];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $trajetId = $_POST['trajet_id'] ?? '';

            if ($trajetId) {
                $succes = ModelReservation::insert($trajetId, $idPassager);
                if ($succes) {
                    header('Location: index.php?controller=reservation&action=readMyReservations');
                    exit();
                }
            }
        }

        $trajets = ModelTrajet::readAllActiveExcludingPassenger($idPassager);

        require_once ROOT . '/app/view/reservation/viewInsert.php';
    }
}
