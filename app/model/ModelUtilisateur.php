<?php
require_once ROOT . '/app/model/Model.php';

class ModelUtilisateur
{
    private $id, $nom, $prenom, $role, $login, $password, $solde;

    public function __construct($id = NULL, $nom = NULL, $prenom = NULL, $role = NULL, $login = NULL, $password = NULL, $solde = NULL){
        if (!is_null($id)){
            $this->id = $id;
            $this->prenom = $prenom;
            $this->nom = $nom;
            $this->role = $role;
            $this->login = $login;
            $this->password = $password;
            $this->solde = $solde;
        }
    }
    
    function setId($id){
        $this->id = $id;
    }

    function setPrenom($prenom){
        $this->prenom = $prenom;
    }

    function setNom($nom){
        $this->nom = $nom;
    }

    function setRole($role){
        $this->role = $role;
    }

    function setLogin($login){
        $this->login = $login;
    }

    function setPassword($password){
        $this->password = $password;
    }
    
    function setSolde($solde){
        $this->solde = $solde;
    }
    
    function getId(){
        return $this->id;
    }
    
    function getNom(){
        return $this->nom;
    }
    
    function getPrenom(){
        return $this->prenom;
    }
    
    function getRole(){
        return $this->role;
    }
    
    function getLogin(){
        return $this->login;
    }
    
    function getPassword(){
        return $this->password;
    }
    
    function getSolde(){
        return $this->solde;
    }
        
    public static function verifierCredentials($login, $password)
    {
        $db = Model::getInstance();

        $stmt = $db->prepare("SELECT * FROM utilisateur WHERE login = :login");
        $stmt->execute(['login' => $login]);
        $user = $stmt->fetch();

        if ($user && $password === $user['password']) {
            return $user;
        }

        return false;
    }

    public static function getAll(){
        try {
            $db = Model::getInstance();
            $query = "SELECT id, nom, prenom, role, login, password, solde FROM utilisateur";
            $stmt = $db->prepare($query);
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_CLASS, "ModelUtilisateur");
            return $results;
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }

    public static function insert($nom, $prenom, $login, $password, $role, $solde){
        try {
            $db = Model::getInstance();

            $query = "SELECT max(id) FROM utilisateur";
            $stmt = $db->query($query);
            $tuple = $stmt->fetch(PDO::FETCH_NUM);
            $id = $tuple[0];
            $id++;

            $query = "INSERT INTO utilisateur (id, nom, prenom, login, password, role, solde) VALUES (:id, :nom, :prenom, :login, :password, :role, :solde)";
            $stmt = $db->prepare($query);
            $stmt->execute([
                'id' => $id,
                'nom' => $nom,
                'prenom' => $prenom,
                'login' => $login,
                'password' => $password,
                'role' => $role,
                'solde' => $solde
            ]);
            return $id;

        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }

    // méthode pour récupérer les conducteurs
    public static function getConducteurs(){
        try {
            $db = Model::getInstance();
            $query = "SELECT id, nom, prenom FROM utilisateur WHERE role = 'conducteur'";
            $stmt = $db->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            printf("%s - %s<p/>\n", $e->getCode(), $e->getMessage());
            return NULL;
        }
    }
}
?>