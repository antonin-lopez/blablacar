<?php
require_once ROOT . '/app/model/Model.php';

class ModelVehicule
{
    private $id, $marque, $modele, $annee, $immatriculation, $proprietaire_id, $nom, $prenom;

    public function __construct($id = NULL, $marque = NULL, $modele = NULL, $annee = NULL, $immatriculation = NULL, $proprietaire_id = NULL){
        if (!is_null($id)){
            $this->id = $id;
            $this->marque = $marque;
            $this->modele = $modele;
            $this->annee = $annee;
            $this->immatriculation = $immatriculation;
            $this->proprietaire_id = $proprietaire_id;
        }
    }
    
    // Setters
    function setId($id){
        $this->id = $id;
    }

    function setMarque($marque){
        $this->marque = $marque;
    }

    function setModele($modele){
        $this->modele = $modele;
    }

    function setAnnee($annee){
        $this->annee = $annee;
    }

    function setImmatriculation($immatriculation){
        $this->immatriculation = $immatriculation;
    }

    function setProprietaire_id($proprietaire_id){
        $this->proprietaire_id = $proprietaire_id;
    }
    
    // Getters
    function getId(){
        return $this->id;
    }
    
    function getMarque(){
        return $this->marque;
    }
    
    function getModele(){
        return $this->modele;
    }
    
    function getAnnee(){
        return $this->annee;
    }
    
    function getImmatriculation(){
        return $this->immatriculation;
    }
    
    function getProprietaire_id(){
        return $this->proprietaire_id;
    }
    
    function getNom(){
        return $this->nom;
    }
    
    function getPrenom(){
        return $this->prenom;
    }

    public static function getAll(){
        try {
            $db = Model::getInstance();
            $query = "SELECT v.id, v.marque, v.modele, v.annee, v.immatriculation, v.proprietaire_id, u.nom, u.prenom FROM vehicule AS v JOIN utilisateur AS u ON v.proprietaire_id = u.id";
            $stmt = $db->prepare($query);
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_CLASS, "ModelVehicule");
            return $results;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }

    public static function insert($marque, $modele, $annee, $immatriculation, $proprietaire_id){
        try {
            $db = Model::getInstance();

            $query = "SELECT max(id) FROM vehicule";
            $stmt = $db->query($query);
            $tuple = $stmt->fetch(PDO::FETCH_NUM);
            $id = $tuple[0];
            $id++;

            $query = "INSERT INTO vehicule (id, marque, modele, annee, immatriculation, proprietaire_id) 
                      VALUES (:id, :marque, :modele, :annee, :immatriculation, :proprietaire_id)";
            $stmt = $db->prepare($query);
            $stmt->execute([
                ':id' => $id,
                ':marque' => $marque,
                ':modele' => $modele,
                ':annee' => $annee,
                ':immatriculation' => $immatriculation,
                ':proprietaire_id' => $proprietaire_id
            ]);
            
            return $id;

        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }
}
?>