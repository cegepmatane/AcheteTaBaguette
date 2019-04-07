<?php

class Facture
{

    public const ID_FACTURE = "idFacture";
    public const EMAIL_CLIENT = "emailClient";
    public const DATE_ACHAT = "dateAchat";
    public const PRIX_HT = "prixHT";
    public const PRIX_TTC = "prixTTC";

    private $idFacture;
    private $emailClient;
    private $dateAchat;
    private $prixHT;
    private $prixTTC;
    private $listeProduit;

    public function __construct(object $attribut)
    {
        if (!is_object($attribut)) $attribut = (object) [];

        $this->setIdFacture($attribut->idFacture ?? null);
        $this->setEmailClient($attribut->emailClient ?? "");
        $this->setDateAchat($attribut->dateAchat ?? "NOW()");
        $this->setPrixHT($attribut->prixHT ?? "");
        $this->setPrixTTC($attribut->prixTTC ?? "");
        $this->setListeProduit($attribut ?? null);
    }

    public function getIdFacture()
    {
        return $this->idFacture;
    }

    public function setIdFacture($idFacture)
    {
        $this->idFacture = filter_var($idFacture, FILTER_SANITIZE_STRING);
        return true;
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

    public function getDateAchat()
    {
        return $this->dateAchat;
    }

    public function setDateAchat($dateAchat)
    {
        $this->dateAchat = filter_var($dateAchat, FILTER_SANITIZE_STRING);
        return true;
    }

    public function getPrixHT()
    {
        return round($this->prixHT, 2);
    }

    public function setPrixHT($prixHT)
    {
        $this->prixHT = filter_var($prixHT, FILTER_SANITIZE_STRING);
        return true;
    }

    public function getPrixTTC()
    {
        return round($this->prixTTC, 2);
    }

    public function setPrixTTC($prixTTC)
    {
        $this->prixTTC = filter_var($prixTTC, FILTER_SANITIZE_STRING);
        return true;
    }

    public function getListeProduit()
    {
        return $this->listeProduit;
    }

    public function setListeProduit($article)
    {
        $article = new Article($article);
        $this->listeProduit[] = $article;
    }

}
