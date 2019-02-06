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
        "INSERT INTO table("                    ;

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
    }

}
