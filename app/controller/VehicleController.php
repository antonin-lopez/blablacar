<?php
require_once ROOT . '/app/model/VehicleModel.php';
require_once ROOT . '/app/model/UserModel.php';

class VehicleController
{
    public static function index($args = [])
    {
        $userRole = $_SESSION['user_role'] ?? '';
        $userId   = $_SESSION['user_id'] ?? null;

        if ($userRole === 'administrateur') {
            $vehicles = VehicleModel::readAll();
        } elseif ($userRole === 'conducteur') {
            $vehicles = VehicleModel::readByOwnerId($userId);
        } else {
            header('Location: index.php?controller=home&action=home');
            exit();
        }

        require_once ROOT . '/app/view/vehicle/viewAll.php';
    }

    public static function create($args = [])
    {
        if ($_SESSION['user_role'] !== 'administrateur') {
            header('Location: index.php?controller=home&action=home');
            exit();
        }

        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $brand        = $_POST['brand'] ?? '';
            $model        = $_POST['model'] ?? '';
            $year         = $_POST['year'] ?? '';
            $licensePlate = $_POST['license_plate'] ?? '';
            $ownerId      = $_POST['owner_id'] ?? '';

            if (empty($brand) || empty($model) || empty($year) || empty($licensePlate) || empty($ownerId)) {
                $errors[] = "Tous les champs sont obligatoires.";
            } else {
                $success = VehicleModel::insert($brand, $model, (int)$year, $licensePlate, (int)$ownerId);

                if ($success) {
                    $drivers = UserModel::readDrivers();
                    $ownerFullName = '';
                    foreach ($drivers as $driver) {
                        if ($driver->getId() == $ownerId) {
                            $ownerFullName = $driver->getFullName();
                            break;
                        }
                    }

                    require_once ROOT . '/app/view/vehicle/viewSuccess.php';
                    exit();
                } else {
                    $errors[] = "Erreur lors de la création du véhicule.";
                }
            }
        }

        $drivers = UserModel::readDrivers();
        require_once ROOT . '/app/view/vehicle/viewCreate.php';
    }
}
