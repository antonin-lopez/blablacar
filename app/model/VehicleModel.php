<?php
require_once ROOT . '/app/model/Model.php';

class VehicleModel
{
    public static function readByProprietaireId($proprietaireId)
    {
        $db = Model::getInstance();

        $sql = "SELECT * FROM vehicule WHERE proprietaire_id = :proprietaire_id";

        $stmt = $db->prepare($sql);
        $stmt->execute(['proprietaire_id' => $proprietaireId]);

        return $stmt->fetchAll();
    }

    
    public static function readAll()
    {
        $db = Model::getInstance();

        $sql = "SELECT v.*, u.nom, u.prenom 
                FROM vehicule v 
                JOIN utilisateur u ON v.proprietaire_id = u.id";

        $stmt = $db->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll();
    }


    public static function insert($marque, $modele, $annee, $immatriculation, $proprietaireId)
    {
        $db = Model::getInstance();

        $sql = "INSERT INTO vehicule (id, marque, modele, annee, immatriculation, proprietaire_id)
                VALUES ((SELECT COALESCE(MAX(id), 0) + 1 FROM vehicule v2), :marque, :modele, :annee, :immatriculation, :proprietaire_id)";

        $stmt = $db->prepare($sql);

        return $stmt->execute([
            'marque'          => $marque,
            'modele'          => $modele,
            'annee'           => $annee,
            'immatriculation' => $immatriculation,
            'proprietaire_id' => $proprietaireId
        ]);
    }
}