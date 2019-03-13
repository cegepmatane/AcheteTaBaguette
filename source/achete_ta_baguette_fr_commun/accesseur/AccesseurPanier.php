<?php
/**
 * Created by PhpStorm.
 * User: AlexandreCM
 * Date: 2019-03-07
 * Time: 22:16
 */

require_once(CHEMIN_RACINE_COMMUN . "/accesseur/BaseDeDonnee.php");
require_once(CHEMIN_RACINE_COMMUN . "/modele/Panier.php");

class AccesseurPanier
{
    private const SUBTITUT_EMAIL_CLIENT = ":" .Panier::EMAIL_CLIENT;
    private const SUBTITUT_ID_PRODUIT = ":" .Panier::ID_PRODUIT;
    private const SUBTITUT_NB_PRODUIT = ":" .Panier::NB_PRODUIT;

    private static $AJOUTER_PANIER = "INSERT INTO PANIER(".Panier::EMAIL_CLIENT.", ".Panier::ID_PRODUIT.", ".Panier::NB_PRODUIT.") VALUES (".self::SUBTITUT_EMAIL_CLIENT.", ".self::SUBTITUT_ID_PRODUIT.", ".self::SUBTITUT_NB_PRODUIT.");";
    private static $RECUPERER_PANIER_CLIENT_PAR_EMAIL = "SELECT ".Panier::ID_PRODUIT.", ".Panier::NB_PRODUIT." FROM PANIER WHERE emailClient LIKE ".self::SUBTITUT_EMAIL_CLIENT.";";

    private static $connexion = null;
    public function __construct()
    {
        if (!self::$connexion) self::$connexion = BaseDeDonnee::getConnexion();
    }

    public function ajouterPanier(Panier $panier)
    {
        try {

            $requete = self::$connexion->prepare(self::$AJOUTER_PANIER);
            $requete->bindValue(self::SUBTITUT_EMAIL_CLIENT, $panier->getEmailClient(), PDO::PARAM_STR);
            $requete->bindValue(self::SUBTITUT_ID_PRODUIT, $panier->getIdProduit(), PDO::PARAM_STR);
            $requete->bindValue(self::SUBTITUT_NB_PRODUIT, $panier->getNbProduit(), PDO::PARAM_STR);

            $requete->execute();
            return $panier;

        } catch (PDOException $e) {

            return false;

        }
    }

    public function recupererPanier($emailClient)
    {
        try {
            $panier = [];

            $requete = self::$connexion->prepare(self::$RECUPERER_PANIER_CLIENT_PAR_EMAIL);
            $requete->bindValue(self::SUBTITUT_EMAIL_CLIENT, $emailClient, PDO::PARAM_STR);
            $requete->execute();
            $listeEnregistrement = $requete->fetchAll(PDO::FETCH_OBJ);
            foreach ($listeEnregistrement as $enregistrement) {
                $panier[] = new Panier($enregistrement);
            }
            return $panier;

        } catch (PDOException $e) {
            return false;
        }
    }
}