<?php
require_once ROOT . '/app/model/Model.php';
require_once ROOT . '/app/model/Ride.php';

class RideModel
{
    public static function readByDriverId(int $driverId): array
    {
        $db = Model::getInstance();
        $sql = "SELECT t.*, 
                       v_dep.nom AS nom_ville_depart, 
                       v_arr.nom AS nom_ville_arrivee
                FROM trajet t
                JOIN ville v_dep ON t.ville_depart = v_dep.id
                JOIN ville v_arr ON t.ville_arrivee = v_arr.id
                WHERE t.conducteur_id = :driver_id";

        $stmt = $db->prepare($sql);
        $stmt->execute(['driver_id' => $driverId]);

        return $stmt->fetchAll(PDO::FETCH_CLASS, 'Ride');
    }

    public static function readActiveByDriverId(int $driverId): array
    {
        $db = Model::getInstance();
        $sql = "SELECT t.*, 
                       v_dep.nom AS nom_ville_depart, 
                       v_arr.nom AS nom_ville_arrivee
                FROM trajet t
                JOIN ville v_dep ON t.ville_depart = v_dep.id
                JOIN ville v_arr ON t.ville_arrivee = v_arr.id
                WHERE t.conducteur_id = :driver_id AND t.statut = 'actif'";

        $stmt = $db->prepare($sql);
        $stmt->execute(['driver_id' => $driverId]);

        return $stmt->fetchAll(PDO::FETCH_CLASS, 'Ride');
    }

    public static function readById(int $rideId): ?Ride
    {
        $db = Model::getInstance();
        $sql = "SELECT t.*, 
                       v_dep.nom AS nom_ville_depart, 
                       v_arr.nom AS nom_ville_arrivee
                FROM trajet t
                JOIN ville v_dep ON t.ville_depart = v_dep.id
                JOIN ville v_arr ON t.ville_arrivee = v_arr.id
                WHERE t.id = :id";

        $stmt = $db->prepare($sql);
        $stmt->execute(['id' => $rideId]);

        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Ride');
        $ride = $stmt->fetch();

        return $ride ?: null;
    }

    public static function readAllActiveExcludingPassenger(int $passengerId): array
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
                WHERE t.statut = 'actif' AND t.conducteur_id != :passenger_id";

        $stmt = $db->prepare($sql);
        $stmt->execute(['passenger_id' => $passengerId]);

        return $stmt->fetchAll(PDO::FETCH_CLASS, 'Ride');
    }

    public static function insert(int $departureCityId, int $arrivalCityId, int $driverId, int $vehicleId, float $price, string $departureDate, string $departureTime): bool
    {
        $db = Model::getInstance();
        $sql = "INSERT INTO trajet (id, ville_depart, ville_arrivee, conducteur_id, vehicule_id, prix, date_depart, heure_depart, statut)
                VALUES ((SELECT COALESCE(MAX(id), 0) + 1 FROM trajet t2), :departure_city_id, :arrival_city_id, :driver_id, :vehicle_id, :price, :departure_date, :departure_time, 'actif')";

        $stmt = $db->prepare($sql);
        return $stmt->execute([
            'departure_city_id' => $departureCityId,
            'arrival_city_id'   => $arrivalCityId,
            'driver_id'         => $driverId,
            'vehicle_id'        => $vehicleId,
            'price'             => $price,
            'departure_date'    => $departureDate,
            'departure_time'    => $departureTime
        ]);
    }

    public static function closeRide(int $rideId): bool
    {
        $db = Model::getInstance();
        $sql = "UPDATE trajet SET statut = 'passif' WHERE id = :id";

        $stmt = $db->prepare($sql);
        return $stmt->execute(['id' => $rideId]);
    }

    public static function readPassengersByRideId(int $rideId): array
    {
        $db = Model::getInstance();
        $sql = "SELECT u.nom, u.prenom, u.login
                FROM reservation r
                JOIN utilisateur u ON r.passager_id = u.id
                WHERE r.trajet_id = :ride_id";

        $stmt = $db->prepare($sql);
        $stmt->execute(['ride_id' => $rideId]);
        return $stmt->fetchAll();
    }
}
