<?php

class Model
{
    private static ?PDO $_database = null;

    private function __construct() {}

    public static function getInstance(): PDO
    {
        if (self::$_database === null) {
            require_once ROOT . '/app/config/config.php';

            $options = [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            ];

            try {
                self::$_database = new PDO($dsn, $username, $password, $options);
            } catch (PDOException $e) {
                throw new Exception("Database Connection Error: " . $e->getMessage());
            }
        }

        return self::$_database;
    }
}
