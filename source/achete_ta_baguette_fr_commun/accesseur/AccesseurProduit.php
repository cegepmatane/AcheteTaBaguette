<?php

require_once "BaseDeDonnee.php";
require_once CHEMIN_RACINE_COMMUN . "/modele/Produit.php";

class AccesseurProduit
{

    private static $AJOUT_PRODUIT =
    "INSERT INTO PRODUIT(" . Produit::NOM . ", " . Produit::PRIX . ", " . Produit::STOCK . ", " . Produit::ID_CATEGORIE . ", " . Produit::SRC_IMAGE . ", " . Produit::DESCRIPTION . ") VALUES (:nom,:prix,:stock,:idCategorie, :srcImage, :description);";

    private static $SUPPRIMER_PRODUIT =
    "DELETE FROM PRODUIT WHERE " . Produit::ID_PRODUIT . " = :idProduit;";

    private static $MISE_A_JOUR_PRODUIT =
    "UPDATE PRODUIT SET " . Produit::NOM . " = :nomProduit, " . Produit::PRIX . " = :prix, " . Produit::STOCK . " = :stock, " . Produit::ID_CATEGORIE . " = :idCategorie) WHERE " . Produit::ID_PRODUIT . " = :idProduit;";

    private static $GET_ID_PRODUIT =
    "SELECT " . Produit::ID_PRODUIT . " FROM PRODUIT WHERE " . Produit::NOM . " = :nomProduit, " . Produit::PRIX . " = :prix, " . Produit::ID_CATEGORIE . " = :idCategorie";

    private static $RECUPERER_LISTE_PRODUITS =
    "SELECT " . Produit::ID_PRODUIT . ", " . Produit::NOM . ", " . Produit::DESCRIPTION . ", " . Produit::PRIX . ", " . Produit::STOCK . ", " . Produit::ID_CATEGORIE . ", " . Produit::SRC_IMAGE . " FROM PRODUIT; ";

    private static $RECUPERER_PRODUIT_PAR_ID =
    "SELECT " . Produit::NOM . ", " . Produit::DESCRIPTION . ", " . Produit::PRIX . ", " . Produit::STOCK . ", " . Produit::ID_CATEGORIE . ", " . Produit::SRC_IMAGE . " FROM PRODUIT WHERE " . Produit::ID_PRODUIT . " LIKE :idProduit;";

    private static $RECUPERER_PRODUIT_PAR_CATEGORIE =
    "SELECT " . Produit::ID_PRODUIT . ", " . Produit::NOM . ", " . Produit::DESCRIPTION . ", " . Produit::PRIX . ", " . Produit::SRC_IMAGE . " FROM PRODUIT WHERE " . Produit::ID_CATEGORIE . " LIKE :idCategorie;";

    private static $RECUPERER_PRODUIT_NOM_SIMILAIRE = "SELECT * FROM PRODUIT WHERE CONTAINS(" . Produit::NOM . ", 'NEAR(:nomProduit)';";

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
        $requete = self::$connexion->prepare(self::$AJOUT_PRODUIT);
        $requete->bindValue(":nom", $produit->getNom(), PDO::PARAM_STR);
        $requete->bindValue(":prix", $produit->getPrix(), PDO::PARAM_STR);
        $requete->bindValue(":stock", $produit->getStock(), PDO::PARAM_INT);
        $requete->bindValue(":description", $produit->getDescription(), PDO::PARAM_STR);
        $requete->bindValue(":idCategorie", $produit->getIdCategorie(), PDO::PARAM_STR);
        $requete->bindValue(":srcImage", $produit->getSrcImage(), PDO::PARAM_STR);

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
