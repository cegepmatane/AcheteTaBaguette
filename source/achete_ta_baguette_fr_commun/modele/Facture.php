<?php

class Facture
{

    public const ID_FACTURE = "idFacture";
    public const DATE_ACHAT = "dateAchat";
    public const PRIX_HT = "prixHT";
    public const PRIX_TTC = "prixTTC";

    private $idFacture;
    private $dateAchat;
    private $prixHT;
    private $prixTTC;

    public function __construct(object $attribut)
    {
        if (!is_object($attribut)) {
            $attribut = (object) [];
        }
        $this->setDateAchat($attribut->dateAchat ?? "");
        $this->setPrixHT($attribut->prixHT ?? 0);
        $this->setPrixTTC($attribut->prixTTC ?? 0);
        $this->setIdFacture($attribut->idFacture ?? null);
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
        return $this->prixHT;
    }

    public function setPrixHT($prixHT)
    {
        $this->prixHT = filter_var($prixHT, FILTER_SANITIZE_STRING);
        return true;
    }

    public function getPrixTTC()
    {
        return $this->prixTTC;
    }

    public function setPrixTTC($prixTTC)
    {
        $this->prixTTC = filter_var($prixTTC, FILTER_SANITIZE_STRING);
        return true;
    }

}
