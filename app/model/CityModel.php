<?php
require_once ROOT . '/app/model/Model.php';
require_once ROOT . '/app/model/City.php';

class CityModel
{
    public static function readAll(): array
    {
        $db = Model::getInstance();
        $sql = "SELECT * FROM ville ORDER BY nom ASC";
        $stmt = $db->query($sql);

        return $stmt->fetchAll(PDO::FETCH_CLASS, 'City');
    }

    public static function exists(string $name): bool
    {
        $db = Model::getInstance();
        $sql = "SELECT COUNT(*) FROM ville WHERE nom = :name";

        $stmt = $db->prepare($sql);
        $stmt->execute(['name' => $name]);

        return (int)$stmt->fetchColumn() > 0;
    }

    public static function insert(string $name): bool
    {
        $db = Model::getInstance();
        $sql = "INSERT INTO ville (id, nom)
                VALUES ((SELECT COALESCE(MAX(id), 0) + 1 FROM ville v2), :name)";

        $stmt = $db->prepare($sql);
        return $stmt->execute(['name' => $name]);
    }
}
