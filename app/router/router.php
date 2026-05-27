<?php
$controllerName = $_GET['controller'] ?? 'accueil';
$controllerClass = 'Controller' . ucfirst($controllerName);
$controllerFile = 'app/controller/' . $controllerClass . '.php';

$action = $_GET['action'] ?? 'home';

if (file_exists($controllerFile)) {
    require_once $controllerFile;

    if (class_exists($controllerClass) && method_exists($controllerClass, $action)) {
        $controllerClass::$action($_GET);
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
