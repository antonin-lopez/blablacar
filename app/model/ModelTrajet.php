<?php
require_once ROOT . '/app/model/Model.php';

class ModelTrajet
{
    public static function readByConducteurId($conducteurId)
    {
        $db = Model::getInstance();

        $sql = "SELECT t.*, v_dep.nom AS nom_ville_depart, v_arr.nom AS nom_ville_arrivee
                FROM trajet t
                JOIN ville v_dep ON t.ville_depart = v_dep.id
                JOIN ville v_arr ON t.ville_arrivee = v_arr.id
                WHERE t.conducteur_id = :conducteur_id";

        $stmt = $db->prepare($sql);
        $stmt->execute(['conducteur_id' => $conducteurId]);

        return $stmt->fetchAll();
    }


    public static function insert($villeDepart, $villeArrivee, $conducteurId, $vehiculeId, $prix, $dateDepart, $heureDepart)
    {
        $db = Model::getInstance();

        $sql = "INSERT INTO trajet (id, ville_depart, ville_arrivee, conducteur_id, vehicule_id, prix, date_depart, heure_depart, statut)
                VALUES ((SELECT COALESCE(MAX(id), 0) + 1 FROM trajet t2), :ville_depart, :ville_arrivee, :conducteur_id, :vehicule_id, :prix, :date_depart, :heure_depart, 'actif')";

        $stmt = $db->prepare($sql);

        return $stmt->execute([
            'ville_depart'   => $villeDepart,
            'ville_arrivee'  => $villeArrivee,
            'conducteur_id'  => $conducteurId,
            'vehicule_id'    => $vehiculeId,
            'prix'           => $prix,
            'date_depart'    => $dateDepart,
            'heure_depart'   => $heureDepart
        ]);
    }


    public static function readActiveByConducteurId($conducteurId)
    {
        $db = Model::getInstance();

        $sql = "SELECT t.*, v_dep.nom AS nom_ville_depart, v_arr.nom AS nom_ville_arrivee
                FROM trajet t
                JOIN ville v_dep ON t.ville_depart = v_dep.id
                JOIN ville v_arr ON t.ville_arrivee = v_arr.id
                WHERE t.conducteur_id = :conducteur_id AND t.statut = 'actif'";

        $stmt = $db->prepare($sql);
        $stmt->execute(['conducteur_id' => $conducteurId]);

        return $stmt->fetchAll();
    }


    public static function readById($trajetId)
    {
        $db = Model::getInstance();

        $sql = "SELECT t.*, v_dep.nom AS nom_ville_depart, v_arr.nom AS nom_ville_arrivee
                FROM trajet t
                JOIN ville v_dep ON t.ville_depart = v_dep.id
                JOIN ville v_arr ON t.ville_arrivee = v_arr.id
                WHERE t.id = :id";

        $stmt = $db->prepare($sql);
        $stmt->execute(['id' => $trajetId]);
        
        return $stmt->fetch();
    }


    public static function readPassengersByTrajetId($trajetId)
    {
        $db = Model::getInstance();

        $sql = "SELECT u.nom, u.prenom, u.login
                FROM reservation r
                JOIN utilisateur u ON r.passager_id = u.id
                WHERE r.trajet_id = :trajet_id";

        $stmt = $db->prepare($sql);
        $stmt->execute(['trajet_id' => $trajetId]);

        return $stmt->fetchAll();
    }
}
