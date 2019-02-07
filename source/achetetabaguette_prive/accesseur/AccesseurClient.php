<?php

require_once "BaseDeDonnee.php";
require_once "../modele/Produit.php";

class AccesseurProduit
{

    private static $AJOUT_UTILISATEUR =
        "INSERT INTO table(nomUtilisateur, prix, nbStock, nomCatégorie) VALUES (?,?,?,?,?)";

    private static $SUPPRIMER_UTILISATEUR =
        "DELETE FROM PRODUIT WHERE idProduit = ?";

    private static $MISE_A_JOUR_UTILISATEUR =
        "UPDATE PRODUIT SET nomUtilisateur = ?, prix = ?, nbStock = ?, nomCatégorie = ?) WHERE idProduit = ?;";

    private static $GET_ID_UTILISATEUR =
        "SELECT idProduit FROM PRODUIT WHERE nomUtilisateur = ?, prix = ?, nomCatégorie = ?";

        
    private static $connexion = null;

    public function __construct()
    {
        if (!self::$connexion) {
            self::$connexion = BaseDeDonnee::getConnexion();
        }
    }

    public function ajouterUtilisateur($utilisateur)
    {
        $requete = $connexion->prepare($AJOUT_UTILISATEUR);
        $requete->bindValue(1, $utilisateur->getNom(), PDO::PARAM_STR);
        $requete->bindValue(2, $utilisateur->getPrix(), PDO::PARAM_STR);
        $requete->bindValue(3, $utilisateur->getNbStock(), PDO::PARAM_INT);
        $requete->bindValue(4, $utilisateur->getNomCatégorie(), PDO::PARAM_STR);

        $requete->execute();

        if ($requete->rowCount() > 0) {
            return true;
        }

        return false;

    }

    public function supprimerProduit($utilisateur)
    {
        $requete = $connexion->prepare($SUPPRIMER_UTILISATEUR);
        $requete->bindValue(1, $utilisateur->getIdProduit);

        $requete->execute();

        if ($requete->rowCount() > 0) {
            return true;
        }

        return false;
    }

    public function getIdProduit($utilisateur)
    {
        $requete = $connexion->prepare($GET_ID_UTILISATEUR);
        $requete->bindValue(1, $utilisateur->getNom(), PDO::PARAM_STR);
        $requete->bindValue(2, $utilisateur->getPrix(), PDO::PARAM_STR);
        $requete->bindValue(3, $utilisateur->getNbStock(), PDO::PARAM_INT);
        $requete->bindValue(4, $utilisateur->getNomCatégorie(), PDO::PARAM_STR);

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

    public function miseAJourProduit($utilisateur)
    // Va mettre à jour dans le base de données le produit correspondant à l'id du produit passé en paramètre
    // Le produit de la base de données prendra les valeurs des attributs du produit passé en paramètre
    {
        $requete = $connexion->prepare($MISE_A_JOUR_UTILISATEUR);
        $requete->bindValue(1, $utilisateur->getNom(), PDO::PARAM_STR);
        $requete->bindValue(2, $utilisateur->getPrix(), PDO::PARAM_STR);
        $requete->bindValue(3, $utilisateur->getNbStock(), PDO::PARAM_INT);
        $requete->bindValue(4, $utilisateur->getNomCatégorie(), PDO::PARAM_STR);
        $requete->bindValue(5, getIdProduit($utilisateur), PDO::PARAM_STR);

        $requete->execute();

        if ($requete->rowCount() > 0) {
            return true;
        }

        return false;

    }

}
