<?php
require_once ROOT . '/app/model/Model.php';
require_once ROOT . '/app/model/User.php';
require_once ROOT . '/app/model/Ride.php';
require_once ROOT . '/app/model/ReservationModel.php';

class ExaminerModel extends Model
{
    public static function getAllPassengers(): array
    {
        $db = Model::getInstance();

        $sql = "SELECT id, nom, prenom, login 
                FROM utilisateur 
                WHERE role = 'passager'";

        $stmt = $db->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_CLASS, 'User');
    }

    public static function getActiveRides(): array
    {
        $db = Model::getInstance();

        $sql = "SELECT t.*, 
                       v_dep.nom AS nom_ville_depart, 
                       v_arr.nom AS nom_ville_arrivee,
                       u.nom AS nom_conducteur,
                       u.prenom AS prenom_conducteur
                FROM trajet t
                JOIN ville v_dep ON t.ville_depart = v_dep.id
                JOIN ville v_arr ON t.ville_arrivee = v_arr.id
                JOIN utilisateur u ON t.conducteur_id = u.id
                WHERE t.statut = 'actif'";

        $stmt = $db->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_CLASS, 'Ride');
    }

    public static function reservationExists(int $rideId, int $passengerId): bool
    {
        $db = Model::getInstance();

        $sql = "SELECT COUNT(*) FROM reservation 
                WHERE trajet_id = :ride_id AND passager_id = :passenger_id";

        $stmt = $db->prepare($sql);
        $stmt->execute([
            'ride_id' => $rideId,
            'passenger_id' => $passengerId
        ]);

        return $stmt->fetchColumn() > 0;
    }

    public static function addTenRandomReservations(): array|false
    {
        $passengers = self::getAllPassengers();
        $activeRides = self::getActiveRides();

        if (empty($passengers) || empty($activeRides)) {
            return false;
        }

        $reservations = [];

        for ($i = 0; $i < 10; $i++) {
            $randomPassenger = $passengers[array_rand($passengers)];
            $randomRide = $activeRides[array_rand($activeRides)];

            if (!self::reservationExists($randomRide->getId(), $randomPassenger->getId())) {
                $success = ReservationModel::insert($randomRide->getId(), $randomPassenger->getId());

                if ($success) {
                    $reservations[] = [
                        'numero' => $i + 1,
                        'success' => true,
                        'passenger' => $randomPassenger,
                        'ride' => $randomRide
                    ];
                    continue;
                }
            }

            $reservations[] = [
                'numero' => $i + 1,
                'success' => false,
                'message' => "Ce trajet est déjà réservé par ce passager."
            ];
        }

        return $reservations;
    }
}
