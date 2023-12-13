<?php

class Etudiant
{
    private string $nom;

    public function __construct()
    {
        $this->nom = 'INCONNU';
    }

    public function getNom(): string
    {
        return $this->nom;
    }
    public function setNom(string $nom)
    {
        $this->nom = $nom;
    }
}
