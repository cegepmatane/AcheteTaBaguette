<?php
/**
 * Created by PhpStorm.
 * User: 1834112
 * Date: 2019-03-26
 * Time: 11:10
 */

class Facturer
{
    public const ID_FACTURE = "idFacture";
    public const EMAIL_CLIENT = "emailClient";

    private $idFacture;
    private $emailClient;

    private $listeMessageErreurActif = [];

    public function __construct(object $attribut)
    {
        if (!is_object($attribut)) {
            $attribut = (object) [];
        }
        $this->setIdFacture($attribut->idFacture ?? null);
        $this->setEmailClient($attribut->emailClient ?? null);
    }

    public function isValide($champ = null)
    {
        if (null == $champ) {

            $this->setIdFacture($this->idFacture);
            $this->setEmailClient($this->emailClient);
            return $this->listeMessageErreurActif;
        }

        $nomClasse = get_class();
        $constante = "$nomClasse::" . strtoupper($champ);
        if (!defined($constante)) {
            return false;
        }

        return !isset($this->listeMessageErreurActif[$champ]);
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


}