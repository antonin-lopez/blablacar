<?php
require_once ROOT . '/app/model/Model.php';
require_once ROOT . '/app/model/User.php';

class UserModel
{
    public static function verifyCredentials(string $login, string $password)
    {
        $db = Model::getInstance();
        $sql = "SELECT * FROM utilisateur WHERE login = :login";

        $stmt = $db->prepare($sql);
        $stmt->execute(['login' => $login]);

        $stmt->setFetchMode(PDO::FETCH_CLASS, 'User');
        $user = $stmt->fetch();

        if ($user && $password === $user->getPassword()) {
            return $user;
        }

        return false;
    }

    public static function readAll(): array
    {
        $db = Model::getInstance();
        $sql = "SELECT id, nom, prenom, role, login, password, solde FROM utilisateur";

        $stmt = $db->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_CLASS, 'User');
    }

    public static function readDrivers(): array
    {
        $db = Model::getInstance();
        $sql = "SELECT * FROM utilisateur WHERE role = 'conducteur'";

        $stmt = $db->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_CLASS, 'User');
    }

    public static function insert(string $lastName, string $firstName, string $login, string $password, string $role, float $balance): bool
    {
        $db = Model::getInstance();
        $sql = "INSERT INTO utilisateur (id, nom, prenom, login, password, role, solde) 
                VALUES ((SELECT COALESCE(MAX(id), 0) + 1 FROM utilisateur u2), :nom, :prenom, :login, :password, :role, :solde)";

        $stmt = $db->prepare($sql);
        return $stmt->execute([
            'nom'      => $lastName,
            'prenom'   => $firstName,
            'login'    => $login,
            'password' => $password,
            'role'     => $role,
            'solde'    => $balance
        ]);
    }
}
