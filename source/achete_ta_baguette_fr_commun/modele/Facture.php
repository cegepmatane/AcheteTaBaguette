<?php

class Facture
{

    public const ID_CLIENT = "idClient";
    public const ID_FACTURE = "idFacture";
    public const NOM_FACTURE = "nomFacture";
    public const MONTANT_FACTURE = "montantFacture";

    private $idClient;
    private $idFacture;
    private $nomFacture;
    private $montantFacture;

    public function __construct($idClient, $nomFacture, $montantFacture)
    {
        $this->idClient = $idClient;
        $this->nomFacture = $nomFacture;
        $this->montantFacture = $montantFacture;
    }

    public function setNomFacture($nomFacture)
    {
        $this->nomFacture = $nomFacture;
    }

    public function setMontantFacture($montantFacture)
    {
        $this->montantFacture = $montantFacture;
    }

    public function getNomFacture()
    {
        return $this->nomFacture;
    }
    public function getMontantFacture()
    {
        return $this->montantFacture;
    }

    public function getIdClient()
    {
        return $this->idClient;
    }

    public function getIdFacture()
    {
        return $this->idFacture;
    }

    public function genererFactureCSV(){
        
    }

}
