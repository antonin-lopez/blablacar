<?php
require_once ROOT . '/app/model/Model.php';

class ModelVille
{
    private $id, $nom;

    public function __construct($id = NULL, $nom = NULL){
        if (!is_null($id)){
            $this->id = $id;
            $this->nom = $nom;
        }
    }
    
    function setId($id){
        $this->id = $id;
    }

    function setNom($nom){
        $this->nom = $nom;
    }
    
    function getId(){
        return $this->id;
    }
    
    function getNom(){
        return $this->nom;
    }

    public static function getAll(){
        try {
            $db = Model::getInstance();
            $query = "SELECT id, nom FROM ville ORDER BY nom";
            $stmt = $db->prepare($query);
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_CLASS, "ModelVille");
            return $results;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }

    // méthode pour vérifier si une ville existe déjà
    public static function existe($nom){
        try {
            $db = Model::getInstance();
            $query = "SELECT COUNT(*) FROM ville WHERE nom = :nom";
            $stmt = $db->prepare($query);
            $stmt->execute([':nom' => $nom]);
            $count = $stmt->fetchColumn();
            return $count > 0;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return false;
        }
    }

    public static function insert($nom){
        try {
            $db = Model::getInstance();

            $query = "SELECT max(id) FROM ville";
            $stmt = $db->query($query);
            $tuple = $stmt->fetch(PDO::FETCH_NUM);
            $id = $tuple[0];
            $id++;
            
            $query = "INSERT INTO ville (id, nom) VALUES (:id, :nom)";
            $stmt = $db->prepare($query);
            $stmt->execute([
                ':id' => $id,
                ':nom' => $nom
            ]);
            return $id;

        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }
}
?>