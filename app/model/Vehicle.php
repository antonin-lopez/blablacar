<?php

class Vehicle
{
    private int $id;
    private string $marque;
    private string $modele;
    private int $annee;
    private string $immatriculation;
    private int $proprietaire_id;

    private ?string $nom = null;
    private ?string $prenom = null;

    public function __construct() {}

    public function getId(): int { return $this->id; }
    public function getBrand(): string { return $this->marque; }
    public function getModel(): string { return $this->modele; }
    public function getYear(): int { return $this->annee; }
    public function getLicensePlate(): string { return $this->immatriculation; }
    public function getOwnerId(): int { return $this->proprietaire_id; }

    public function getOwnerFirstName(): string { return $this->prenom ?? ''; }
    public function getOwnerLastName(): string { return $this->nom ?? ''; }

    public function getOwnerFullName(): string
    {
        return trim($this->getOwnerFirstName() . ' ' . $this->getOwnerLastName());
    }
}