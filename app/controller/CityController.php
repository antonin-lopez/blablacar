<?php
require_once ROOT . '/app/model/CityModel.php';

class CityController
{
    public static function index($args)
    {
        if ($_SESSION['user_role'] !== 'administrateur') {
            header('Location: index.php?controller=home&action=home');
            exit();
        }

        $cities = CityModel::readAll();
        require_once ROOT . '/app/view/city/viewAll.php';
    }

    public static function create($args)
    {
        if ($_SESSION['user_role'] !== 'administrateur') {
            header('Location: index.php?controller=home&action=home');
            exit();
        }

        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $cityName = $_POST['name'] ?? '';

            if (empty($cityName)) {
                $errors[] = "Le nom de la ville ne peut pas être vide.";
            } elseif (CityModel::exists($cityName)) {
                $errors[] = "Cette ville existe déjà.";
            } else {
                $success = CityModel::insert($cityName);

                if ($success) {
                    require_once ROOT . '/app/view/city/viewSuccess.php';
                    exit();
                } else {
                    $errors[] = "Erreur lors de l'enregistrement de la ville.";
                }
            }
        }

        require_once ROOT . '/app/view/city/viewCreate.php';
    }
}
