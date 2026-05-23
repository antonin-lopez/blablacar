<?php
$nomController = $_GET['controller'] ?? 'accueil';
$classeController = 'Controller' . ucfirst($nomController);
$fichierController = 'app/controller/' . $classeController . '.php';

$action = $_GET['action'] ?? 'home';

if (file_exists($fichierController)) {
    require_once $fichierController;

    if (class_exists($classeController) && method_exists($classeController, $action)) {
        $classeController::$action($_GET);
    } else {
        chargerAccueil();
    }
} else {
    chargerAccueil();
}

function chargerAccueil()
{
    require_once 'app/controller/ControllerAccueil.php';
    ControllerAccueil::home($_GET);
}
