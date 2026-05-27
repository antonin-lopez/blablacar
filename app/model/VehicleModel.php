<?php
require_once ROOT . '/app/model/Model.php';
require_once ROOT . '/app/model/Vehicle.php';

class VehicleModel
{
    public static function readByOwnerId(int $ownerId): array
    {
        $db = Model::getInstance();
        $sql = "SELECT * FROM vehicule WHERE proprietaire_id = :owner_id";

        $stmt = $db->prepare($sql);
        $stmt->execute(['owner_id' => $ownerId]);

        return $stmt->fetchAll(PDO::FETCH_CLASS, 'Vehicle');
    }

    public static function readAll(): array
    {
        $db = Model::getInstance();
        $sql = "SELECT v.*, u.nom, u.prenom 
                FROM vehicule v 
                JOIN utilisateur u ON v.proprietaire_id = u.id";

        $stmt = $db->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_CLASS, 'Vehicle');
    }

    public static function insert(string $brand, string $model, int $year, string $licensePlate, int $ownerId): bool
    {
        $db = Model::getInstance();
        $sql = "INSERT INTO vehicule (id, marque, modele, annee, immatriculation, proprietaire_id)
                VALUES ((SELECT COALESCE(MAX(id), 0) + 1 FROM vehicule v2), :brand, :model, :year, :license_plate, :owner_id)";

        $stmt = $db->prepare($sql);
        return $stmt->execute([
            'brand'         => $brand,
            'model'         => $model,
            'year'          => $year,
            'license_plate' => $licensePlate,
            'owner_id'      => $ownerId
        ]);
    }
}
