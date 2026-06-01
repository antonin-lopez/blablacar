<?php
require_once ROOT . '/app/model/Model.php';
require_once ROOT . '/app/model/Reservation.php';
require_once ROOT . '/app/model/Ride.php';
require_once ROOT . '/app/model/User.php';
require_once ROOT . '/app/model/ReservationModel.php';

class ExaminerModel
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
    
    public static function addTenRandomReservations(): array
    {
        $results = [
            'reservations' => []
        ];
        
        $passengers = self::getAllPassengers();
        if (empty($passengers)) {
            return [
                'error' => 'Aucun passager trouvé dans la base de données',
                'reservations' => []
            ];
        }
        
        $activeRides = self::getActiveRides();
        if (empty($activeRides)) {
            return [
                'error' => 'Aucun trajet actif trouvé dans la base de données',
                'reservations' => []
            ];
        }
        
        for ($i = 0; $i < 10; $i++) {
            $maxAttempts = 30;
            $added = false; 
            
            for ($attempt = 0; $attempt < $maxAttempts; $attempt++) {
                $randomPassenger = $passengers[array_rand($passengers)];
                $randomRide = $activeRides[array_rand($activeRides)];
                
                if (!self::reservationExists($randomRide->getId(), $randomPassenger->getId())) {
                    $success = ReservationModel::insert($randomRide->getId(), $randomPassenger->getId());
                    
                    if ($success) {
                        $results['reservations'][] = [
                            'numero' => $i + 1,
                            'success' => true,
                            'passenger_nom' => $randomPassenger->getLastName(),
                            'passenger_prenom' => $randomPassenger->getFirstName(),
                            'passenger_id' => $randomPassenger->getId(),
                            'ride_depart' => $randomRide->getDepartureCity(),
                            'ride_arrivee' => $randomRide->getArrivalCity(),
                            'ride_id' => $randomRide->getId(),
                            'driver_nom' => $randomRide->getDriverFullName(),
                            'date_depart' => $randomRide->getDepartureDate(),
                            'heure_depart' => $randomRide->getDepartureTime()
                        ];
                        $added = true;
                        break;
                    }
                }
            }
            
            if (!$added) {
                $results['reservations'][] = [
                    'numero' => $i + 1,
                    'success' => false,
                    'message' => 'Impossible d\'ajouter cette réservation après ' . $maxAttempts . ' tentatives'
                ];
            }
        }
        
        return $results;
    }
}
?>