<?php

class Client
{
    private $idClient;
    private $idFacture;
    private $nomFacture;
    private $montantFacture;

    public function __construct($idClient, $nomFacture, $montantFacture)
    {
        $this->idClient = $idClient;
        $this->nomFacture = $nomFacture;
        $this->montantFacture = $montantFacture;
    }

    public function setNomUtilisateur($idClient)
    {
        $this->nomUtilisateur = $idClient;
    }

    public function setAdresse($nomFacture)
    {
        $this->adresse = $nomFacture;
    }

    public function setEmail($montantFacture)
    {
        $this->email = $montantFacture;
    }

    public function getNomUtilisateur()
    {
        return $this->nomUtilisateur;
    }
    public function getAdresse()
    {
        return $this->adresse;
    }
    public function getEmail()
    {
        return $this->email;
    }
    public function getidClient()
    {
        return $this->idClient;
    }

}
