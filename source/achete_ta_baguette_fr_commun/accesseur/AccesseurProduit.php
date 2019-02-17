<?php

require_once("BaseDeDonnee.php");
require_once("C:\wamp64\www\AcheteTaBaguette\AcheteTaBaguette\source\achete_ta_baguette_fr_commun\modele\produit.class.php");



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

	private static $RECUPERER_LISTE_PRODUITS =
        "SELECT PRODUIT.nom, PRODUIT.description, PRODUIT.prix, PRODUIT.stock, PRODUIT.idCategorie, PRODUIT.srcImage FROM PRODUIT ";

    private static $RECUPERER_PRODUIT_PAR_ID = 
        "SELECT nom, description, prix, stock, idCategorie, srcImage FROM PRODUIT WHERE idProduit LIKE ?";

    private static $RECUPERER_PRODUIT_PAR_CATEGORIE =
        "SELECT nom, description, prix, stock, idCategorie, srcImage FROM PRODUIT WHERE idCategorie LIKE ?";

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
        $requete->bindValue(1, $idProduit);

        $requete->execute();

        if ($requete->rowCount() > 0) {
            $reponse = $requete->fetch();
            return $reponse;
        }
        else {
            echo "Aucune données trouvés !";
        }
    }

    public function recupererProduitParType($idProduit)
    {
        $requete = self::$connexion->prepare(self::$RECUPERER_PRODUIT_PAR_CATEGORIE);
        $requete->bindValue(1, $idProduit);

        $requete->execute();

        if ($requete->rowCount() > 0) {
            $listeEnregistrement = $requete->fetchAll(PDO::FETCH_OBJ);

            foreach($listeEnregistrement as $enregistrement) {

                $listeProduits[] = new Produit($enregistrement);

            }

            return $listeProduits;

        }
        else {
            echo "Aucune données trouvés !";
            return $reponse = ["isConnected" => false];
        }
    }

    public function ajouterProduit($produit)
    {
        $requete = self::$connexion->prepare($AJOUT_PRODUIT);
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
        $requete = self::$connexion->prepare($SUPPRIMER_PRODUIT);
        $requete->bindValue(1, $produit->getIdProduit);

        $requete->execute();

        if ($requete->rowCount() > 0) {
            return true;
        }

        return false;
    }

    public function recupererListeProduits(){

        $listeProduits = [];

        $requete = self::$connexion->prepare(self::$RECUPERER_LISTE_PRODUITS);

        $requete->execute();

        $listeEnregistrement = $requete->fetchAll(PDO::FETCH_OBJ);

        foreach($listeEnregistrement as $enregistrement) {

            $listeProduits[] = new Produit($enregistrement);

        }

        return $listeProduits;
		

    }

	 public function getIdProduit($produit)
    {
        $requete = self::$connexion->prepare($GET_ID_PRODUIT);
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
        $requete = self::$connexion->prepare($MISE_A_JOUR_PRODUIT);
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


?>