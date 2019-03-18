<?php
/**
 * Created by PhpStorm.
 * User: 1834112
 * Date: 2019-03-18
 * Time: 00:50
 */

require_once(CHEMIN_RACINE_COMMUN . "/accesseur/BaseDeDonnee.php");
require_once(CHEMIN_RACINE_COMMUN . "/modele/Facture.php");

class AccesseurFacture
{
    private const SUBTITUT_EMAIL_CLIENT = ":" . Facture::EMAIL_CLIENT;
    private const SUBTITUT_ID_PRODUIT = ":" . Facture::ID_PRODUIT;
    private const SUBTITUT_NB_PRODUIT = ":" . Facture::NB_PRODUIT;

    private static $AJOUTER_FACTURE = "INSERT INTO FACTURER(".Facture::EMAIL_CLIENT.", ".Facture::ID_PRODUIT.", ".Facture::NB_PRODUIT.") VALUES (".self::SUBTITUT_EMAIL_CLIENT.", ".self::SUBTITUT_ID_PRODUIT.", ".self::SUBTITUT_NB_PRODUIT.");";

    private static $connexion = null;
    public function __construct()
    {
        if (!self::$connexion) self::$connexion = BaseDeDonnee::getConnexion();
    }

    public function ajouterFacture(Panier $panier)
    {
        try {

            $requete = self::$connexion->prepare(self::$AJOUTER_FACTURE);
            $requete->bindValue(self::SUBTITUT_EMAIL_CLIENT, $panier->getEmailClient(), PDO::PARAM_STR);
            $requete->bindValue(self::SUBTITUT_ID_PRODUIT, $panier->getIdProduit(), PDO::PARAM_STR);
            $requete->bindValue(self::SUBTITUT_NB_PRODUIT, $panier->getNbProduit(), PDO::PARAM_STR);

            $requete->execute();
            return self::$AJOUTER_FACTURE;

        } catch (PDOException $e) {
            return self::$AJOUTER_FACTURE;
        }

    }
}