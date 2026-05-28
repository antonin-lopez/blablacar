<?php

class Reservation
{
    private int $id;
    private int $trajet_id;
    private int $passager_id;

    private ?string $date_depart = null;
    private ?string $heure_depart = null;
    private ?string $nom_conducteur = null;
    private ?string $prenom_conducteur = null;
    private ?string $ville_depart = null;
    private ?string $ville_arrivee = null;
    private ?string $marque_vehicule = null;
    private ?string $modele_vehicule = null;
    private ?string $immatriculation = null;

    public function __construct() {}

    public function getId(): int { return $this->id; }
    public function getRideId(): int { return $this->trajet_id; }
    public function getPassengerId(): int { return $this->passager_id; }

    public function getDepartureDate(): string { return $this->date_depart ?? ''; }
    public function getDepartureTime(): string { return $this->heure_depart ?? ''; }
    public function getDriverFirstName(): string { return $this->prenom_conducteur ?? ''; }
    public function getDriverLastName(): string { return $this->nom_conducteur ?? ''; }
    public function getDepartureCity(): string { return $this->ville_depart ?? ''; }
    public function getArrivalCity(): string { return $this->ville_arrivee ?? ''; }
    public function getVehicleBrand(): string { return $this->marque_vehicule ?? ''; }
    public function getVehicleModel(): string { return $this->modele_vehicule ?? ''; }
    public function getLicensePlate(): string { return $this->immatriculation ?? ''; }

    public function getDriverFullName(): string
    {
        return trim($this->getDriverFirstName() . ' ' . $this->getDriverLastName());
    }

    public function getVehicleFullName(): string
    {
        return trim($this->getVehicleBrand() . ' ' . $this->getVehicleModel());
    }
}