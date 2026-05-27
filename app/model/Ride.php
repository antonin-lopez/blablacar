<?php

class Ride
{
    private int $id;
    private int $ville_depart;
    private int $ville_arrivee;
    private int $conducteur_id;
    private int $vehicule_id;
    private float $prix;
    private string $date_depart;
    private string $heure_depart;
    private string $statut;

    private ?string $nom_ville_depart = null;
    private ?string $nom_ville_arrivee = null;
    private ?string $nom_conducteur = null;
    private ?string $prenom_conducteur = null;

    public function __construct() {}

    public function getId(): int { return $this->id; }
    public function getDepartureCityId(): int { return $this->ville_depart; }
    public function getArrivalCityId(): int { return $this->ville_arrivee; }
    public function getDriverId(): int { return $this->conducteur_id; }
    public function getVehicleId(): int { return $this->vehicule_id; }
    public function getPrice(): float { return $this->prix; }
    public function getDepartureDate(): string { return $this->date_depart; }
    public function getDepartureTime(): string { return $this->heure_depart; }
    public function getStatus(): string { return $this->statut; }

    public function getDepartureCity(): string { return $this->nom_ville_depart ?? ''; }
    public function getArrivalCity(): string { return $this->nom_ville_arrivee ?? ''; }
    public function getDriverFirstName(): string { return $this->prenom_conducteur ?? ''; }
    public function getDriverLastName(): string { return $this->nom_conducteur ?? ''; }
    
    public function getDriverFullName(): string
    {
        return trim($this->getDriverFirstName() . ' ' . $this->getDriverLastName());
    }
}