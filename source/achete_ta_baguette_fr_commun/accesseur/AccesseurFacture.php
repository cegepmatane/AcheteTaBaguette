<?php

require_once "BaseDeDonnee.php";
require_once "../modele/Client.php";
require_once "../modele/Facture.php";

class AccesseurClient
{

    private static $AJOUTER_FACTURE =
    "INSERT INTO FACTURE(" . Facture::ID_CLIENT . ", " . Facture::ID_FACTURE . ", " . Facture::NOM_FACTURE . ", " . Facture::MONTANT_FACTURE . ") VALUES (:idClient, :idFacture, :nomFacture, :montantFacture)";

    private static $SUPPRIMER_FACTURE =
    "DELETE FROM FACTURE WHERE " . Facture::ID_FACTURE . " = :idFacture";

    private static $MISE_A_JOUR_FACTURE =
    "UPDATE FACTURE SET " . Facture::NOM_FACTURE . " = :nomFacture, " . Facture::MONTANT_FACTURE . " = :montantFacture) WHERE " . Facture::ID_FACTURE . " = :idFacture;";

    private static $GET_ID_CLIENT =
    "SELECT idClient FROM FACTURE WHERE " . Facture::ID_FACTURE . " = :idFacture";

    private static $GET_ID_FACTURE =
    "SELECT idFacture FROM FACTURE WHERE " . Facture::ID_CLIENT . " = :idClient AND nomFacture= :nomFacture";

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
        $requete->bindValue(":idClient", $facture->getIdClient(), PDO::PARAM_INT);
        $requete->bindValue(":idFacture", $facture->getIdFacture(), PDO::PARAM_INT);
        $requete->bindValue(":nomFacture", $facture->getNomFacture(), PDO::PARAM_INT);
        $requete->bindValue(":montantFacture", $facture->getMontantFacture(), PDO::PARAM_STR);

        $requete->execute();

        if ($requete->rowCount() > 0) {
            return true;
        }

        return false;

    }

    public function supprimerFacture($facture)
    {
        $requete = $connexion->prepare($SUPPRIMER_FACTURE);
        $requete->bindValue(":idFacture", $facture->getIdFacture());

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
        $requete->bindValue(":idFacture", $facture->getIdClient(), PDO::PARAM_STR);

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
        $requete->bindValue(":nomFacture", $facture->getNom(), PDO::PARAM_STR);
        $requete->bindValue(":montantFacture", $facture->getmontantFacture(), PDO::PARAM_STR);
        $requete->bindValue(":idFacture", $facture->getIdFacture(), PDO::PARAM_STR);

        $requete->execute();

        if ($requete->rowCount() > 0) {
            return true;
        }

        return false;

    }

}
