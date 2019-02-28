<?php

require_once CHEMIN_RACINE_COMMUN . "/accesseur/BaseDeDonnee.php";
require_once CHEMIN_RACINE_COMMUN . "/modele/Client.class.php";

class AccesseurClient
{
    private static $AJOUTER_UTILISATEUR =
        "INSERT INTO CLIENT(nom, prenom,naissance,email,motDePasse,rue,ville,province,codePostal,pays) VALUES (:nom,:prenom,:naissance,:email,:motdepasse,:rue,:ville,:province,:codePostal,:pays)";

    private static $SUPPRIMER_CLIENT =
        "DELETE FROM CLIENT WHERE idClient = :idClient";

    private static $MISE_A_JOUR_UTILISATEUR =
        "UPDATE CLIENT SET nom = :nom, prenom = :prenom, naissance= :naissance, email= :email, rue = :rue, ville = :ville, province = :province, codePostal = :codePostal, pays = :pays WHERE idClient = :idClient;";

    private static $GET_UTILISATEUR_PAR_ID =
        "SELECT nom, prenom, naissance, email, motDePasse, rue, ville, province, codePostal, pays, administrateur FROM CLIENT WHERE idClient like :idClient;";

    // N'est utilisé nul part
    private static $GET_UTILISATEUR_PAR_EMAIL =
    //Remplacer idClient par id ?
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
        $newdate = date('Y-m-d', strtotime($client->date_de_naissance));
        $requete->bindValue("naissance", $newdate, PDO::PARAM_STR);
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

    public function getClientParEmail($emailClient)
    {
        $requete = self::$connexion->prepare(self::$GET_UTILISATEUR_PAR_EMAIL);
        $requete->bindValue(":email", $emailClient);

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
        $newdate = date('Y-m-d', strtotime($client->date_de_naissance));
        $requete->bindValue(":naissance", $newdate, PDO::PARAM_STR);
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

    public function verifierClient($client)
    {
        $requete = "SELECT idClient, motDePasse, administrateur FROM CLIENT WHERE email = '$client->email' ORDER BY idClient DESC LIMIT 1";
        $stmt = self::$connexion->query($requete);
        $resultat = $stmt->fetch();
        if ($stmt->execute()) {
            while ($row = $stmt->fetch()) {
                if (sha1($client->mot_De_Passe) == print_r($row->motDePasse, true)) {
                    $resultat->idClient = print_r($row->idClient, true);
                    $resultat->motDePasse = print_r($row->motDePasse, true);
                    $resultat->administrateur = print_r($row->administrateur, true);
                } else {
                    $resultat = false;
                }

            }
        }
        return $resultat;
    }
}
