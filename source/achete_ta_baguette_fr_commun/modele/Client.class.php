<?php
class Client
{
    public const ID_CLIENT = "id_client";
    public const NOM = "nom";
    public const PRENOM = "prenom";
    public const EMAIL = "email";
    public const MOT_DE_PASSE = "mot_de_passe";
    public const MOT_DE_PASSE_VERIF = "mot_de_passe_verif";
    public const PROVINCE = "province";
    public const REGION = "region";
    public const VILLE = "ville";
    public const RUE = "rue";
    public const CODE_POSTAL = "code_postal";

    private const PATERN_NOM_PROPRE =
        "/^[A-Za-z\x{00C0}-\x{00FF}]" .
        "[A-Za-z\x{00C0}-\x{00FF}\'\-]+([\ A-Za-z\x{00C0}-\x{00FF}]" .
        "[A-Za-z\x{00C0}-\x{00FF}\'\-]+)*/u";

    private const NOM_NOMBRE_CARACTERE_MAXIMUM = 24;
    private const PRENOM_NOMBRE_CARACTERE_MAXIMUM = 24;
    private const EMAIL_NOMBRE_CARACTERE_MAXIMUM = 30;
    private const MOT_DE_PASSE_NOMBRE_CARACTERE_MAXIMUM = 30;
    private const PROVINCE_NOMBRE_CARACTERE_MAXIMUM = 30;
    private const REGION_NOMBRE_CARACTERE_MAXIMUM = 30;
    private const VILLE_NOMBRE_CARACTERE_MAXIMUM = 30;
    private const RUE_NOMBRE_CARACTERE_MAXIMUM = 30;
    private const CODE_POSTAL_NOMBRE_CARACTERE_MAXIMUM = 7;
    private const PAYS_NOMBRE_CARACTERE_MAXIMUM = 7;

    private static $LISTE_MESSAGE_ERREUR = [];

    private static $LISTE_INFORMATION_CHAMP = [];

    private $listeMessageErreurActif = [];

    public $nom;
    public $prenom;
    public $email;
    public $mot_de_passe;
    public $mot_de_passe_verif;
    public $province;
    public $pays;
    public $ville;
    public $rue;
    public $code_postal;
    public $id_client;


    public function isValide($champ = null)
    {

        if (null == $champ) {

            $this->setIdClient($this->id_client);
            $this->setNom($this->nom);
            $this->setPrenom($this->prenom);
            $this->setEmail($this->email);
            $this->setMotDePasse($this->mot_de_passe);
            $this->setProvince($this->province);
            $this->setPays($this->pays);
            $this->setVille($this->ville);
            $this->setRue($this->rue);
            $this->setCodePostal($this->code_postal);
            return $this->listeMessageErreurActif;

        }

        $nomClasse = get_class();
        $constante = "$nomClasse::" . strtoupper($champ);
        if (!defined($constante)) {
            return false;
        }

        return !isset($this->listeMessageErreurActif[$champ]);

    }

    public static function getInformation($champ)
    {

        if (empty(self::$LISTE_INFORMATION_CHAMP)) {

            self::$LISTE_INFORMATION_CHAMP["id_client"] = (object)
                [
                "etiquette" => "",
                "defaut" => "",
                "indice" => "",
                "description" => "",
                "obligatoire" => null,
            ];

            self::$LISTE_INFORMATION_CHAMP["nom"] = (object)
                [
                "etiquette" => "Nom",
                "defaut" => "",
                "indice" => "Ex. : Smith (nombre maximum de caractères : " .
                self::NOM_NOMBRE_CARACTERE_MAXIMUM .
                " )",
                "description" => "Nom de famille",
                "obligatoire" => true,
            ];

            self::$LISTE_INFORMATION_CHAMP["prenom"] = (object)
                [
                "etiquette" => "Prénom",
                "defaut" => "",
                "indice" => "Ex. : Robert (nombre maximum de caractères : " .
                self::PRENOM_NOMBRE_CARACTERE_MAXIMUM .
                " )",
                "description" => "Petit nom",
                "obligatoire" => true,
            ];

            self::$LISTE_INFORMATION_CHAMP["email"] = (object)
                [
                "etiquette" => "Adresse email",
                "defaut" => "",
                "indice" => "Ex. : votre.nom@email.com " .
                "(nombre maximum de caractères : " .
                self::EMAIL_NOMBRE_CARACTERE_MAXIMUM .
                " )",
                "description" => "Adresse électronique",
                "obligatoire" => true,
            ];

            self::$LISTE_INFORMATION_CHAMP["mot_de_passe"] = (object)
                [
                "etiquette" => "Mot de passe",
                "defaut" => "",
                "indice" => "Ex. : M0t2p@6 (nombre maximum de caractères : " .
                self::MOT_DE_PASSE_NOMBRE_CARACTERE_MAXIMUM .
                " )",
                "description" => "Code secret pour vous connecter",
                "obligatoire" => true,
            ];

            self::$LISTE_INFORMATION_CHAMP["mot_de_passe_verif"] = (object)
                [
                "etiquette" => "Confirmer mot de passe",
                "defaut" => "",
                "indice" => "Ex. : M0t2p@6 (nombre maximum de caractères : " .
                self::MOT_DE_PASSE_NOMBRE_CARACTERE_MAXIMUM .
                " )",
                "description" => "Entrez à nouveau votre mot de passe",
                "obligatoire" => true,
            ];

            self::$LISTE_INFORMATION_CHAMP["provine"] = (object)
                [
                "etiquette" => "Province",
                "defaut" => "",
                "indice" => "Ex. : Québec (nombre maximum de caractères : " .
                self::PROVINCE_NOMBRE_CARACTERE_MAXIMUM .
                " )",
                "description" => "Province du Canada",
                "obligatoire" => true,
            ];

            self::$LISTE_INFORMATION_CHAMP["region"] = (object)
                [
                "etiquette" => "Région",
                "defaut" => "",
                "indice" => "Ex. : Bas-Saint-Laurent (nombre maximum de caractères : " .
                self::REGION_NOMBRE_CARACTERE_MAXIMUM .
                " )",
                "description" => "région de la province",
                "obligatoire" => true,
            ];

            self::$LISTE_INFORMATION_CHAMP["ville"] = (object)
                [
                "etiquette" => "Ville",
                "defaut" => "",
                "indice" => "Ex. : Matane (nombre maximum de caractères : " .
                self::VILLE_NOMBRE_CARACTERE_MAXIMUM .
                " )",
                "description" => "Ville de résidence",
                "obligatoire" => true,
            ];

            self::$LISTE_INFORMATION_CHAMP["rue"] = (object)
                [
                "etiquette" => "Rue",
                "defaut" => "",
                "indice" => "Ex. : 616 Av. St-Rédempteur (nombre maximum de caractères : " .
                self::RUE_NOMBRE_CARACTERE_MAXIMUM .
                " )",
                "description" => "Adresse de résidence",
                "obligatoire" => true,
            ];

            self::$LISTE_INFORMATION_CHAMP["code_postal"] = (object)
                [
                "etiquette" => "Code postal",
                "defaut" => "",
                "indice" => "Ex. : G4W 0H2 (nombre maximum de caractères : " .
                self::CODE_POSTAL_NOMBRE_CARACTERE_MAXIMUM .
                " )",
                "description" => "Code de lettres et chiffres alternés",
                "obligatoire" => true,
            ];

        }

        $nomClasse = get_called_class();
        $constante = "$nomClasse::" . strtoupper($champ);
        if (!defined($constante)) {
            return null;
        }

        return self::$LISTE_INFORMATION_CHAMP[$champ];

    }

    public static function getListeMessageErreur()
    {

        if (empty(self::$LISTE_MESSAGE_ERREUR)) {

            self::$LISTE_MESSAGE_ERREUR =
                [
                "id_client-invalide" => true,

                "nom-vide" => "Le nom ne doit pas être vide",
                "nom-trop-long" => "Le nombre maximum de caractères pour le nom est : " . self::NOM_NOMBRE_CARACTERE_MAXIMUM,
                "nom-non-alphabetique" => "Le nom doit contenir uniquement des lettres",

                "prenom-vide" => "Le prénom ne doit pas être vide",
                "prenom-trop-long" => "Le nombre maximum de caractères pour le prénom est : " . self::PRENOM_NOMBRE_CARACTERE_MAXIMUM,
                "prenom-non-alphabetique" => "Le prénom doit contenir uniquement des lettres",

                "email-vide" => "Le email ne doit pas être vide",
                "email-trop-long" => "Le nombre maximum de caractères pour le email est : " . self::EMAIL_NOMBRE_CARACTERE_MAXIMUM,
                "email-invalide" => "Le email n'est pas valide",

                "mot_de_passe-vide" => "Le mot de passe ne doit pas être vide",
                "mot_de_passe-trop-long" => "Le nombre maximum de caractères pour le mot de passe est : " . self::MOT_DE_PASSE_NOMBRE_CARACTERE_MAXIMUM,
                "mot_de_passe-invalide" => "Les mots de passe ne correspondent pas",

                "province-vide" => "La province ne doit pas être vide",
                "province-trop-long" => "Le nombre maximum de caractères pour la province est : " . self::PROVINCE_NOMBRE_CARACTERE_MAXIMUM,
                "province-non-alphabetique" => "La province doit contenir uniquement des lettres",

                "region-vide" => "La region ne doit pas être vide",
                "region-trop-long" => "Le nombre maximum de caractères pour la region est : " . self::REGION_NOMBRE_CARACTERE_MAXIMUM,
                "region-non-alphabetique" => "La region doit contenir uniquement des lettres",

                "ville-vide" => "La ville ne doit pas être vide",
                "ville-trop-long" => "Le nombre maximum de caractères pour la ville est : " . self::VILLE_NOMBRE_CARACTERE_MAXIMUM,
                "ville-non-alphabetique" => "La ville doit contenir uniquement des lettres",

                "rue-vide" => "La rue ne doit pas être vide",
                "rue-trop-long" => "Le nombre maximum de caractères pour la rue est : " . self::RUE_NOMBRE_CARACTERE_MAXIMUM,
                "rue-invalide" => "La rue n'est pas valide",

                "pays-vide" => "La ville ne doit pas être vide",
                "pays-trop-long" => "Le nombre maximum de caractères pour la ville est : " . self::PAYS_NOMBRE_CARACTERE_MAXIMUM,
                "pays-non-alphabetique" => "La ville doit contenir uniquement des lettres",

                "code_postal-vide" => "Le code postal ne doit pas être vide",
                "code_postal-trop-long" => "Le nombre maximum de caractères pour le code postal est : " . self::CODE_POSTAL_NOMBRE_CARACTERE_MAXIMUM,
                "code_postal-invalide" => "Le code postal n'est pas valide",

            ];

        }

        return self::$LISTE_MESSAGE_ERREUR;

    }

    private static function validerNomPropre($nom)
    {
        if (preg_match(self::PATERN_NOM_PROPRE, $nom)) {
            return true;
        }

        return false;
    }

    private static function validerMotDePasse($mot_de_passe, $mot_de_passe_verif)
    {
        if ($mot_de_passe == $mot_de_passe_verif) {
            return true;
        }

        return false;
    }

    private static function validerRue($rue)
    {
        // TODO
    }

    private static function valideCodePostal($code_postal)
    {
        // TODO
    }

    public function getListeMessageErreurActif($champ)
    {

        return $this->listeMessageErreurActif[$champ] ?? [];

    }

    public function getIdClient()
    {

        return $this->id_client;

    }

    public function setIdClient($id_client)
    {

        // Validation en premier

        if (null == $id_client) {
            return;
        }

        if (!is_int(filter_var($id_client, FILTER_VALIDATE_INT))) {

            $this->listeMessageErreurActif['id_client'][] =
            self::getListeMessageErreur()['id_client-invalide'];

            $this->id_client = null;

            return;

        }

        $this->id_client = $id_client;

    }

    public function getNom()
    {

        return $this->nom;

    }

    public function setNom($nom)
    {

        // Validation en premier

        if (empty($nom)) {

            $this->listeMessageErreurActif['nom'][] =
            self::getListeMessageErreur()['nom-vide'];

            return false;
        }

        if (strlen($nom) > self::NOM_NOMBRE_CARACTERE_MAXIMUM) {

            $this->listeMessageErreurActif['nom'][] =
            self::getListeMessageErreur()['nom-trop-long'];

            return false;
        }

        if (!self::validerNomPropre($nom)) {

            $this->listeMessageErreurActif['nom'][] =
            self::getListeMessageErreur()['nom-non-alphabetique'];

            return false;

        }

        // Nettoyage en second

        $this->nom = filter_var($nom, FILTER_SANITIZE_STRING);
        return true;

    }

    public function getPrenom()
    {

        return $this->prenom;

    }

    public function setPrenom($prenom)
    {

        // Validation en premier

        if (empty($prenom)) {

            $this->listeMessageErreurActif['prenom'][] =
            self::getListeMessageErreur()['prenom-vide'];


            return false;

        }

        if (strlen($prenom) > self::PRENOM_NOMBRE_CARACTERE_MAXIMUM) {

            $this->listeMessageErreurActif['prenom'][] =
            self::getListeMessageErreur()['prenom-trop-long'];

            return false;
        }

        if (!self::validerNomPropre($prenom)) {

            $this->listeMessageErreurActif['prenom'][] =
            self::getListeMessageErreur()['prenom-non-alphabetique'];

            return false;
        }

        // Nettoyage en second

        $this->prenom = filter_var($prenom, FILTER_SANITIZE_STRING);

        return true;

    }



    public function getEmail()
    {

        $this->email;

    }

    public function setEmail($email)
    {

        // Validation en premier

        if (empty($email)) {

            $this->listeMessageErreurActif['email'][] =
            self::getListeMessageErreur()['email-vide'];


            return false;
        }

        if (strlen($email) > self::EMAIL_NOMBRE_CARACTERE_MAXIMUM) {

            $this->listeMessageErreurActif['email'][] =
            self::getListeMessageErreur()['email-trop-long'];

            return false;
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

            $this->listeMessageErreurActif['email'][] =
            self::getListeMessageErreur()['email-invalide'];

            return false;
        }

        // Il est imposible de valider un email sans le tester pour de vrai.
        // Les fitres PHP ne sont pas parfait. Un email "invalide" ne
        // devrait pas être bloquant.

        $this->email = $email;
        return true;

    }

    public function getMotDePasse()
    {

        $this->mot_de_passe;

    }

    public function setMotDePasse($mot_de_passe)
    {

        // Validation en premier

        if (empty($mot_de_passe)) {

            $this->listeMessageErreurActif['mot_de_passe'][] =
            self::getListeMessageErreur()['mot_de_passe-vide'];


            return false;
        }

        if (strlen($mot_de_passe) > self::MOT_DE_PASSE_NOMBRE_CARACTERE_MAXIMUM) {

            $this->listeMessageErreurActif['mot_de_passe'][] =
            self::getListeMessageErreur()['mot_de_passe-trop-long'];

            return false;
        }

        if (!self::validerMotDePasse($mot_de_passe, $this->mot_de_passe_verif)) {

            $this->listeMessageErreurActif['mot_de_passe'][] =
            self::getListeMessageErreur()['mot_de_passe-invalide'];

            return false;
        }

        $this->mot_de_passe = $mot_de_passe;

        return true;
    }

    public function getProvince()
    {

        return $this->province;

    }

    public function setProvince($province)
    {

        // Validation en premier

        if (empty($province)) {

            $this->listeMessageErreurActif['province'][] =
            self::getListeMessageErreur()['province-vide'];


            return false;
        }

        if (strlen($province) > self::PROVINCE_NOMBRE_CARACTERE_MAXIMUM) {

            $this->listeMessageErreurActif['province'][] =
            self::getListeMessageErreur()['province-trop-long'];

            return false;
        }

        if (!self::validerNomPropre($province)) {

            $this->listeMessageErreurActif['province'][] =
            self::getListeMessageErreur()['province-non-alphabetique'];

            return false;
        }

        // Nettoyage en second

        $this->province = filter_var($province, FILTER_SANITIZE_STRING);
        return true;

    }

    public function getPays()
    {

        return $this->pays;

    }

    public function setPays($pays)
    {

        // Validation en premier

        if (empty($pays)) {

            $this->listeMessageErreurActif['pays'][] =
            self::getListeMessageErreur()['pays-vide'];


            return false;
        }

        if (strlen($pays) > self::REGION_NOMBRE_CARACTERE_MAXIMUM) {

            $this->listeMessageErreurActif['pays'][] =
            self::getListeMessageErreur()['pays-trop-long'];

            return false;
        }

        if (!self::validerNomPropre($pays)) {

            $this->listeMessageErreurActif['pays'][] =
            self::getListeMessageErreur()['pays-non-alphabetique'];

            return false;
        }

        // Nettoyage en second

        $this->pays = filter_var($pays, FILTER_SANITIZE_STRING);

        return true;
    }

    public function getVille()
    {

        return $this->ville;

    }

    public function setVille($ville)
    {

        // Validation en premier

        if (empty($ville)) {

            $this->listeMessageErreurActif['ville'][] =
            self::getListeMessageErreur()['ville-vide'];


            return false;
        }

        if (strlen($ville) > self::VILLE_NOMBRE_CARACTERE_MAXIMUM) {

            $this->listeMessageErreurActif['ville'][] =
            self::getListeMessageErreur()['ville-trop-long'];

            return false;
        }

        if (!self::validerNomPropre($ville)) {

            $this->listeMessageErreurActif['ville'][] =
            self::getListeMessageErreur()['ville-non-alphabetique'];

            return false;
        }

        // Nettoyage en second

        $this->ville = filter_var($ville, FILTER_SANITIZE_STRING);
        return true;

    }

    public function getRue()
    {

        return $this->rue;

    }

    public function setRue($rue)
    {

        // Validation en premier

        if (empty($rue)) {

            $this->listeMessageErreurActif['rue'][] =
            self::getListeMessageErreur()['rue-vide'];

            return false;
        }

        if (strlen($rue) > self::RUE_NOMBRE_CARACTERE_MAXIMUM) {

            $this->listeMessageErreurActif['rue'][] =
            self::getListeMessageErreur()['rue-trop-long'];

            return false;
        }

        // TODO validerRue
        /*if ( !self::validerRue($rue) ){

        $this->listeMessageErreurActif['region'][] =
        self::getListeMessageErreur()['region-non-invalide'];

        }*/

        // Nettoyage en second

        $this->rue = filter_var($rue, FILTER_SANITIZE_STRING);

        return true;
    }

    public function getCodePostal()
    {

        return $this->code_postal;

    }

    public function setCodePostal($code_postal)
    {

        // Validation en premier

        if (empty($code_postal)) {

            $this->listeMessageErreurActif['code_postal'][] =
            self::getListeMessageErreur()['code_postal-vide'];

            return false;
        }

        if (strlen($code_postal) > self::CODE_POSTAL_NOMBRE_CARACTERE_MAXIMUM) {

            $this->listeMessageErreurActif['code_postal'][] =
            self::getListeMessageErreur()['code_postal-trop-long'];

            return false;
        }

        // TODO validerCodePostal
        /*if ( !self::validerCodePostal($code_postal) ){

        $this->listeMessageErreurActif['code_postal'][] =
        self::getListeMessageErreur()['code_postal-non-invalide'];

        }*/

        // Nettoyage en second

        $this->code_postal = filter_var($code_postal, FILTER_SANITIZE_STRING);
        return true;
    }

}

// EOF
