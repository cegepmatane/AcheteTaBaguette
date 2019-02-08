<?php

require_once "BaseDeDonnee.php";
require_once "../modele/Client.class.php";

class AccesseurClient
{

    private static $AJOUTER_FACTURE =
        "INSERT INTO FACTURE(idClient, idFacture, nomFacture, montantFacture) VALUES (?,?,?,?)";

    private static $SUPPRIMER_FACTURE =
        "DELETE FROM FACTURE WHERE idFacture = ?";

    private static $MISE_A_JOUR_FACTURE =
        "UPDATE FACTURE SET nomFacture = ?, montantFacture = ?) WHERE idFacture = ?;";

    private static $GET_ID_CLIENT =
        "SELECT idClient FROM FACTURE WHERE idFacture = ?";

    private static $GET_ID_FACTURE =
        "SELECT idFacture FROM FACTURE WHERE idClient = ? AND nomFacture= ?";

    private static $connexion = null;

    public function __construct()
    {
        if (!self::$connexion) {
            self::$connexion = BaseDeDonnee::getConnexion();
        }
    }

    public function ajouterFacture($facture)
    {
        $requete = $connexion->prepare($AJOUTER_FACTURE);
        $requete->bindValue(1, $facture->getIdClient(), PDO::PARAM_STR);
        $requete->bindValue(2, $facture->getIdFacture(), PDO::PARAM_STR);
        $requete->bindValue(3, $facture->getNomFacture(), PDO::PARAM_STR);
        $requete->bindValue(4, $facture->getMontantFacture(), PDO::PARAM_STR);

        $requete->execute();

        if ($requete->rowCount() > 0) {
            return true;
        }

        return false;

    }

    public function supprimerFacture($facture)
    {
        $requete = $connexion->prepare($SUPPRIMER_FACTURE);
        $requete->bindValue(1, $facture->getIdFacture());

        $requete->execute();

        if ($requete->rowCount() > 0) {
            return true;
        }

        return false;
    }

    public function getIdClient($facture)
    {
        $requete = $connexion->prepare($GET_ID_CLIENT);
        $requete->bindValue(1, $facture->getIdFacture(), PDO::PARAM_STR);

        $requete->execute();

        if ($requete->rowCount() > 0) {
            $reponse = $requete->fetch();
            if (!is_array($reponse)) {
                echo "Erreur getIdclient (AccesseurFacture.php) !";
            }
            if (is_array($reponse)) {
                return $reponse["idClient"];
            }
        }
    }

    public function getIdFacture($facture)
    {
        $requete = $connexion->prepare($GET_ID_CLIENT);
        $requete->bindValue(1, $facture->getIdClient(), PDO::PARAM_STR);

        $requete->execute();

        if ($requete->rowCount() > 0) {
            $reponse = $requete->fetch();
            if (!is_array($reponse)) {
                echo "Erreur getIdFacture (AccesseurFacture.php) !";
            }
            if (is_array($reponse)) {
                return $reponse["idClient"];
            }
        }
    }

    public function miseAJourFacture($facture)
    // Va mettre à jour dans le base de données le CLIENT correspondant à l'id du CLIENT passé en paramètre
    // Le CLIENT de la base de données prendra les valeurs des attributs du CLIENT passé en paramètre
    {
        $requete = $connexion->prepare($MISE_A_JOUR_FACTURE);
        $requete->bindValue(1, $facture->getNom(), PDO::PARAM_STR);
        $requete->bindValue(2, $facture->getmontantFacture(), PDO::PARAM_STR);
        $requete->bindValue(3, $facture->getIdFacture(), PDO::PARAM_STR);

        $requete->execute();

        if ($requete->rowCount() > 0) {
            return true;
        }

        return false;

    }

}
