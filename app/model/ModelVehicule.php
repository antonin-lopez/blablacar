<?php
require_once ROOT . '/app/model/Model.php';

class ModelVehicule
{
    public static function readByProprietaireId($proprietaireId)
    {
        $db = Model::getInstance();

        $sql = "SELECT * FROM vehicule WHERE proprietaire_id = :proprietaire_id";

        $stmt = $db->prepare($sql);
        $stmt->execute(['proprietaire_id' => $proprietaireId]);

        return $stmt->fetchAll();
    }
}
