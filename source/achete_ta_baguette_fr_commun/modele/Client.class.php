<?php

class Client
{
    private $nomClient;
    private $prenom;
    private $adresse;
    private $email;
	  private $dateDeNaissance;
    private $motDePasse;
    private $motDePasseVerif;

    public function __construct($nomClient, $prenom, $adresse, $email, $dateDeNaissance, $motDePasse, $motDePasseVerif)
    {
        $this->nomClient = $nomClient;
        $this->prenom = $prenom;
        $this->adresse = $adresse;
        $this->email = $email;
		    $this->dateDeNaissance = $dateDeNaissance;
        $this->motDePasse = $motDePasse;
        $this->motDePasseVerif = $motDePasseVerif;

	}


	/* Depuis le cookbook : */
	 private const PATERN_NOM_PROPRE =
        "/^[A-Za-z\x{00C0}-\x{00FF}]" .
        "[A-Za-z\x{00C0}-\x{00FF}\'\-]+([\ A-Za-z\x{00C0}-\x{00FF}]" .
        "[A-Za-z\x{00C0}-\x{00FF}\'\-]+)*/u";

   public static function validerClient($client){
      if(!$client->validerNomPropre($client->nomClient)) return false;
      if(!$client->validerNomPropre($client->prenom)) return false;
      if(!$client->validerMotDePasse($client->motDePasse,$client->motDePasseVerif)) return false;
      return true;
    }

		private static function validerNomPropre($nom){

        /*
        https://andrewwoods.net/blog/2018/name-validation-regex/

        Remove Digits and Underscores
        Allow Multiple Words
        Add Apostrophe and Hyphen Support
        Adding Extended ASCII Character Support
        */

        return preg_match(self::PATERN_NOM_PROPRE, $nom);
    }

    public static function envoyerClientVersBDD($client){

      require_once "C:/wamp64/www/AcheteTaBaguette/AcheteTaBaguette/source/achete_ta_baguette_fr_commun/accesseur/BaseDeDonnee.php";
      $uneBDD = new BaseDeDonnee();
      $pdo = $uneBDD->getConnexion();
      $sql = "INSERT INTO CLIENT (nomClient,email,prenom,adresse,dateDeNaissance) VALUES(?,?,?,?,?)";
      $pdo->prepare($sql)->execute([$client->nomClient,$client->email,$client->prenom, $client->addresse,$client->dateDeNaissance]);


    }

    private static function validerMotDePasse($password,$passwordCheck){
      if($password == $passwordCheck) return true;
      else return false;
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
