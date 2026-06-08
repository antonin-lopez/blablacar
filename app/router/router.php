<?php
// ANALYSE DE L'URL : Récupération du contrôleur ciblé depuis l'adresse, 'home' par défaut si absent
$controllerName = $_GET['controller'] ?? 'home';
// RECOMPOSITION DYNAMIQUE : Reconstruction du nom de la classe selon la convention CamelCase (ex: HomeController)
$controllerClass = ucfirst($controllerName) . 'Controller';
// CHEMIN DU FICHIER : Détermination du chemin relatif vers le fichier de script PHP du contrôleur
$controllerFile = 'app/controller/' . $controllerClass . '.php';

// ANALYSE DE L'ACTION : Récupération de la méthode à exécuter au sein du contrôleur, 'home' par défaut
$action = $_GET['action'] ?? 'home';

// SÉCURITÉ ARCHITECTURALE : Vérification impérative de l'existence physique du fichier avant inclusion
if (file_exists($controllerFile)) {
    require_once $controllerFile;

    // SÉCURITÉ DE CONTEXTE : Vérification de l'existence de la classe et de la méthode demandée
    if (class_exists($controllerClass) && method_exists($controllerClass, $action)) {
        // EXÉCUTION DYNAMIQUE : Appel de la méthode statique du contrôleur en injectant les paramètres globaux
        $controllerClass::$action($_GET);
    } else {
        // REPLI EN CAS D'ERREUR (Fallback) : Redirection vers l'accueil si la méthode ou la classe est introuvable
        loadHome();
    }
} else {
    // REPLI EN CAS D'ERREUR (Fallback) : Redirection vers l'accueil si le fichier n'existe pas du tout
    loadHome();
}

// ROUTE DE SÉCURITÉ : Déclaration de la fonction de secours pour charger proprement l'interface par défaut
function loadHome()
{
    require_once 'app/controller/HomeController.php';
    HomeController::home($_GET);
}
