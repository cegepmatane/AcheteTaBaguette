<?php

require_once "BaseDeDonnee.php";
require_once CHEMIN_RACINE_COMMUN . "/modele/Produit.php";

class AccesseurProduit
{

    private const SUBSTITUT_ID_PRODUIT = ":" . Produit::ID_PRODUIT;
    private const SUBSTITUT_NOM = ":" . Produit::NOM;
    private const SUBSTITUT_DESCRIPTION = ":" . Produit::DESCRIPTION;
    private const SUBSTITUT_PRIX = ":" . Produit::PRIX;
    private const SUBSTITUT_ID_CATEGORIE = ":" . Produit::ID_CATEGORIE;
    private const SUBSTITUT_STOCK = ":" . Produit::STOCK;
    private const SUBSTITUT_SRC_IMAGE = ":" . Produit::SRC_IMAGE;

    private static $AJOUT_PRODUIT =
    "INSERT INTO PRODUIT(" . Produit::NOM . ", " . Produit::PRIX . ", " . Produit::STOCK . ", " . Produit::ID_CATEGORIE . ", " . Produit::SRC_IMAGE . ", " . Produit::DESCRIPTION . ") VALUES (" . self::SUBSTITUT_NOM."," . self::SUBSTITUT_PRIX . "," . self::SUBSTITUT_STOCK . "," . self::SUBSTITUT_ID_CATEGORIE . "," . self::SUBSTITUT_SRC_IMAGE . ", " . self::SUBSTITUT_DESCRIPTION . ");";

    private static $SUPPRIMER_PRODUIT =
    "DELETE FROM PRODUIT WHERE " . Produit::ID_PRODUIT . " =" . self::SUBSTITUT_ID_PRODUIT . ";";

    private static $MISE_A_JOUR_PRODUIT =
    "UPDATE PRODUIT SET " . Produit::NOM . " =" . self::SUBSTITUT_NOM . ", " . Produit::PRIX . " =" . self::SUBSTITUT_PRIX . ", " . Produit::STOCK . " =" . self::SUBSTITUT_STOCK . ", " . Produit::ID_CATEGORIE . " =" . self::SUBSTITUT_ID_CATEGORIE . ") WHERE " . Produit::ID_PRODUIT . " =" . self::SUBSTITUT_ID_PRODUIT . ";";

    private static $GET_ID_PRODUIT =
    "SELECT " . Produit::ID_PRODUIT . " FROM PRODUIT WHERE " . Produit::NOM . " =" . self::SUBSTITUT_NOM . ", " . Produit::PRIX . " =" . self::SUBSTITUT_PRIX . ", " . Produit::ID_CATEGORIE . " =" . self::SUBSTITUT_ID_CATEGORIE . ";";

    private static $RECUPERER_LISTE_PRODUITS =
    "SELECT " . Produit::ID_PRODUIT . ", " . Produit::NOM . ", " . Produit::DESCRIPTION . ", " . Produit::PRIX . ", " . Produit::STOCK . ", " . Produit::ID_CATEGORIE . ", " . Produit::SRC_IMAGE . " FROM PRODUIT; ";

    private static $RECUPERER_PRODUIT_PAR_ID =
    "SELECT " . Produit::ID_PRODUIT . ", " . Produit::NOM . ", " . Produit::DESCRIPTION . ", " . Produit::PRIX . ", " . Produit::STOCK . ", " . Produit::ID_CATEGORIE . ", " . Produit::SRC_IMAGE . " FROM PRODUIT WHERE " . Produit::ID_PRODUIT . " LIKE " . self::SUBSTITUT_ID_PRODUIT . ";";

    private static $RECUPERER_PRODUIT_PAR_CATEGORIE =
    "SELECT " . Produit::ID_PRODUIT . ", " . Produit::NOM . ", " . Produit::DESCRIPTION . ", " . Produit::PRIX . ", " . Produit::SRC_IMAGE . " FROM PRODUIT WHERE " . Produit::ID_CATEGORIE . " LIKE " . self::SUBSTITUT_ID_CATEGORIE . ";";

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
            return new Produit($reponse);
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
        $requete->bindValue(self::SUBSTITUT_NOM, $produit->getNom(), PDO::PARAM_STR);
        $requete->bindValue(self::SUBSTITUT_PRIX, $produit->getPrix(), PDO::PARAM_STR);
        $requete->bindValue(self::SUBSTITUT_STOCK, $produit->getStock(), PDO::PARAM_INT);
        $requete->bindValue(self::SUBSTITUT_DESCRIPTION, $produit->getDescription(), PDO::PARAM_STR);
        $requete->bindValue(self::SUBSTITUT_ID_CATEGORIE, $produit->getIdCategorie(), PDO::PARAM_STR);
        $requete->bindValue(self::SUBSTITUT_SRC_IMAGE, $produit->getSrcImage(), PDO::PARAM_STR);

        $requete->execute();

        if ($requete->rowCount() > 0) {
            return true;

        }

        return false;

    }

    public function supprimerProduit($produit)
    {
        $requete = self::$connexion->prepare(self::$SUPPRIMER_PRODUIT);
        $requete->bindValue(self::SUBSTITUT_ID_PRODUIT, $produit->getIdProduit());

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
        $requete->bindValue(self::SUBSTITUT_NOM, $produit->getNom(), PDO::PARAM_STR);
        $requete->bindValue(self::SUBSTITUT_PRIX, $produit->getPrix(), PDO::PARAM_STR);
        $requete->bindValue(self::SUBSTITUT_ID_CATEGORIE, $produit->getNomCatégorie(), PDO::PARAM_INT);

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
        $requete->bindValue(self::SUBSTITUT_NOM, $produit->getNom(), PDO::PARAM_STR);
        $requete->bindValue(self::SUBSTITUT_PRIX, $produit->getPrix(), PDO::PARAM_STR);
        $requete->bindValue(self::SUBSTITUT_STOCK, $produit->getNbStock(), PDO::PARAM_INT);
        $requete->bindValue(self::SUBSTITUT_ID_CATEGORIE, $produit->getNomCatégorie(), PDO::PARAM_STR);
        $requete->bindValue(self::SUBSTITUT_ID_PRODUIT, getIdProduit($produit), PDO::PARAM_STR);

        $requete->execute();

        if ($requete->rowCount() > 0) {
            return true;
        }

        return false;

    }

}