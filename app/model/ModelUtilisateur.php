<?php
require_once ROOT . '/app/model/Model.php';

class ModelUtilisateur
{
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
}
