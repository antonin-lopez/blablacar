<?php
require_once ROOT . '/app/model/Model.php';

class ModelVehicule
{
    public static function readByProprietaireId($proprietaire_id)
    {
        $db = Model::getInstance();

        $stmt = $db->prepare("SELECT * FROM vehicule WHERE proprietaire_id = :proprietaire_id");
        $stmt->execute(['proprietaire_id' => $proprietaire_id]);

        return $stmt->fetchAll();
    }
}
