<?php

class Personne
{

    public const ID_PERSONNE = "id_personne";
    public const NOM = "nom";
    public const PRENOM = "prenom";
    public const COURRIEL = "courriel";
    public const DATE = "date";

    private const PATERN_NOM_PROPRE =
        "/^[A-Za-z\x{00C0}-\x{00FF}]" .
        "[A-Za-z\x{00C0}-\x{00FF}\'\-]+([\ A-Za-z\x{00C0}-\x{00FF}]" .
        "[A-Za-z\x{00C0}-\x{00FF}\'\-]+)*/u";

    private const NOM_NOMBRE_CARACTERE_MAXIMUM = 24;
    private const PRENOM_NOMBRE_CARACTERE_MAXIMUM = 24;
    private const COURRIEL_NOMBRE_CARACTERE_MAXIMUM = 30;

    private static $LISTE_MESSAGE_ERREUR = [];
    private static $LISTE_INFORMATION_CHAMP = [];

    public static function getInformation($champ){

        if(empty(self::$LISTE_INFORMATION_CHAMP)){

            self::$LISTE_INFORMATION_CHAMP["id_personne"] = (object)
            [
                "etiquette" => "";
                "defaut" => "";
                "indice" => "";
                "description" = "";
                "obligatoire" = null;
            ];

            self::$LISTE_INFORMATION_CHAMP["nom"] = (object)
            [
                "etiquette" => "nom";
                "defaut" => "";
                "indice" => "Ex. : Smith (nombre maximum de caractères : " .
                            self::NOM_NOMBRE_CARACTERE_MAXIMUM .
                            " )";
                "description" = "Nom de famille";
                "obligatoire" = true;
            ];

            self::$LISTE_INFORMATION_CHAMP["prenom"] = (object)
            [
                "etiquette" => "prénom";
                "defaut" => "";
                "indice" => "Ex. : Robert (nombre maximum de caractères : " .
                            self::PRENOM_NOMBRE_CARACTERE_MAXIMUM .
                            " )";
                "description" = "Petit nom";
                "obligatoire" = true;
            ];

            self::$LISTE_INFORMATION_CHAMP["courriel"] = (object)
            [
                "etiquette" => "courriel";
                "defaut" => "";
                "indice" => "Ex. : monnom@courriel.com " .
                            "(nombre maximum de caractères : " .
                            self::COURRIEL_NOMBRE_CARACTERE_MAXIMUM .
                            " )";
                "description" = "Adresse électronique";
                "obligatoire" = true;
            ];

            self::$LISTE_INFORMATION_CHAMP["date"] = (object)
            [
                "etiquette" => "date";
                "defaut" => "";
                "indice" => "Ex. : 07/02/2019" .
                            "(nombre maximum de caractères : " .
                            self::COURRIEL_NOMBRE_CARACTERE_MAXIMUM .
                            " )";
                "description" = "Date de naissance";
                "obligatoire" = true;
            ];

        }

        $nomClasse = get_called_class();
        $constante = "$nomClasse::" . strtoupper($champ);
        if(!defined($constante)) return null;

        return self::$LISTE_INFORMATION_CHAMP[$champ];

    }

    private static function getListeMessageErreur(){

        if(empty(self::$LISTE_MESSAGE_ERREUR)){

            self::$LISTE_MESSAGE_ERREUR =
            [
                "id_personne-invalide" =>
                    true,

                "nom-vide" =>
                    "Le nom ne doit pas être vide",

                "nom-trop-long" =>
                    "Le nombre maximum de caractères pour le nom est : " .
                    self::NOM_NOMBRE_CARACTERE_MAXIMUM ,

                "nom-non-alphabetique" =>
                    "Le nom doit contenir uniquement des lettres",


                "prenom-vide" =>
                    "Le prénom ne doit pas être vide",

                "prenom-trop-long" =>
                    "Le nombre maximum de caractères pour le prénom est : " .
                    self::PRENOM_NOMBRE_CARACTERE_MAXIMUM ,

                "prenom-non-alphabetique" =>
                    "Le prénom doit contenir uniquement des lettres",


                "courriel-vide" =>
                    "Le courriel ne doit pas être vide",

                "courriel-invalide" =>
                    "Le courriel n'est pas valide",

                "courriel-trop-long" =>
                    "Le nombre maximum de caractères pour le courriel est : " .
                    self::COURRIEL_NOMBRE_CARACTERE_MAXIMUM
            ];

        }

        return self::$LISTE_MESSAGE_ERREUR;

    }

    private static validerNomPropre($nom){

        /*
        https://andrewwoods.net/blog/2018/name-validation-regex/

        Remove Digits and Underscores
        Allow Multiple Words
        Add Apostrophe and Hyphen Support
        Adding Extended ASCII Character Support
        */

        if (preg_match(self::PATERN_NOM_PROPRE, $nom)) return true;

        return false;
    }

    private $listeMessageErreurActif = [];

    private $nom;
    private $prenom;
    private $courriel;
    private $id_personne;

    function __construct(object $attribut){

        if(!is_object($attribut)) $attribut = (object)[];

        $this->setNom($attribut->nom ?? "");
        $this->setPrenom($attribut->prenom ?? "");
        $this->setCourriel($attribut->courriel ?? "");
        $this->setId_personne($attribut->id_personne ?? null);

    }

    public function isValide($champ = null){

        if(null == $champ){

            $this->setId_personne($this->id_personne);
            $this->setNom($this->nom);
            $this->setPrenom($this->prenom);
            $this->setCourriel($this->courriel);

            return empty($this->listeMessageErreurActif);

        }

        $nomClasse = get_class();
        $constante = "$nomClasse::" . strtoupper($champ);
        if(!defined($constante)) return false;

        return !isset($this->listeMessageErreurActif[$champ]);

    }

    public function getListeMessageErreurActif($champ){

        return $this->listeMessageErreurActif[$champ]) ?? [];

    }

    public function getId_personne(){

        return $this->id_personne;

    }

    public function setId_personne($id_personne){

        // Validation en premier

        if(null == $id_personne) return;

        if(!is_int(filter_var($id_personne, FILTER_VALIDATE_INT))){

            $this->listeMessageErreurActif['id_personne'][] =
                self::getListeMessageErreur()['id_personne-invalide'];

            $this->id_personne = null;

            return;

        }

        $this->id_personne = $id_personne;

    }

    public function getNom(){

        return $this->nom;

    }

    public function setNom($nom){

        // Validation en premier

        if (empty($nom)){

            $this->listeMessageErreurActif['nom'][] =
                self::getListeMessageErreur()['nom-vide'];

            return;
        }

        if ( strlen($nom) > self::NOM_NOMBRE_CARACTERE_MAXIMUM){

            $this->listeMessageErreurActif['nom'][] =
                self::getListeMessageErreur()['nom-trop-long'];

        }

        if ( !self::validerNomPropre($nom) ){

            $this->listeMessageErreurActif['nom'][] =
                self::getListeMessageErreur()['nom-non-alphabetique'];

        }

        // Nettoyage en second

        $this->nom = filter_var($nom, FILTER_SANITIZE_STRING);

    }

    public function getPrenom(){

        return $this->prenom;

    }

    public function setPrenom($prenom){

        // Validation en premier

        if (empty($prenom)){

            $this->listeMessageErreurActif['prenom'][] =
                self::getListeMessageErreur()['prenom-vide'];

            return;
        }

        if ( strlen($prenom) > self::PRENOM_NOMBRE_CARACTERE_MAXIMUM){

            $this->listeMessageErreurActif['prenom'][] =
                self::getListeMessageErreur()['prenom-trop-long'];

        }

        if ( !self::validerNomPropre($prenom) ){

            $this->listeMessageErreurActif['prenom'][] =
                self::getListeMessageErreur()['prenom-non-alphabetique'];

        }

        // Nettoyage en second

        $this->$prenom = filter_var($prenom, FILTER_SANITIZE_STRING);

    }

    public function getCourriel(){

        $this->courriel;

    }

    public function setCourriel($courriel){

        // Validation en premier

        if (empty($courriel)){

            $this->listeMessageErreurActif['courriel'][] =
                self::getListeMessageErreur()['courriel-vide'];

            return;
        }

        if ( strlen($courriel) > self::COURRIEL_NOMBRE_CARACTERE_MAXIMUM){

            $this->listeMessageErreurActif['courriel'][] =
                self::getListeMessageErreur()['courriel-trop-long'];

        }

        if ( !filter_var($courriel, FILTER_VALIDATE_EMAIL) ){

            $this->listeMessageErreurActif['courriel'][] =
                self::getListeMessageErreur()['courriel-invalide'];

        }



        // Il est imposible de valider un courriel sans le tester pour de vrai.
        // Les fitres PHP ne sont pas parfait. Un courriel "invalide" ne
        // devrait pas être bloquant.

        $this->courriel = $courriel;

    }

    public function getDate(){

        $this->date;

    }

    public function setDate($date){

        // Validation en premier

        if (empty($date)){

            $this->listeMessageErreurActif['date'][] =
                self::getListeMessageErreur()['date-vide'];

            return;
        }

        if ( strlen($date) > self::DATE_NOMBRE_CARACTERE_MAXIMUM){

            $this->listeMessageErreurActif['date'][] =
                self::getListeMessageErreur()['date-trop-long'];

        }

        $this->date = $date;
      }

}
