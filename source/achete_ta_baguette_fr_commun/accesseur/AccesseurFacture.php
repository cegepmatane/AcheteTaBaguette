<?php
/**
 * Created by PhpStorm.
 * User: 1834112
 * Date: 2019-03-18
 * Time: 00:50
 */

require_once(CHEMIN_RACINE_COMMUN . "/accesseur/BaseDeDonnee.php");
require_once(CHEMIN_RACINE_COMMUN . "/modele/Facture.php");
require_once(CHEMIN_RACINE_COMMUN . "/modele/Article.php");

class AccesseurFacture
{
    private const SUBTITUT_ID_FACTURE = ":" . Facture::ID_FACTURE;
    private const SUBTITUT_EMAIL_CLIENT = ":" . Facture::EMAIL_CLIENT;
    private const SUBTITUT_DATE_ACHAT = ":" . Facture::DATE_ACHAT;
    private const SUBTITUT_PRIX_HT = ":" . Facture::PRIX_HT;
    private const SUBTITUT_PRIX_TTC = ":" . Facture::PRIX_TTC;

    private const SUBTITUT_ID_PRODUIT = ":" . Article::ID_PRODUIT;
    private const SUBTITUT_QUANTITE = ":" . Article::QUANTITE;

    private static $AJOUTER_FACTURE = "INSERT INTO FACTURE(".Facture::EMAIL_CLIENT.", ".Facture::DATE_ACHAT.", ".Facture::PRIX_HT.", ".Facture::PRIX_TTC.") VALUES (".self::SUBTITUT_EMAIL_CLIENT.", ".self::SUBTITUT_DATE_ACHAT.", ".self::SUBTITUT_PRIX_HT.", ".self::SUBTITUT_PRIX_TTC.");";
    private static $AJOUTER_ARTICLE = "INSERT INTO ARTICLE_FACTURE(".Facture::ID_FACTURE.", ".Article::ID_PRODUIT.", ".Article::QUANTITE.") VALUES (".self::SUBTITUT_ID_FACTURE.", ".self::SUBTITUT_ID_PRODUIT.", ".self::SUBTITUT_QUANTITE.");";

    private static $RECUPERER_FACTURE_PAR_EMAIL_CLIENT = "SELECT ".Facture::ID_FACTURE.", ".Facture::EMAIL_CLIENT.", ".Facture::DATE_ACHAT.", ".Facture::PRIX_HT.", ".Facture::PRIX_TTC." FROM FACTURE WHERE ".Facture::EMAIL_CLIENT." LIKE ".self::SUBTITUT_EMAIL_CLIENT.";";
    private static $RECUPERER_FACTURE_PAR_ID = "SELECT ".Facture::ID_FACTURE.", ".Facture::EMAIL_CLIENT.", ".Facture::DATE_ACHAT.", ".Facture::PRIX_HT.", ".Facture::PRIX_TTC." FROM FACTURE WHERE ".Facture::ID_FACTURE." LIKE ".self::SUBTITUT_ID_FACTURE.";";
    private static $RECUPERER_DETAIL_FACTURE_PAR_ID = "SELECT ".Article::ID_PRODUIT.", ".Facture::ID_FACTURE.", ".Article::QUANTITE." FROM ARTICLE_FACTURE WHERE ".Facture::ID_FACTURE." LIKE ".self::SUBTITUT_ID_FACTURE.";";

    private static $connexion = null;
    public function __construct()
    {
        if (!self::$connexion) self::$connexion = BaseDeDonnee::getConnexion();
    }

    public function ajouterFacture(Facture $facture)
    {
        try {

            $requete = self::$connexion->prepare(self::$AJOUTER_FACTURE);
            $requete->bindValue(self::SUBTITUT_EMAIL_CLIENT, $facture->getEmailClient(), PDO::PARAM_STR);
            $requete->bindValue(self::SUBTITUT_DATE_ACHAT, $facture->getDateAchat(), PDO::PARAM_STR);
            $requete->bindValue(self::SUBTITUT_PRIX_HT, $facture->getPrixHT(), PDO::PARAM_STR);
            $requete->bindValue(self::SUBTITUT_PRIX_TTC, $facture->getPrixTTC(), PDO::PARAM_STR);
            $requete->execute();
            $facture->setIdFacture(self::$connexion->lastInsertId());

            foreach ($facture->getListeProduit() as $article)
            {
                $requete = self::$connexion->prepare(self::$AJOUTER_ARTICLE);
                $requete->bindValue(self::SUBTITUT_ID_FACTURE, $facture->getIdFacture(), PDO::PARAM_STR);
                $requete->bindValue(self::SUBTITUT_ID_PRODUIT, $article->getProduit()->getIdProduit(), PDO::PARAM_STR);
                $requete->bindValue(self::SUBTITUT_QUANTITE, $article->getQuantite(), PDO::PARAM_STR);
                $requete->execute();
            }
            return $facture;

        } catch (PDOException $e) {
            return false;
        }

    }

    public function recupererListeFacture($emailClient)
    {

        try {
            $requete = self::$connexion->prepare(self::$RECUPERER_FACTURE_PAR_EMAIL_CLIENT);
            $requete->bindValue(self::SUBTITUT_EMAIL_CLIENT, $emailClient, PDO::PARAM_STR);
            $requete->execute();

            $listefacture =[];
            $listeEnregistrement = $requete->fetchAll(PDO::FETCH_OBJ);
            foreach ($listeEnregistrement as $enregistrement) {
                $listefacture[] = new Facture($enregistrement);
            }

            return $listefacture;

        } catch (PDOException $e) {
            return false;
        }
    }

    public function recupererDetailFactureParId($idFacture)
    {

        try {
            $requete = self::$connexion->prepare(self::$RECUPERER_FACTURE_PAR_ID);
            $requete->bindValue(self::SUBTITUT_ID_FACTURE, $idFacture, PDO::PARAM_STR);
            $requete->execute();
            $reponse = $requete->fetch();

            $facture = new Facture($reponse);

            $requete = self::$connexion->prepare(self::$RECUPERER_DETAIL_FACTURE_PAR_ID);
            $requete->bindValue(self::SUBTITUT_ID_FACTURE, $idFacture, PDO::PARAM_STR);
            $requete->execute();

            $listeEnregistrement = $requete->fetchAll(PDO::FETCH_OBJ);
            foreach ($listeEnregistrement as $enredistrement) {
                $facture->setListeProduit($enredistrement);
            }

            return $facture;
        } catch (PDOException $e) {
            return false;
        }
    }
}