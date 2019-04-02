<?php
/**
 * Created by PhpStorm.
 * User: AlexandreCM
 * Date: 2019-03-07
 * Time: 14:06
 */

class Panier
{
    public const EMAIL_CLIENT = "emailClient";
    public const ID_PRODUIT = "idProduit";
    public const QUANTITE = "quantite";
    public const PRIX_HT = "prixHT";
    public const PRIX_TTC = "prixTTC";

    private $emailClient;
    private $idProduit;
    private $quantite;
    private $listeProduit;
    private $prixHT;
    private $prixTTC;

    public function __construct(object $attribut)
    {
        if (!is_object($attribut)) {
            $attribut = (object) [];
        }

        $this->setEmailClient($attribut->emailClient ?? null);
        $this->setIdProduit($attribut->idProduit ?? null);
        $this->setQuantite($attribut->quantite ?? null);
    }

    public function getEmailClient()
    {
        return $this->emailClient;
    }

    public function setEmailClient($emailClient)
    {
        $this->emailClient = filter_var($emailClient, FILTER_SANITIZE_STRING);
        return true;
    }

    public function getIdProduit()
    {
        return $this->idProduit;
    }

    public function setIdProduit($idProduit)
    {
        $this->idProduit = filter_var($idProduit, FILTER_SANITIZE_STRING);
        return true;
    }

    public function getQuantite()
    {
        return $this->quantite;
    }

    public function setQuantite($quantite)
    {
        $this->quantite = filter_var($quantite, FILTER_SANITIZE_STRING);
        return true;
    }

    public function getListeProduit()
    {
        return $this->listeProduit;
    }

    public function setListeProduit($listeProduit)
    {
        $this->listeProduit = $listeProduit;
    }

    public function addProduit($produit)
    {
        $this->listeProduit += $produit;
//        $this->setPrixHT($produit->getPrix(), $this->getQuantite());
//        $this->setPrixTTC(0.2);
    }

    public function getPrixHT()
    {
        return $this->prixHT;
    }

    public function setPrixHT($prix, $quantite)
    {
        $this->prixHT = $this->prixHT + $prix * $quantite;
    }

    public function getPrixTTC()
    {
        return $this->prixTTC;
    }

    public function setPrixTTC($taxe)
    {
        $this->prixTTC = $this->getPrixHT() * $taxe;
    }


}