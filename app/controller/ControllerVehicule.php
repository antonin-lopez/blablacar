<?php
require_once ROOT . '/app/model/ModelVehicule.php';

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
}
