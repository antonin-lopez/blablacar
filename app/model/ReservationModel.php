<?php
require_once ROOT . '/app/model/Model.php';

class ReservationModel
{
    public static function readByPassagerId($passagerId)
    {
        $db = Model::getInstance();

        $sql = "SELECT r.id AS reservation_id,
                       t.date_depart,
                       t.heure_depart,
                       u.nom AS nom_conducteur, 
                       u.prenom AS prenom_conducteur,
                       v_dep.nom AS ville_depart, 
                       v_arr.nom AS ville_arrivee,
                       v.marque AS marque_vehicule,
                       v.modele AS modele_vehicule,
                       v.immatriculation
                FROM reservation r
                JOIN trajet t ON r.trajet_id = t.id
                JOIN utilisateur u ON t.conducteur_id = u.id
                JOIN ville v_dep ON t.ville_depart = v_dep.id
                JOIN ville v_arr ON t.ville_arrivee = v_arr.id
                JOIN vehicule v ON t.vehicule_id = v.id
                WHERE r.passager_id = :passager_id";

        $stmt = $db->prepare($sql);

        $stmt->execute(['passager_id' => $passagerId]);

        return $stmt->fetchAll();
    }


    public static function insert($trajetId, $passagerId)
    {
        $db = Model::getInstance();

        $sql = "INSERT INTO reservation (id, trajet_id, passager_id)
                VALUES ((SELECT COALESCE(MAX(id), 0) + 1 FROM reservation r2), 
                       :trajet_id, 
                       :passager_id)";

        $stmt = $db->prepare($sql);

        return $stmt->execute([
            'trajet_id'   => $trajetId,
            'passager_id' => $passagerId
        ]);
    }
}
