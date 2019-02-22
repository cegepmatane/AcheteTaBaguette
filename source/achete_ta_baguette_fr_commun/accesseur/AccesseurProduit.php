<?php

require_once "BaseDeDonnee.php";
require_once CHEMIN_RACINE_COMMUN . "/modele/Produit.class.php";

class AccesseurProduit
{

    private static $AJOUT_PRODUIT =
        "INSERT INTO PRODUIT(nomProduit, prix, stock, idCategorie) VALUES (:nomProduit,:prix,:stock,:idCategorie);";

    private static $SUPPRIMER_PRODUIT =
        "DELETE FROM PRODUIT WHERE idProduit = :idProduit;";

    private static $MISE_A_JOUR_PRODUIT =
        "UPDATE PRODUIT SET nomProduit = :nomProduit, prix = :prix, stock = :stock, idCategorie = :idCategorie) WHERE idProduit = :idProduit;";

    private static $GET_ID_PRODUIT =
        "SELECT idProduit FROM PRODUIT WHERE nomProduit = :nomProduit, prix = :prix, idCategorie = :idCategorie";

    private static $RECUPERER_LISTE_PRODUITS =
        "SELECT PRODUIT.idProduit, PRODUIT.nom, PRODUIT.description, PRODUIT.prix, PRODUIT.stock, PRODUIT.idCategorie, PRODUIT.srcImage FROM PRODUIT; ";

    private static $RECUPERER_PRODUIT_PAR_ID =
        "SELECT nom, description, prix, stock, idCategorie, srcImage FROM PRODUIT WHERE idProduit LIKE :idProduit;";

    private static $RECUPERER_PRODUIT_PAR_CATEGORIE =
        "SELECT idProduit, nom, description, prix, srcImage FROM PRODUIT WHERE idCategorie LIKE :idCategorie;";

    private static $RECUPERER_PRODUIT_NOM_SIMILAIRE = "SELECT * FROM PRODUIT WHERE CONTAINS(nom, 'NEAR(:nomProduit)';";

    private static $connexion = null;

    public function __construct()
    {
        if (!self::$connexion) {
            self::$connexion = BaseDeDonnee::getConnexion();
        }
    }

    public function recupererProduitParId($idProduit)
    {
        $requete = self::$connexion->prepare(self::$RECUPERER_PRODUIT_PAR_ID);
        $requete->bindValue(":idProduit", $idProduit);

        $requete->execute();

        if ($requete->rowCount() > 0) {
            $reponse = $requete->fetch();
            return $reponse;
        } else {
            echo "Aucune données trouvés !";
        }
    }

    public function recupererProduitParType($idProduit)
    {
        $requete = self::$connexion->prepare(self::$RECUPERER_PRODUIT_PAR_CATEGORIE);
        $requete->bindValue(":idCategorie", $idProduit);

        $requete->execute();

        if ($requete->rowCount() > 0) {
            $listeEnregistrement = $requete->fetchAll(PDO::FETCH_OBJ);

            foreach ($listeEnregistrement as $enregistrement) {

                $listeProduits[] = new Produit($enregistrement);

            }

            return $listeProduits;

        } else {
            echo "Aucune données trouvés !";
            return $reponse = ["isConnected" => false];
        }
    }

    public function ajouterProduit($produit)
    {
        $requete = self::$connexion->prepare($AJOUT_PRODUIT);
        $requete->bindValue(":nomProduit", $produit->getNom(), PDO::PARAM_STR);
        $requete->bindValue(":prix", $produit->getPrix(), PDO::PARAM_STR);
        $requete->bindValue(":stock", $produit->getNbStock(), PDO::PARAM_INT);
        $requete->bindValue(":idCategorie", $produit->getNomCatégorie(), PDO::PARAM_STR);

        $requete->execute();

        if ($requete->rowCount() > 0) {
            return true;
        }

        return false;

    }

    public function supprimerProduit($produit)
    {
        $requete = self::$connexion->prepare($SUPPRIMER_PRODUIT);
        $requete->bindValue(":idProduit", $produit->getIdProduit);

        $requete->execute();

        if ($requete->rowCount() > 0) {
            return true;
        }

        return false;
    }

    public function recupererListeProduits()
    {

        $listeProduits = [];

        $requete = self::$connexion->prepare(self::$RECUPERER_LISTE_PRODUITS);

        $requete->execute();

        $listeEnregistrement = $requete->fetchAll(PDO::FETCH_OBJ);

        foreach ($listeEnregistrement as $enregistrement) {

            $listeProduits[] = new Produit($enregistrement);

        }

        return $listeProduits;

    }

    public function getIdProduit($produit)
    {
        $requete = self::$connexion->prepare($GET_ID_PRODUIT);
        $requete->bindValue(":nomProduit", $produit->getNom(), PDO::PARAM_STR);
        $requete->bindValue(":prix", $produit->getPrix(), PDO::PARAM_STR);
        $requete->bindValue(":idCategorie", $produit->getNomCatégorie(), PDO::PARAM_INT);

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
        $requete = self::$connexion->prepare($MISE_A_JOUR_PRODUIT);
        $requete->bindValue(":nomProduit", $produit->getNom(), PDO::PARAM_STR);
        $requete->bindValue(":prix", $produit->getPrix(), PDO::PARAM_STR);
        $requete->bindValue(":stock", $produit->getNbStock(), PDO::PARAM_INT);
        $requete->bindValue(":idCategorie", $produit->getNomCatégorie(), PDO::PARAM_STR);
        $requete->bindValue(":idProduit", getIdProduit($produit), PDO::PARAM_STR);

        $requete->execute();

        if ($requete->rowCount() > 0) {
            return true;
        }

        return false;

    }

}
