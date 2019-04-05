<?php


class Article
{
    public const QUANTITE = "quantite";
    public const PRODUIT = "produit";

    private $quantite;
    private $produit;

    public function __construct(object $attribut)
    {
        if (!is_object($attribut)) {
            $attribut = (object) [];
        }

        $this->setQuantite($attribut->quantite ?? null);
        $this->setProduit($attribut->idProduit ?? null);
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

    public function getProduit()
    {
        return $this->produit;
    }

    public function setProduit($idProduit)
    {
        $accesseurProduit = new AccesseurProduit();
        $this->produit = $accesseurProduit->recupererProduitParId($idProduit);
        return true;
    }
}