<?php
require_once ROOT . '/app/model/Model.php';

class ModelVille
{
    public static function readAll()
    {
        $db = Model::getInstance();

        $sql = "SELECT * FROM ville ORDER BY nom ASC";

        $stmt = $db->query($sql);

        return $stmt->fetchAll();
    }
}
