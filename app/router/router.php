<?php
require_once 'app/controller/ControllerAccueil.php';

$nomController = $_GET['controller'] ?? 'Accueil';
$action = $_GET['action'] ?? 'home';

$classeController = 'Controller' . ucfirst($nomController);

if (class_exists($classeController) && method_exists($classeController, $action)) {
    $controller = new $classeController();
    $controller->$action($_GET);
} else {
    $controller = new ControllerAccueil();
    $controller->home($_GET);
}
