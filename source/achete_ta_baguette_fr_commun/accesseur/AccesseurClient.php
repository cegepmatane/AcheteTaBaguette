<?php

require_once(CHEMIN_RACINE_COMMUN . "/accesseur/BaseDeDonnee.php");
require_once(CHEMIN_RACINE_COMMUN . "/modele/Client.php");

class AccesseurClient
{
    private const SUBTITUT_ID_CLIENT = ":" .Client::ID_CLIENT;
    private const SUBTITUT_NOM = ":" .Client::NOM;
    private const SUBTITUT_PRENOM = ":" .Client::PRENOM;
    private const SUBTITUT_EMAIL = ":" .Client::EMAIL;
    private const SUBTITUT_MOT_DE_PASSE = ":" .Client::MOT_DE_PASSE;
    private const SUBTITUT_RUE = ":" .Client::RUE;
    private const SUBTITUT_VILLE = ":" .Client::VILLE;
    private const SUBTITUT_PROVINCE = ":" .Client::PROVINCE;
    private const SUBTITUT_CODE_POSTAL = ":" .Client::CODE_POSTAL;
    private const SUBTITUT_PAYS = ":" .Client::PAYS;
    private const SUBTITUT_ADMINISTRATEUR = ":" .Client::ADMINISTRATEUR;

    private static $AJOUTER_CLIENT = "INSERT INTO CLIENT(".Client::NOM.", ".Client::PRENOM.", ".Client::EMAIL.", ".Client::MOT_DE_PASSE.", ".Client::RUE.", ".Client::VILLE.", ".Client::PROVINCE.", ".Client::CODE_POSTAL.", ".Client::PAYS.", ".Client::ADMINISTRATEUR.") VALUES (".self::SUBTITUT_NOM.", ".self::SUBTITUT_PRENOM.", ".self::SUBTITUT_EMAIL.", ".self::SUBTITUT_MOT_DE_PASSE.", ".self::SUBTITUT_RUE.", ".self::SUBTITUT_VILLE.", ".self::SUBTITUT_PROVINCE.", ".self::SUBTITUT_CODE_POSTAL.", ".self::SUBTITUT_PAYS.", ".self::SUBTITUT_ADMINISTRATEUR.");";
    private static $SUPPRIMER_CLIENT = "DELETE FROM CLIENT WHERE ".Client::ID_CLIENT." LIKE ".self::SUBTITUT_ID_CLIENT.";";
    private static $MISE_A_JOUR_CLIENT = "UPDATE CLIENT SET ".Client::NOM." = ".self::SUBTITUT_NOM.", ".Client::PRENOM." = ".self::SUBTITUT_PRENOM.", ".Client::EMAIL."= ".self::SUBTITUT_EMAIL.", ".Client::RUE." = ".self::SUBTITUT_RUE.", ".Client::VILLE." = ".self::SUBTITUT_VILLE.", ".Client::PROVINCE." = ".self::SUBTITUT_PROVINCE.", ".Client::CODE_POSTAL." = ".self::SUBTITUT_CODE_POSTAL.", ".Client::PAYS." = ".self::SUBTITUT_PAYS.", ".Client::ADMINISTRATEUR." = ".self::SUBTITUT_ADMINISTRATEUR." WHERE ".Client::EMAIL." LIKE ".self::SUBTITUT_ID_CLIENT.";";
    private static $RECUPERER_CLIENT_PAR_EMAIL = "SELECT ".Client::NOM.", ".Client::PRENOM.", ".Client::EMAIL.", ".Client::MOT_DE_PASSE.", ".Client::RUE.", ".Client::VILLE.", ".Client::PROVINCE.", ".Client::CODE_POSTAL.", ".Client::PAYS.", ".Client::ADMINISTRATEUR." FROM CLIENT WHERE ".Client::EMAIL." LIKE ".self::SUBTITUT_EMAIL.";";

    private static $connexion = null;
    public function __construct()
    {
        if (!self::$connexion) self::$connexion = BaseDeDonnee::getConnexion();
    }

    public function ajouterClient(Client $client)
    {
        $requete = self::$connexion->prepare(self::$AJOUTER_CLIENT);
        $requete->bindValue(self::SUBTITUT_NOM, $client->getNom(), PDO::PARAM_STR);
        $requete->bindValue(self::SUBTITUT_PRENOM, $client->getPrenom(), PDO::PARAM_STR);
        $requete->bindValue(self::SUBTITUT_EMAIL, $client->getEmail(), PDO::PARAM_STR);
        $requete->bindValue(self::SUBTITUT_MOT_DE_PASSE, sha1($client->getMotDePasse()), PDO::PARAM_STR);
        $requete->bindValue(self::SUBTITUT_RUE, $client->GetRue(), PDO::PARAM_STR);
        $requete->bindValue(self::SUBTITUT_VILLE, $client->getVille(), PDO::PARAM_STR);
        $requete->bindValue(self::SUBTITUT_PROVINCE, $client->getProvince(), PDO::PARAM_STR);
        $requete->bindValue(self::SUBTITUT_CODE_POSTAL, $client->getCodePostal(), PDO::PARAM_STR);
        $requete->bindValue(self::SUBTITUT_PAYS, $client->getPays(), PDO::PARAM_STR);
        $requete->bindValue(self::SUBTITUT_ADMINISTRATEUR, $client->getAdministrateur(), PDO::PARAM_STR);

        return $requete->execute();

        if($requete->rowCount() > 0){
            $client->setIdClient(self::$connexion->lastInsertId());
            return $client;
        }
        return false;
    }

    public function miseAJourClient(Client $client)
    {

        if($client->administrateur != 0 || $client->administrateur != 1) $client->administrateur = 0;
        $requete = self::$connexion->prepare(self::$MISE_A_JOUR_CLIENT);

        $requete->bindValue(self::SUBTITUT_NOM, $client->getNom(), PDO::PARAM_STR);
        $requete->bindValue(self::SUBTITUT_PRENOM, $client->getPrenom(), PDO::PARAM_STR);
        $requete->bindValue(self::SUBTITUT_EMAIL, $client->getEmail(), PDO::PARAM_STR);
        $requete->bindValue(self::SUBTITUT_RUE, $client->GetRue(), PDO::PARAM_STR);
        $requete->bindValue(self::SUBTITUT_VILLE, $client->getVille(), PDO::PARAM_STR);
        $requete->bindValue(self::SUBTITUT_PROVINCE, $client->getProvince(), PDO::PARAM_STR);
        $requete->bindValue(self::SUBTITUT_CODE_POSTAL, $client->getCodePostal(), PDO::PARAM_STR);
        $requete->bindValue(self::SUBTITUT_PAYS, $client->getPays(), PDO::PARAM_STR);
        $requete->bindValue(self::SUBTITUT_ADMINISTRATEUR, $client->getAdministrateur(), PDO::PARAM_INT);

        $requete->bindValue(self::SUBTITUT_ID_CLIENT, $client->getEmail(), PDO::PARAM_STR);
        $requete->execute();

        print_r($requete->errorCode());
    }

    public function supprimerClient(Client $client)
    {
        $requete = self::$connexion->prepare(self::$SUPPRIMER_CLIENT);
        $requete->bindValue(self::SUBTITUT_ID_CLIENT, $client->getidClient()); // TODO replace id par email

        $requete->execute();

        if ($requete->rowCount() > 0) return true;
        return false;
    }

    public function recupererClientParEmail($email)
    {
//        $email = $client->getEmail() ?? return false;
//        $email = $client->email;
//        if(!$client->isValide(Client::EMAIL)) return false;

        $requete = self::$connexion->prepare(self::$RECUPERER_CLIENT_PAR_EMAIL);
        $requete->bindValue(self::SUBTITUT_EMAIL, $email, PDO::PARAM_STR);
        $requete->execute();

        return new Client($requete->fetchObject());
    }
}
