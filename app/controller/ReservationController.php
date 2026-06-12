<?php
require_once ROOT . '/app/model/ReservationModel.php';
require_once ROOT . '/app/model/RideModel.php';

class ReservationController
{
    public static function index($args = [])
    {
        if ($_SESSION['user_role'] !== 'passager') {
            header('Location: index.php?controller=home&action=home');
            exit();
        }

        $passengerId = $_SESSION['user_id'];
        $reservations = ReservationModel::readByPassengerId($passengerId);

        require_once ROOT . '/app/view/reservation/viewAll.php';
    }

    public static function create($args = [])
    {
        if ($_SESSION['user_role'] !== 'passager') {
            header('Location: index.php?controller=home&action=home');
            exit();
        }

        $errors = [];
        $passengerId = $_SESSION['user_id'];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $rideId = $_POST['ride_id'] ?? '';

            if ($rideId) {
                try {
                    $debitedPrice = ReservationModel::insert((int)$rideId, $passengerId);
                    $_SESSION['balance'] -= $debitedPrice;

                    header('Location: index.php?controller=reservation&action=index');
                    exit();
                } catch (Exception $e) {
                    $errors[] = $e->getMessage();
                }
            } else {
                $errors[] = "Veuillez sélectionner un trajet valide.";
            }
        }

        $rides = RideModel::readAllActiveExcludingPassenger($passengerId);

        require_once ROOT . '/app/view/reservation/viewCreate.php';
    }
}
