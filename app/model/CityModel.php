<?php
require_once ROOT . '/app/model/Model.php';

class CityModel
{
    public static function readAll()
    {
        $db = Model::getInstance();

        $sql = "SELECT * FROM ville ORDER BY nom ASC";

        $stmt = $db->query($sql);

        return $stmt->fetchAll();
    }


    public static function existe($nom)
    {
        $db = Model::getInstance();

        $sql = "SELECT COUNT(*) FROM ville WHERE nom = :nom";

        $stmt = $db->prepare($sql);
        $stmt->execute(['nom' => $nom]);

        return (int)$stmt->fetchColumn() > 0;
    }

    
    public static function insert($nom)
    {
        $db = Model::getInstance();

        $sql = "INSERT INTO ville (id, nom)
                VALUES ((SELECT COALESCE(MAX(id), 0) + 1 FROM ville v2), :nom)";

        $stmt = $db->prepare($sql);

        return $stmt->execute(['nom' => $nom]);
    }
}
