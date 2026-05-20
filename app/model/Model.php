<?php
// app/model/Model.php

class Model
{
    private static $_instance = null;

    private function __construct() {}

    public static function getInstance()
    {
        if (self::$_instance === null) {
            require_once __DIR__ . '/../config/config.php';

            $options = array(
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            );

            try {
                self::$_instance = new PDO($dsn, $username, $password, $options);
            } catch (PDOException $e) {
                die("Erreur de connexion à la base de données : " . $e->getMessage());
            }
        }

        return self::$_instance;
    }
}
