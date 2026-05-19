<?php
require_once 'app/model/ModelUtilisateur.php';

class ControllerConnexion {
    public function login() {
        if (isset($_SESSION['login_id']) && $_SESSION['login_id'] > 0) {
            header('Location: router.php?controller=accueil&action=home');
            exit();
        }
        require_once 'app/view/connexion/viewLogin.php';
    }

    public function logout() {
        $_SESSION['login_id'] = -1;
        $_SESSION['nom'] = '';
        $_SESSION['prenom'] = '';
        $_SESSION['role'] = '';
        $_SESSION['solde'] = 0;
        header('Location: router.php?controller=accueil&action=home');
        exit();
}
}
