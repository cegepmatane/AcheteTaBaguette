<?php
/**
 * Created by PhpStorm.
 * User: AlexandreCM
 * Date: 2019-03-07
 * Time: 14:06
 */

class Panier
{
    public const ID_CLIENT = "idClient";
    public const ID_PRODUIT = "idProduit";
    public const NB_PRODUIT = "nbProduit";

    private $idClient;
    private $idProduit;
    private $nbProduit;

    private static $LISTE_MESSAGE_ERREUR = [];

    private $listeMessageErreurActif = [];

    public function __construct(object $attribut)
    {
        if (!is_object($attribut)) {
            $attribut = (object) [];
        }

        $this->setIdClient($attribut->idClient ?? null);
        $this->setIdProduit($attribut->idProduit ?? null);
        $this->setNbProduit($attribut->nbProduit ?? null);
    }

    public function isValide($champ = null)
    {

        if (null == $champ) {

            $this->setIdClient($this->idClient);
            $this->setIdProduit($this->idProduit);
            $this->setNbProduit($this->nbProduit);

            return $this->listeMessageErreurActif;

        }

        $nomClasse = get_class();
        $constante = "$nomClasse::" . strtoupper($champ);
        if (!defined($constante)) {
            return false;
        }

        return !isset($this->listeMessageErreurActif[$champ]);

    }

    public static function getListeMessageErreur()
    {
        if (empty(self::$LISTE_MESSAGE_ERREUR))
        {
            self::$LISTE_MESSAGE_ERREUR =
                [
                    "idClient-vide" => "Le idClient ne doit pas être vide",
                    "idProduit-vide" => "Le idProduit ne doit pas être vide",
                    "nbProduit-vide" => "Le nbProduit ne doit pas être vide",
                ];
        }

        return self::$LISTE_MESSAGE_ERREUR;
    }

    public function getListeMessageErreurActif($champ)
    {
        return $this->listeMessageErreurActif[$champ] ?? [];
    }

    public function getIdClient()
    {
        return $this->idClient;
    }

    public function setIdClient($idClient)
    {
        // Validation en premier
        if (empty($idClient))
        {
            $this->listeMessageErreurActif[self::ID_CLIENT][] = self::getListeMessageErreur()['idClient-vide'];
            return false;
        }

        // Nettoyage en second
        $this->idClient = filter_var($idClient, FILTER_SANITIZE_STRING);
        return true;
    }

    public function getIdProduit()
    {
        return $this->idProduit;
    }

    public function setIdProduit($idProduit)
    {
        // Validation en premier
        if (empty($idProduit))
        {
            $this->listeMessageErreurActif[self::ID_PRODUIT][] = self::getListeMessageErreur()['idProduit-vide'];
            return false;
        }

        // Nettoyage en second
        $this->idProduit = filter_var($idProduit, FILTER_SANITIZE_STRING);
        return true;
    }

    public function getNbProduit()
    {
        return $this->nbProduit;
    }

    public function setNbProduit($nbProduit)
    {
        // Validation en premier
        if (empty($nbProduit))
        {
            $this->listeMessageErreurActif[self::NB_PRODUIT][] = self::getListeMessageErreur()['nbProduit-vide'];
            return false;
        }

        // Nettoyage en second
        $this->nbProduit = filter_var($nbProduit, FILTER_SANITIZE_STRING);
        return true;
    }
}