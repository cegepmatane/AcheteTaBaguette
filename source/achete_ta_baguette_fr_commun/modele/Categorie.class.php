<?php

class Categorie
{

    private $listeMessageErreurActif = [];
    private $idCategorie;
    private $label;
    private $description;

    private static function getListeMessageErreur()
    {

        if (empty(self::$LISTE_MESSAGE_ERREUR)) {

            self::$LISTE_MESSAGE_ERREUR =
                [
                "id_categorie-invalide" =>
                true,

                "nom-vide" =>
                "Le nom ne doit pas �tre vide",

                "nom-trop-long" =>
                "Le nombre maximum de caract�res pour le nom est : " .
                self::NOM_NOMBRE_CARACTERE_MAXIMUM,

                "nom-non-alphabetique" =>
                "Le nom doit contenir uniquement des lettres",

                "prenom-vide" =>
                "Le pr�nom ne doit pas �tre vide",

                "prenom-trop-long" =>
                "Le nombre maximum de caract�res pour le pr�nom est : " .
                self::PRENOM_NOMBRE_CARACTERE_MAXIMUM,

                "prenom-non-alphabetique" =>
                "Le pr�nom doit contenir uniquement des lettres",

                "courriel-vide" =>
                "Le courriel ne doit pas �tre vide",

                "courriel-invalide" =>
                "Le courriel n'est pas valide",

                "courriel-trop-long" =>
                "Le nombre maximum de caract�res pour le courriel est : " .
                self::COURRIEL_NOMBRE_CARACTERE_MAXIMUM,
            ];

        }

        return self::$LISTE_MESSAGE_ERREUR;

    }

    public function __construct($attribut)
    {

        if (!is_object($attribut)) {
            $attribut = (object) [];
        }

        $this->setIdCategorie($attribut->idCategorie ?? null);
        $this->setLabel($attribut->label ?? "");
        $this->setDescription($attribut->description ?? "");

    }

    public function setIdCategorie($idCategorie)
    {
        // Validation en premier

        if (null == $idCategorie) {
            return;
        }

        if (!is_int(filter_var($idCategorie, FILTER_VALIDATE_INT))) {

            $this->listeMessageErreurActif['idCategorie'][] =
            self::getListeMessageErreur()['id_categorie-invalide'];

            $this->idCategorie = null;

            return;

        }

        $this->idCategorie = $idCategorie;

    }

    public function setLabel($nouveauLabel)
    {
        $this->label = $nouveauLabel;
    }

    public function setDescription($nouvelleDescription)
    {
        $this->description = $nouvelleDescription;
    }

    public function getIdCategorie()
    {
        return $this->idCategorie;
    }
    public function getLabel()
    {
        return $this->label;
    }
    public function getDescription()
    {
        return $this->description;
    }

}
