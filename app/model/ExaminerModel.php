<?php
require_once ROOT . '/app/model/Model.php';
require_once ROOT . '/app/model/User.php';
require_once ROOT . '/app/model/Ride.php';
require_once ROOT . '/app/model/ReservationModel.php';

class ExaminerModel extends Model
{
    public static function getAllPassengers(): array
    {
        $db = Model::getInstance();

        $sql = "SELECT id, nom, prenom, login 
                FROM utilisateur 
                WHERE role = 'passager'";

        $stmt = $db->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_CLASS, 'User');
    }

    public static function getActiveRides(): array
    {
        $db = Model::getInstance();

        $sql = "SELECT t.*, 
                       v_dep.nom AS nom_ville_depart, 
                       v_arr.nom AS nom_ville_arrivee,
                       u.nom AS nom_conducteur,
                       u.prenom AS prenom_conducteur
                FROM trajet t
                JOIN ville v_dep ON t.ville_depart = v_dep.id
                JOIN ville v_arr ON t.ville_arrivee = v_arr.id
                JOIN utilisateur u ON t.conducteur_id = u.id
                WHERE t.statut = 'actif'";

        $stmt = $db->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_CLASS, 'Ride');
    }

    public static function reservationExists(int $rideId, int $passengerId): bool
    {
        $db = Model::getInstance();

        $sql = "SELECT COUNT(*) FROM reservation 
                WHERE trajet_id = :ride_id AND passager_id = :passenger_id";

        $stmt = $db->prepare($sql);
        $stmt->execute([
            'ride_id' => $rideId,
            'passenger_id' => $passengerId
        ]);

        return $stmt->fetchColumn() > 0;
    }

    public static function addTenRandomReservations(): array|false
    {
        // Chargement initial des entités de base requises pour la simulation
        $passengers = self::getAllPassengers();
        $activeRides = self::getActiveRides();

        // CONDITIONS AUX LIMITES : Arrêt préventif si l'une des tables nécessaires est vide
        if (empty($passengers) || empty($activeRides)) {
            return false;
        }

        $reservations = [];

        // ALGORITHME ITÉRATIF DE SIMULATION : Boucle configurée pour exécuter exactement 10 tentatives
        for ($i = 0; $i < 10; $i++) {
            // SÉLECTION ALÉATOIRE : Utilisation de array_rand pour piocher un passager et un trajet de manière imprévisible
            $randomPassenger = $passengers[array_rand($passengers)];
            $randomRide = $activeRides[array_rand($activeRides)];

            // COMPORTEMENT SÉCURISÉ (FILTRE D'UNICITÉ) : Appel à la méthode de vérification pour s'assurer
            // que le passager n'a pas déjà réservé ce trajet spécifique auparavant.
            if (!self::reservationExists($randomRide->getId(), $randomPassenger->getId())) {
                // Persistance de l'association aléatoire valide en Base de Données
                $success = ReservationModel::insert($randomRide->getId(), $randomPassenger->getId());

                if ($success) {
                    // Tracabilité de la réussite de l'opération pour traitement par l'interface d'évaluation
                    $reservations[] = [
                        'numero' => $i + 1,
                        'success' => true,
                        'passenger' => $randomPassenger,
                        'ride' => $randomRide
                    ];
                    continue;
                }
            }

            // GESTION DE DOUBLON / ÉCHEC : Enregistrement de l'anomalie sans faire planter l'exécution globale de la boucle
            $reservations[] = [
                'numero' => $i + 1,
                'success' => false,
                'message' => "Ce trajet est déjà réservé par ce passager."
            ];
        }

        // Retour du journal d'exécution complet à destination de la Vue (View)
        return $reservations;
    }
}
