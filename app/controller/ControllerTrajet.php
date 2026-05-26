<?php
require_once ROOT . '/app/model/ModelTrajet.php';
require_once ROOT . '/app/model/ModelVille.php';
require_once ROOT . '/app/model/ModelVehicule.php';

class ControllerTrajet
{
    public static function readMyTrajets($args)
    {
        if ($_SESSION['role_utilisateur'] !== 'conducteur') {
            header('Location: index.php?controller=accueil&action=home');
            exit();
        }

        $idUtilisateur = $_SESSION['id_utilisateur'];
        $trajets = ModelTrajet::readByConducteurId($idUtilisateur);

        require_once ROOT . '/app/view/trajet/viewAll.php';
    }


    public static function create($args)
    {
        if ($_SESSION['role_utilisateur'] !== 'conducteur') {
            header('Location: index.php?controller=accueil&action=home');
            exit();
        }

        $errors = '';
        $idUtilisateur = $_SESSION['id_utilisateur'];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $villeDepartNouveauTrajet  = $_POST['ville_depart_nouveau_trajet'] ?? '';
            $villeArriveeNouveauTrajet = $_POST['ville_arrivee_nouveau_trajet'] ?? '';
            $idVehiculeNouveauTrajet   = $_POST['id_vehicule_nouveau_trajet'] ?? '';
            $prixNouveauTrajet         = $_POST['prix_nouveau_trajet'] ?? '';
            $dateDepartNouveauTrajet   = $_POST['date_depart_nouveau_trajet'] ?? '';
            $heureDepartNouveauTrajet  = $_POST['heure_depart_nouveau_trajet'] ?? '';

            if ($villeDepartNouveauTrajet === $villeArriveeNouveauTrajet) {
                $errors = "La ville de départ doit être différente de la ville d'arrivée.";
            } else {
                $succes = ModelTrajet::insert(
                    $villeDepartNouveauTrajet,
                    $villeArriveeNouveauTrajet,
                    $idUtilisateur,
                    $idVehiculeNouveauTrajet,
                    $prixNouveauTrajet,
                    $dateDepartNouveauTrajet,
                    $heureDepartNouveauTrajet
                );

                if ($succes) {
                    header('Location: index.php?controller=trajet&action=readMyTrajets');
                    exit();
                } else {
                    $errors = "Erreur lors de la création du trajet.";
                }
            }
        }

        $villes = ModelVille::readAll();
        $vehicules = ModelVehicule::readByProprietaireId($idUtilisateur);

        require_once ROOT . '/app/view/trajet/viewInsert.php';
    }


    public static function selectActiveTrajetForPassengers($args)
    {
        if ($_SESSION['role_utilisateur'] !== 'conducteur') {
            header('Location: index.php?controller=accueil&action=home');
            exit();
        }

        $idUtilisateur = $_SESSION['id_utilisateur'];
        $idTrajet = $_POST['trajet_id'] ?? null;

        if ($idTrajet !== null) {
            $trajet = ModelTrajet::readById($idTrajet);
            $passagers = ModelTrajet::readPassengersByTrajetId($idTrajet);

            require_once ROOT . '/app/view/trajet/viewPassengers.php';
        } else {
            $trajets = ModelTrajet::readActiveByConducteurId($idUtilisateur);

            require_once ROOT . '/app/view/trajet/viewSelectActive.php';
        }
    }


    public static function selectActiveTrajetToClose($args)
    {
        if ($_SESSION['role_utilisateur'] !== 'conducteur') {
            header('Location: index.php?controller=accueil&action=home');
            exit();
        }

        $idUtilisateur = $_SESSION['id_utilisateur'];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $idTrajet = $_POST['trajet_id'];

            ModelTrajet::closeTrajet($idTrajet);

            header('Location: index.php?controller=trajet&action=readMyTrajets');
            exit();
        } else {
            $trajets = ModelTrajet::readActiveByConducteurId($idUtilisateur);

            require_once ROOT . '/app/view/trajet/viewCloseActive.php';
        }
    }
}
