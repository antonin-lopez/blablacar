<?php
require_once ROOT . '/app/model/ModelVille.php';

class ControllerVille {
    
    public static function readAll($params = []) {
        $results = ModelVille::getAll();
        require ROOT . '/app/view/ville/viewAll.php';
    }

    public static function createVille(){
        require ROOT . '/app/view/ville/viewInsert.php';
    }

    public static function villeCreated(){
        $nom = htmlspecialchars($_GET['nom']);
        // vérifier si la ville existe déjà
        if (ModelVille::existe($nom)) {
            $results = false;
        } else {
            $results = ModelVille::insert($nom);
        }
        require ROOT . '/app/view/ville/viewInserted.php';
    }
}
?>