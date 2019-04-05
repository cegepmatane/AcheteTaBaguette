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
    public const PRIX_HT = "prixHT";
    public const PRIX_TTC = "prixTTC";

    private $emailClient;
    private $idProduit;
    private $prixHT;
    private $prixTTC;
    private $listeProduit;

    public function __construct(object $attribut)
    {
        if (!is_object($attribut)) {
            $attribut = (object) [];
        }

        $this->setEmailClient($attribut->emailClient ?? "");
        $this->setListeProduit($attribut ?? null);
        $this->setPrixHT();
        $this->setPrixTTC();
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
        $this->idProduit = $idProduit;
    }

    public function getListeProduit()
    {
        return $this->listeProduit;
    }

    public function setListeProduit($article)
    {
        $this->listeProduit[] = new Article($article);
    }

    public function getPrixHT()
    {
        return $this->prixHT;
    }

    public function setPrixHT()
    {
        foreach ($this->listeProduit as $article){
            $this->prixHT = $this->prixHT + $article->getProduit()->getPrix() * $article->getQuantite();
        }
    }

    public function getPrixTTC()
    {
        return $this->prixTTC;
    }

    private function setPrixTTC()
    {
        $this->prixTTC = $this->getPrixHT() + ($this->getPrixHT() * (0.05 + 0.09975));
    }


}