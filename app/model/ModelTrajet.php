<?php
require_once ROOT . '/app/model/Model.php';

class ModelTrajet
{
    public static function readByConducteurId($conducteur_id)
    {
        $db = Model::getInstance();

        $sql = "SELECT t.*, v_dep.nom AS nom_ville_depart, v_arr.nom AS nom_ville_arrivee
                FROM trajet t
                JOIN ville v_dep ON t.ville_depart = v_dep.id
                JOIN ville v_arr ON t.ville_arrivee = v_arr.id
                WHERE t.conducteur_id = :conducteur_id";

        $stmt = $db->prepare($sql);
        $stmt->execute(['conducteur_id' => $conducteur_id]);

        return $stmt->fetchAll();
    }
}
