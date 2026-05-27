<?php
require_once ROOT . '/app/model/ModelVille.php';

class CityController
{
    public static function readAll($args)
    {
        $villes = ModelVille::readAll();
        require_once ROOT . '/app/view/ville/viewAll.php';
    }

    public static function create($args)
    {
        if ($_SESSION['role_utilisateur'] !== 'administrateur') {
            header('Location: index.php?controller=accueil&action=home');
            exit();
        }

        $errors = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nomNouvelleVille = $_POST['nom_nouvelle_ville'] ?? '';

            if (empty($nomNouvelleVille)) {
                $errors = "Le nom de la ville ne peut pas être vide.";
            } elseif (ModelVille::existe($nomNouvelleVille)) {
                $errors = "Cette ville existe déjà.";
            } else {
                $result = ModelVille::insert($nomNouvelleVille);

                if ($result) {
                    header('Location: index.php?controller=ville&action=readAll');
                    exit();
                } else {
                    $errors = "Erreur lors de l'enregistrement de la ville.";
                }
            }
        }

        require_once ROOT . '/app/view/ville/viewInsert.php';
    }
}
