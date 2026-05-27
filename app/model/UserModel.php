<?php
require_once ROOT . '/app/model/Model.php';

class UserModel
{
    public static function verifierCredentials($login, $password)
    {
        $db = Model::getInstance();

        $sql = "SELECT * FROM utilisateur WHERE login = :login";

        $stmt = $db->prepare($sql);
        $stmt->execute(['login' => $login]);
        $user = $stmt->fetch();

        if ($user && $password === $user['password']) {
            return $user;
        }

        return false;
    }


    public static function readAll()
    {
        $db = Model::getInstance();

        $sql = "SELECT id, nom, prenom, role, login, password, solde FROM utilisateur";

        $stmt = $db->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll();
    }


    public static function readConducteurs()
    {
        $db = Model::getInstance();

        $sql = "SELECT id, nom, prenom FROM utilisateur WHERE role = 'conducteur'";

        $stmt = $db->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    
    public static function insert($nom, $prenom, $login, $password, $role, $solde)
    {
        $db = Model::getInstance();

        $sql = "INSERT INTO utilisateur (id, nom, prenom, login, password, role, solde) 
                VALUES ((SELECT COALESCE(MAX(id), 0) + 1 FROM utilisateur u2), :nom, :prenom, :login, :password, :role, :solde)";

        $stmt = $db->prepare($sql);

        return $stmt->execute([
            'nom'      => $nom,
            'prenom'   => $prenom,
            'login'    => $login,
            'password' => $password,
            'role'     => $role,
            'solde'    => $solde
        ]);
    }
}
