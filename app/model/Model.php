<?php

class Model
{
    private static ?PDO $_database = null;

    private function __construct() {}

    /**
     * DESIGN PATTERN SINGLETON : Assure qu'une seule et unique instance de connexion PDO
     * ne soit instanciée et partagée tout au long d'un cycle de vie de la requête HTTP.
     */
    public static function getInstance(): PDO
    {
        // Vérification de l'absence d'instance active avant d'effectuer l'initialisation
        if (self::$_database === null) {
            // Chargement sécurisé des identifiants et des variables de configuration ($dsn, $username, $password)
            require_once ROOT . '/app/config/config.php';

            // Paramétrage fin du comportement de PDO (gestion stricte des erreurs et mode de récupération)
            $options = [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            ];

            try {
                // Instanciation unique de l'objet PDO de connexion
                self::$_database = new PDO($dsn, $username, $password, $options);
            } catch (PDOException $e) {
                // ENCAPSULATION DES ERREURS : Masquage des détails de connexion sensibles et levée d'une exception générique
                throw new Exception("Database Connection Error: " . $e->getMessage());
            }
        }

        // Retourne la connexion existante ou la nouvelle connexion tout juste établie
        return self::$_database;
    }
}
