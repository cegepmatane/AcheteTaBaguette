<?php

require_once "BaseDeDonnee.php";
require_once "../modele/Produit.php";

class AccesseurProduit
{

    private static $AJOUT_PRODUIT =
        "INSERT INTO PRODUIT(nomProduit, prix, nbStock, nomCatégorie) VALUES (?,?,?,?,?)";

    private static $SUPPRIMER_PRODUIT =
        "DELETE FROM PRODUIT WHERE idProduit = ?";

    private static $MISE_A_JOUR_PRODUIT =
        "UPDATE PRODUIT SET nomProduit = ?, prix = ?, nbStock = ?, nomCatégorie = ?) WHERE idProduit = ?;";

    private static $GET_ID_PRODUIT =
        "SELECT idProduit FROM PRODUIT WHERE nomProduit = ?, prix = ?, nomCatégorie = ?";


    private static $connexion = null;

    public function __construct()
    {
        if (!self::$connexion) {
            self::$connexion = BaseDeDonnee::getConnexion();
        }
    }

    public function ajouterProduit($produit)
    {
        $requete = $connexion->prepare($AJOUT_PRODUIT);
        $requete->bindValue(1, $produit->getNom(), PDO::PARAM_STR);
        $requete->bindValue(2, $produit->getPrix(), PDO::PARAM_STR);
        $requete->bindValue(3, $produit->getNbStock(), PDO::PARAM_INT);
        $requete->bindValue(4, $produit->getNomCatégorie(), PDO::PARAM_STR);

        $requete->execute();

        if ($requete->rowCount() > 0) {
            return true;
        }

        return false;

    }

    public function supprimerProduit($produit)
    {
        $requete = $connexion->prepare($SUPPRIMER_PRODUIT);
        $requete->bindValue(1, $produit->getIdProduit);

        $requete->execute();

        if ($requete->rowCount() > 0) {
            return true;
        }

        return false;
    }

    public function getIdProduit($produit)
    {
        $requete = $connexion->prepare($GET_ID_PRODUIT);
        $requete->bindValue(1, $produit->getNom(), PDO::PARAM_STR);
        $requete->bindValue(2, $produit->getPrix(), PDO::PARAM_STR);
        $requete->bindValue(3, $produit->getNbStock(), PDO::PARAM_INT);
        $requete->bindValue(4, $produit->getNomCatégorie(), PDO::PARAM_STR);

        $requete->execute();

        if ($requete->rowCount() > 0) {
            $reponse = $requete->fetch();
            if (!is_array($reponse)) {
                echo "Erreur getIdProduit (AccesseurProduit.php) !";
            }
            if (is_array($reponse)) {
                return $reponse["idProduit"];
            }
        }
    }

    public function miseAJourProduit($produit)
    // Va mettre à jour dans le base de données le produit correspondant à l'id du produit passé en paramètre
    // Le produit de la base de données prendra les valeurs des attributs du produit passé en paramètre
    {
        $requete = $connexion->prepare($MISE_A_JOUR_PRODUIT);
        $requete->bindValue(1, $produit->getNom(), PDO::PARAM_STR);
        $requete->bindValue(2, $produit->getPrix(), PDO::PARAM_STR);
        $requete->bindValue(3, $produit->getNbStock(), PDO::PARAM_INT);
        $requete->bindValue(4, $produit->getNomCatégorie(), PDO::PARAM_STR);
        $requete->bindValue(5, getIdProduit($produit), PDO::PARAM_STR);

        $requete->execute();

        if ($requete->rowCount() > 0) {
            return true;
        }

        return false;

    }

}
