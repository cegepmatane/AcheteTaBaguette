<?php


class ListeProduitFacture
{

    public const ID_FACTURE = "idFacture";
    public const ID_PRODUIT = "idProduit";
    public const QUANTITE = "quantite";

    private $idFacture;
    private $idProduit;
    private $quantite;

    public function __construct(object $attribut)
    {
        if (!is_object($attribut)) {
            $attribut = (object) [];
        }
        $this->setIdFacture($attribut->facture ?? null);
        $this->setIdProduit($attribut->idProduit ?? null);
        $this->setQuantite($attribut->quantite ?? null);
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

}