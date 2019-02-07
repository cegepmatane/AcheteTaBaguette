<?php

class Client
{
    private $nomClient;
    private $adresse;
    private $email;
    private $idClient;

    public function __construct($nomClient, $adresse, $email, $idClient)
    {
        $this->nomUtilisateur = $nomClient;
        $this->adresse = $adresse;
        $this->email = $email;
        $this->idClient = $idClient;
    }

    public function setNomUtilisateur($nomClient)
    {
        $this->nomUtilisateur = $nomClient;
    }

    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;
    }

    public function setEmail($email)
    {
        $this->email = $email;
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
