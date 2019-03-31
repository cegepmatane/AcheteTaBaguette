<?php


class ListeProduitFacture
{

    public const FACTURE = "facture";
    public const PRODUIT = "produit";
    public const QUANTITE = "quantite";

    private $facture;
    private $produit;
    private $quantite;

    public function __construct(object $attribut)
    {
        if (!is_object($attribut)) {
            $attribut = (object) [];
        }
        $this->setFacture($attribut->facture ?? null);
        $this->setProduit($attribut->produit ?? null);
        $this->setQuantite($attribut->quantite ?? null);
    }

    public function getFacture()
    {
        return $this->facture;
    }
    public function setFacture($facture)
    {
        $this->facture = filter_var($facture, FILTER_SANITIZE_STRING);
        return true;
    }

    public function getProduit()
    {
        return $this->Produit;
    }

    public function setProduit($Produit)
    {
        $this->Produit = filter_var($Produit, FILTER_SANITIZE_STRING);
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