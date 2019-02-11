<?php

class Client
{
    private $nomClient;
    private $adresse;
    private $email;
    private $idClient;
	private $dateDeNaissance

    public function __construct($nomClient, $adresse, $email, $idClient, $dateDeNaissance)
    {
        $this->nomUtilisateur = $nomClient;
        $this->adresse = $adresse;
        $this->email = $email;
        $this->idClient = $idClient;
		$this->dateDeNaissance = $dateDeNaissance;
	}
	
	
	/* Depuis le cookbook : */
	private const PATERN_NOM_PROPRE =
        "/^[A-Za-z\x{00C0}-\x{00FF}]" .
        "[A-Za-z\x{00C0}-\x{00FF}\'\-]+([\ A-Za-z\x{00C0}-\x{00FF}]" .
        "[A-Za-z\x{00C0}-\x{00FF}\'\-]+)*/u";
		
		private static validerNomPropre($nom){

        /*
        https://andrewwoods.net/blog/2018/name-validation-regex/

        Remove Digits and Underscores
        Allow Multiple Words
        Add Apostrophe and Hyphen Support
        Adding Extended ASCII Character Support
        */

        if (preg_match(self::PATERN_NOM_PROPRE, $nom)) return true;

        return false;
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
	
	public function setDateDeNaissance($dateDeNaissance){
		return $this->dateDeNaissance;
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
	
	public function getDateDeNaissance(){
		return $this->dateDeNaissance;
	}
}
