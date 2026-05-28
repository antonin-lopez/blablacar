<?php
require_once ROOT . '/app/model/RideModel.php';
require_once ROOT . '/app/model/CityModel.php';
require_once ROOT . '/app/model/VehicleModel.php';

class RideController
{
    public static function index($args)
    {
        if ($_SESSION['user_role'] !== 'conducteur') {
            header('Location: index.php?controller=home&action=home');
            exit();
        }

        $userId = $_SESSION['user_id'];
        $rides = RideModel::readByDriverId($userId);

        require_once ROOT . '/app/view/ride/viewAll.php';
    }

    public static function create($args)
    {
        if ($_SESSION['user_role'] !== 'conducteur') {
            header('Location: index.php?controller=home&action=home');
            exit();
        }

        $errors = [];
        $userId = $_SESSION['user_id'];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $departureCityId = $_POST['departure_city_id'] ?? '';
            $arrivalCityId   = $_POST['arrival_city_id'] ?? '';
            $vehicleId       = $_POST['vehicle_id'] ?? '';
            $price           = $_POST['price'] ?? '';
            $departureDate   = $_POST['departure_date'] ?? '';
            $departureTime   = $_POST['departure_time'] ?? '';

            if ($departureCityId === $arrivalCityId) {
                $errors[] = "La ville de départ doit être différente de la ville d'arrivée.";
            } else {
                $success = RideModel::insert(
                    $departureCityId,
                    $arrivalCityId,
                    $userId,
                    $vehicleId,
                    $price,
                    $departureDate,
                    $departureTime
                );

                if ($success) {
                    header('Location: index.php?controller=ride&action=index');
                    exit();
                } else {
                    $errors[] = "Erreur lors de la création du trajet.";
                }
            }
        }

        $cities = CityModel::readAll();
        $vehicles = VehicleModel::readByOwnerId($userId);

        require_once ROOT . '/app/view/ride/viewCreate.php';
    }

    public static function activeRides($args)
    {
        if ($_SESSION['user_role'] !== 'conducteur') {
            header('Location: index.php?controller=home&action=home');
            exit();
        }

        $userId = $_SESSION['user_id'];
        $viewMode = $_GET['view'] ?? 'passengers';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $rideId = $_POST['ride_id'] ?? null;

            if ($rideId !== null) {
                if ($viewMode === 'close') {
                    RideModel::closeRide($rideId);
                    header('Location: index.php?controller=ride&action=index');
                    exit();
                } else {
                    $ride = RideModel::readById($rideId);
                    $passengers = RideModel::readPassengersByRideId($rideId);

                    require_once ROOT . '/app/view/ride/viewPassengers.php';
                    exit();
                }
            }
        }

        $rides = RideModel::readActiveByDriverId($userId);

        require_once ROOT . '/app/view/ride/viewSelectActive.php';
    }
}
