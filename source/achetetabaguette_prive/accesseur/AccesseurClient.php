<?php

require_once "BaseDeDonnee.php";
require_once "../modele/Client.class.php";

class AccesseurClient
{

    private static $AJOUTER_UTILISATEUR =
        "INSERT INTO CLIENT(nomClient, adresse, email) VALUES (?,?,?)";

    private static $SUPPRIMER_CLIENT =
        "DELETE FROM CLIENT WHERE idClient = ?";

    private static $MISE_A_JOUR_UTILISATEUR =
        "UPDATE CLIENT SET nomClient = ?, adresse = ?, email = ?) WHERE idClient = ?;";

    private static $GET_ID_UTILISATEUR =
        "SELECT idClient FROM CLIENT WHERE nomClient = ?, adresse = ?, email = ?";

        
    private static $connexion = null;

    public function __construct()
    {
        if (!self::$connexion) {
            self::$connexion = BaseDeDonnee::getConnexion();
        }
    }

    public function ajouterClient($client)
    {
        $requete = $connexion->prepare($AJOUTER_UTILISATEUR);
        $requete->bindValue(1, $client->getNom(), PDO::PARAM_STR);
        $requete->bindValue(2, $client->getAdresse(), PDO::PARAM_STR);
        $requete->bindValue(3, $client->getEmail(), PDO::PARAM_STR);

        $requete->execute();

        if ($requete->rowCount() > 0) {
            return true;
        }

        return false;

    }

    public function supprimerClient($client)
    {
        $requete = $connexion->prepare($SUPPRIMER_CLIENT);
        $requete->bindValue(1, $client->getidClient);

        $requete->execute();

        if ($requete->rowCount() > 0) {
            return true;
        }

        return false;
    }

    public function getIdClient($client)
    {
        $requete = $connexion->prepare($GET_ID_UTILISATEUR);
        $requete->bindValue(1, $client->getNom(), PDO::PARAM_STR);
        $requete->bindValue(2, $client->getAdresse(), PDO::PARAM_STR);
        $requete->bindValue(3, $client->getEmail(), PDO::PARAM_STR);

        $requete->execute();

        if ($requete->rowCount() > 0) {
            $reponse = $requete->fetch();
            if (!is_array($reponse)) {
                echo "Erreur getidClient (AccesseurCLIENT.php) !";
            }
            if (is_array($reponse)) {
                return $reponse["idClient"];
            }
        }
    }

    public function miseAJourClient($client)
    // Va mettre à jour dans le base de données le CLIENT correspondant à l'id du CLIENT passé en paramètre
    // Le CLIENT de la base de données prendra les valeurs des attributs du CLIENT passé en paramètre
    {
        $requete = $connexion->prepare($MISE_A_JOUR_UTILISATEUR);
        $requete->bindValue(1, $client->getNom(), PDO::PARAM_STR);
        $requete->bindValue(2, $client->getAdresse(), PDO::PARAM_STR);
        $requete->bindValue(3, $client->getEmail(), PDO::PARAM_STR);
        $requete->bindValue(5, getidClient($client), PDO::PARAM_STR);

        $requete->execute();

        if ($requete->rowCount() > 0) {
            return true;
        }

        return false;

    }

}
