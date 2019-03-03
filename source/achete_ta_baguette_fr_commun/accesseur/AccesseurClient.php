<?php

require_once CHEMIN_RACINE_COMMUN . "/accesseur/BaseDeDonnee.php";
require_once CHEMIN_RACINE_COMMUN . "/modele/Client.class.php";

class AccesseurClient
{
    private $AJOUTER_UTILISATEUR =
        "INSERT INTO CLIENT(nom, prenom,email,motDePasse,rue,ville,province,codePostal,pays) VALUES (:nom,:prenom,:email,:motdepasse,:rue,:ville,:province,:codePostal,:pays)";

    private static $SUPPRIMER_CLIENT =
        "DELETE FROM CLIENT WHERE idClient = :idClient";

    private $MISE_A_JOUR_UTILISATEUR =
        "UPDATE CLIENT SET nom = :nom, prenom = :prenom, email= :email, rue = :rue, ville = :ville, province = :province, codePostal = :codePostal, pays = :pays WHERE idClient = :idClient;";

    private static $GET_UTILISATEUR_PAR_ID =
        "SELECT nom, prenom, email, motDePasse, rue, ville, province, codePostal, pays, administrateur FROM CLIENT WHERE idClient like :idClient;";

    private static $RECUPERER_CLIENT_PAR_EMAIL =
        "SELECT idClient, motDePasse, administrateur FROM CLIENT WHERE email like :email;";

    private static $connexion = null;

    public function __construct()
    {
        if (!self::$connexion) {
            self::$connexion = BaseDeDonnee::getConnexion();
        }
    }

    public function ajouterClient(object $client)
    {
        $requete = self::$connexion->prepare($this->AJOUTER_UTILISATEUR);
        $requete->bindValue(":nom", $client->nom, PDO::PARAM_STR);
        $requete->bindValue(":prenom", $client->prenom, PDO::PARAM_STR);
        $requete->bindValue(":email", $client->email, PDO::PARAM_STR);
        $requete->bindValue(":motdepasse", sha1($client->mot_de_passe), PDO::PARAM_STR);
        $requete->bindValue(":rue", $client->rue, PDO::PARAM_STR);
        $requete->bindValue(":ville", $client->ville, PDO::PARAM_STR);
        $requete->bindValue(":province", $client->province, PDO::PARAM_STR);
        $requete->bindValue(":codePostal", $client->code_postal, PDO::PARAM_STR);
        $requete->bindValue(":pays", $client->pays, PDO::PARAM_STR);

        return $requete->execute();

    }

    public function supprimerClient($client)
    {
        $requete = self::$connexion->prepare($this->SUPPRIMER_CLIENT);
        $requete->bindValue(1, $client->getidClient);

        $requete->execute();

        if ($requete->rowCount() > 0) {
            return true;
        }

        return false;
    }

    public function getClientParId($idClient)
    {
        $requete = self::$connexion->prepare(self::$GET_UTILISATEUR_PAR_ID);
        $requete->bindValue(":idClient", $idClient);

        $requete->execute();

        if ($requete->rowCount() > 0) {
            $reponse = $requete->fetch();
            return $reponse;
        }
        return false;
    }

    public function miseAJourClient($client)
    {

        $requete = self::$connexion->prepare($this->MISE_A_JOUR_UTILISATEUR);
        $requete->bindValue(":nom", $client->nom, PDO::PARAM_STR);
        $requete->bindValue(":prenom", $client->prenom, PDO::PARAM_STR);
        $requete->bindValue(":email", $client->email, PDO::PARAM_STR);
        $requete->bindValue(":rue", $client->rue, PDO::PARAM_STR);
        $requete->bindValue(":ville", $client->ville, PDO::PARAM_STR);
        $requete->bindValue(":province", $client->province, PDO::PARAM_STR);
        $requete->bindValue(":codePostal", $client->code_postal, PDO::PARAM_STR);
        $requete->bindValue(":pays", $client->pays, PDO::PARAM_STR);
        $requete->bindValue(":id", $client->id, PDO::PARAM_STR);

        $requete->execute();

        if ($requete->rowCount() > 0) {
            return true;
        }

        return false;

    }

    public function recupererClientParEmail($emailClient)
    {
        $requete = self::$connexion->prepare(self::$RECUPERER_CLIENT_PAR_EMAIL);
        $requete->bindValue(":email", $emailClient, PDO::PARAM_STR);
        $requete->execute();

        if ($requete->rowCount() > 0) {
            $reponse = $requete->fetch();
            return $reponse;
        }
        return false;

        //return new Client($requete->fetchObject());
    }
}
