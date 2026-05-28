<?php

class City
{
    private int $id;
    private string $nom;

    public function __construct() {}

    public function getId(): int { return $this->id; }
    public function getName(): string { return $this->nom; }
}