<?php

class User
{
    private int $id;
    private string $nom;
    private string $prenom;
    private string $role;
    private string $login;
    private string $password;
    private float $solde;

    public function __construct() {}

    public function getId(): int { return $this->id; }
    public function getLastName(): string { return $this->nom; }
    public function getFirstName(): string { return $this->prenom; }
    public function getRole(): string { return $this->role; }
    public function getLogin(): string { return $this->login; }
    public function getPassword(): string { return $this->password; }
    public function getBalance(): float { return $this->solde; }

    public function getFullName(): string
    {
        return trim($this->getFirstName() . ' ' . $this->getLastName());
    }
}