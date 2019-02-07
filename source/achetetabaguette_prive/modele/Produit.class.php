<?php

class Produit
{
    private $nomProduit;
    private $prix;
    private $categorie;
    private $nbStock;
    private $idProduit;

    public function __construct($nomProduit, $prix, $categorie, $nbStock)
    {
        $this->nomProduit = $nomProduit;
        $this->setPrix($prix);
        $this->setCategorie($categorie);
        $this->setNbStock = $nbStock;
    }

    public function setPrix($nouveauPrix)
    {
        if ($nouveauPrix < 0) {
            $this->prix = 0;
        } else {
            $this->prix = $nouveauPrix;
        }
    }

    public function setCategorie($nouvelleCategorie)
    {
        $this->categorie = $nouvelleCategorie;
    }

    public function setNbStock($nouveauStock)
    {
        if ($nouveauStock < 0) {
            $this->nbStock = 0;
        } else {
            $this->nbStock = $nouveauStock;
        }
    }

    public function getNom()
    {
        return $this->nomProduit;
    }
    public function getPrix()
    {
        return $this->prix;
    }
    public function getCategorie()
    {
        return $this->categorie;
    }
    public function getNnbStock()
    {
        return $this->nbStock;
    }
    public function getId(){
        return $this->idProduit;
    }

}
