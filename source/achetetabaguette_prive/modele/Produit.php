<?php

class Personnage
{
    private $nomProduit;
    private $prix;
    private $categorie;
    private $nbStock;

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

}
