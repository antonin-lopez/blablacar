<?php
require_once ROOT . '/app/model/Model.php';
require_once ROOT . '/app/model/Reservation.php';

class ReservationModel
{
    public static function readByPassengerId(int $passengerId): array
    {
        $db = Model::getInstance();

        $sql = "SELECT r.*,
                       t.date_depart,
                       t.heure_depart,
                       u.nom AS nom_conducteur, 
                       u.prenom AS prenom_conducteur,
                       v_dep.nom AS ville_depart, 
                       v_arr.nom AS ville_arrivee,
                       v.marque AS marque_vehicule,
                       v.modele AS modele_vehicule,
                       v.immatriculation
                FROM reservation r
                JOIN trajet t ON r.trajet_id = t.id
                JOIN utilisateur u ON t.conducteur_id = u.id
                JOIN ville v_dep ON t.ville_depart = v_dep.id
                JOIN ville v_arr ON t.ville_arrivee = v_arr.id
                JOIN vehicule v ON t.vehicule_id = v.id
                WHERE r.passager_id = :passenger_id";

        $stmt = $db->prepare($sql);
        $stmt->execute(['passenger_id' => $passengerId]);

        return $stmt->fetchAll(PDO::FETCH_CLASS, 'Reservation');
    }

    public static function insert(int $rideId, int $passengerId): float
    {
        $db = Model::getInstance();

        try {
            $db->beginTransaction();

            // Récupérer le prix du trajet sélectionné
            $sqlRide = "SELECT prix FROM trajet WHERE id = :ride_id";
            $stmtRide = $db->prepare($sqlRide);
            $stmtRide->execute(['ride_id' => $rideId]);
            $price = $stmtRide->fetchColumn();

            if ($price === false) {
                throw new Exception("Le trajet sélectionné n'existe pas.");
            }
            $price = (float)$price;

            // Récupérer le solde actuel du passager
            $sqlUser = "SELECT solde FROM utilisateur WHERE id = :user_id FOR UPDATE";
            $stmtUser = $db->prepare($sqlUser);
            $stmtUser->execute(['user_id' => $passengerId]);
            $balance = $stmtUser->fetchColumn();

            if ($balance === false) {
                throw new Exception("L'utilisateur passager n'existe pas.");
            }
            $balance = (float)$balance;

            // Vérification stricte du solde disponible
            if ($balance < $price) {
                throw new Exception("Solde insuffisant pour réserver ce trajet.");
            }

            // Insérer la ligne de réservation
            $sqlInsert = "INSERT INTO reservation (id, trajet_id, passager_id)
                          VALUES ((SELECT COALESCE(MAX(id), 0) + 1 FROM reservation r2), :ride_id, :passenger_id)";
            $stmtInsert = $db->prepare($sqlInsert);
            $stmtInsert->execute([
                'ride_id'      => $rideId,
                'passenger_id' => $passengerId
            ]);

            // Débiter le solde du passager
            $sqlUpdateBalance = "UPDATE utilisateur SET solde = solde - :price WHERE id = :user_id";
            $stmtUpdateBalance = $db->prepare($sqlUpdateBalance);
            $stmtUpdateBalance->execute([
                'price'   => $price,
                'user_id' => $passengerId
            ]);

            $db->commit();
            return $price;
        } catch (Exception $e) {
            if ($db->inTransaction()) {
                $db->rollBack();
            }
            throw $e;
        }
    }
}
