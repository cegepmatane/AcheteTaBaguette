<?php
/**
 * Created by PhpStorm.
 * User: AlexandreCM
 * Date: 2019-03-07
 * Time: 22:16
 */

require_once(CHEMIN_RACINE_COMMUN . "/accesseur/BaseDeDonnee.php");
require_once(CHEMIN_RACINE_COMMUN . "/modele/Panier.php");
require_once(CHEMIN_RACINE_COMMUN . "/modele/Article.php");
require_once(CHEMIN_RACINE_COMMUN . "/modele/Produit.php");

class AccesseurPanier
{
    private const EMAIL_CLIENT = Panier::EMAIL_CLIENT;
    private const ID_PRODUIT = Produit::ID_PRODUIT;
    private const QUANTITE = Article::QUANTITE;

    private const SUBTITUT_EMAIL_CLIENT = ":" .Panier::EMAIL_CLIENT;
    private const SUBTITUT_ID_PRODUIT = ":" .Produit::ID_PRODUIT;
    private const SUBTITUT_QUANTITE = ":" .Article::QUANTITE;

    private static $AJOUTER_PANIER = "INSERT INTO PANIER(".self::EMAIL_CLIENT.", ".self::ID_PRODUIT.", ".self::QUANTITE.") VALUES (".self::SUBTITUT_EMAIL_CLIENT.", ".self::SUBTITUT_ID_PRODUIT.", ".self::SUBTITUT_QUANTITE.");";
    private static $RECUPERER_PANIER_CLIENT_PAR_EMAIL = "SELECT ".self::EMAIL_CLIENT.", ".self::ID_PRODUIT.", ".self::QUANTITE." FROM PANIER WHERE ".self::EMAIL_CLIENT." LIKE ".self::SUBTITUT_EMAIL_CLIENT.";";
    private static $SUPPRIMER_PRODUIT_PANIER = "DELETE FROM PANIER WHERE ".self::EMAIL_CLIENT." LIKE ".self::SUBTITUT_EMAIL_CLIENT." AND ".self::ID_PRODUIT." = ".self::SUBTITUT_ID_PRODUIT.";";
    private static $SUPPRIMER_PANIER = "DELETE FROM PANIER WHERE ".self::EMAIL_CLIENT." LIKE ".self::SUBTITUT_EMAIL_CLIENT .";";

    private static $connexion = null;
    public function __construct()
    {
        if (!self::$connexion) self::$connexion = BaseDeDonnee::getConnexion();
    }

    public function ajouterPanier(Panier $panier)
    {
        try {
                foreach ($panier->getListeProduit() as $article){
                    $requete = self::$connexion->prepare(self::$AJOUTER_PANIER);
                    $requete->bindValue(self::SUBTITUT_EMAIL_CLIENT, $panier->getEmailClient(), PDO::PARAM_STR);
                    $requete->bindValue(self::SUBTITUT_ID_PRODUIT, $article->getProduit()->getIdProduit(), PDO::PARAM_STR);
                    $requete->bindValue(self::SUBTITUT_QUANTITE, $article->getQuantite(), PDO::PARAM_STR);

                    $requete->execute();
                }

                return $panier;

        } catch (PDOException $e) {

            return false;

        }
    }

    public function recupererPanier($emailClient)
    {
        try {
            $requete = self::$connexion->prepare(self::$RECUPERER_PANIER_CLIENT_PAR_EMAIL);
            $requete->bindValue(self::SUBTITUT_EMAIL_CLIENT, $emailClient, PDO::PARAM_STR);
            $requete->execute();

            $listeEnregistrement = $requete->fetchAll(PDO::FETCH_OBJ);
            if(empty($listeEnregistrement)) return false;
            $panier = new Panier((object) $listeEnregistrement[0]);
            for ($i=1; $i < sizeof($listeEnregistrement); $i++){
                $panier->setListeProduit((object) $listeEnregistrement[$i]);
            }

            return $panier;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function supprimerProduitPanier(Panier $panier)
    {
        try {

            foreach ($panier->getListeProduit() as $article){
                $requete = self::$connexion->prepare(self::$SUPPRIMER_PRODUIT_PANIER);
                $requete->bindValue(self::SUBTITUT_EMAIL_CLIENT, $panier->getEmailClient(), PDO::PARAM_STR);
                $requete->bindValue(self::SUBTITUT_ID_PRODUIT, $article->getProduit()->getIdProduit(), PDO::PARAM_STR);
                $requete->execute();
            }

            return true;

        } catch (PDOException $e) {

            return false;

        }
    }

    public function ViderPanier(Panier $panier)
    {
        try {

            $requete = self::$connexion->prepare(self::$SUPPRIMER_PANIER);
            $requete->bindValue(self::SUBTITUT_EMAIL_CLIENT, $panier->getEmailClient(), PDO::PARAM_STR);

            $requete->execute();
            return true;

        } catch (PDOException $e) {
            return false;
        }
    }
}