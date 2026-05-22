<?php
require_once ROOT . '/app/model/ModelTrajet.php';

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
}
