<?php

require_once "BaseDeDonnee.php";
require_once "../modele/Produit.php";

class AccesseurProduit
{

    private static $SELECT_PRIX_PRODUIT =
        "SELECT prix FROM PRODUIT WHERE idProduit = ";

    private static $SELECT_NOM_PRODUIT =
        "SELECT nomProduit FROM PRODUIT WHERE idProduit =";

    private static $RECUPERER_TOUT_LES_PRODUITS =
        "SELECT * FROM PRODUIT;";

    private static $AJOUT_PRODUIT =
        "INSERT INTO table(nomProduit, prix, nbStock, nomCatégorie) VALUES (?,?,?,?,?)";

    private static $connexion = null;

    public function __construct()
    {
        if (!self::$connexion) {
            self::$connexion = BaseDeDonnee::getConnexion();
        }
    }

    public function ajouterProduit($produit)
    {
        $preRequete = $AJOUT_PRODUIT . "(\"$produit->getNom(),(\"$produit->getPrix(),(\"$produit->getNbStock(),(\"$produit->getCategorie()";

        $requete = $connexion->prepare($preRequete);
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

}
