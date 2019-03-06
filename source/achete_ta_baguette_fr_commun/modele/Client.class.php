<?php
class Client
{
    public const ID_CLIENT = "idClient";
    public const NOM = "nom";
    public const PRENOM = "prenom";
    public const EMAIL = "email";
    public const MOT_DE_PASSE = "motDePasse";
    public const PROVINCE = "province";
    public const PAYS = "pays";
    public const REGION = "region";
    public const VILLE = "ville";
    public const RUE = "rue";
    public const CODE_POSTAL = "codePostal";
    public const ADMINISTRATEUR = "administrateur";

    private const PATERN_NOM_PROPRE =
        "/^[A-Za-z\x{00C0}-\x{00FF}]" .
        "[A-Za-z\x{00C0}-\x{00FF}\'\-]+([\ A-Za-z\x{00C0}-\x{00FF}]" .
        "[A-Za-z\x{00C0}-\x{00FF}\'\-]+)*/u";

    private const NOM_NOMBRE_CARACTERE_MAXIMUM = 24;
    private const PRENOM_NOMBRE_CARACTERE_MAXIMUM = 24;
    private const EMAIL_NOMBRE_CARACTERE_MAXIMUM = 30;
    private const MOT_DE_PASSE_NOMBRE_CARACTERE_MAXIMUM = 64;
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
    public $motDePasse;
    public $province;
    public $pays;
    public $ville;
    public $rue;
    public $codePostal;
    public $administrateur;
    public $idClient;

    public function __construct(object $attribut)
    {
        if (!is_object($attribut)) {
            $attribut = (object) [];
        }
        $this->setNom($attribut->nom ?? "");
        $this->setPrenom($attribut->prenom ?? "");
        $this->setEmail($attribut->email ?? "");
        $this->setMotDePasse($attribut->motDePasse ?? "");
        $this->setProvince($attribut->province ?? "");
        $this->setPays($attribut->pays ?? "");
        $this->setVille($attribut->ville ?? "");
        $this->setRue($attribut->rue ?? "");
        $this->setCodePostal($attribut->codePostal ?? "");
        $this->setAdministrateur($attribut->administrateur ?? false);
        $this->setIdClient($attribut->idClient ?? null);
    }

    public function isValide($champ = null)
    {

        if (null == $champ) {

            $this->setIdClient($this->idClient);
            $this->setNom($this->nom);
            $this->setPrenom($this->prenom);
            $this->setEmail($this->email);
            $this->setMotDePasse($this->motDePasse);
            $this->setProvince($this->province);
            $this->setPays($this->pays);
            $this->setVille($this->ville);
            $this->setRue($this->rue);
            $this->setCodePostal($this->codePostal);
            $this->setAdministrateur($this->administrateur);
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

            self::$LISTE_INFORMATION_CHAMP[self::ID_CLIENT] = (object)
                [
                "etiquette" => "",
                "defaut" => "",
                "indice" => "",
                "description" => "",
                "obligatoire" => null,
            ];

            self::$LISTE_INFORMATION_CHAMP[self::NOM] = (object)
                [
                "etiquette" => "Nom",
                "defaut" => "",
                "indice" => "Ex. : Smith (nombre maximum de caractères : " .
                self::NOM_NOMBRE_CARACTERE_MAXIMUM .
                " )",
                "description" => "Nom de famille",
                "obligatoire" => true,
            ];

            self::$LISTE_INFORMATION_CHAMP[self::PRENOM] = (object)
                [
                "etiquette" => "Prénom",
                "defaut" => "",
                "indice" => "Ex. : Robert (nombre maximum de caractères : " .
                self::PRENOM_NOMBRE_CARACTERE_MAXIMUM .
                " )",
                "description" => "Petit nom",
                "obligatoire" => true,
            ];

            self::$LISTE_INFORMATION_CHAMP[self::EMAIL] = (object)
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

            self::$LISTE_INFORMATION_CHAMP[self::MOT_DE_PASSE] = (object)
                [
                "etiquette" => "Mot de passe",
                "defaut" => "",
                "indice" => "Ex. : M0t2p@6 (nombre maximum de caractères : " .
                self::MOT_DE_PASSE_NOMBRE_CARACTERE_MAXIMUM .
                " )",
                "description" => "Code secret pour vous connecter",
                "obligatoire" => true,
            ];

            self::$LISTE_INFORMATION_CHAMP[self::PROVINCE] = (object)
                [
                "etiquette" => "Province",
                "defaut" => "",
                "indice" => "Ex. : Québec (nombre maximum de caractères : " .
                self::PROVINCE_NOMBRE_CARACTERE_MAXIMUM .
                " )",
                "description" => "Province du Canada",
                "obligatoire" => true,
            ];

            self::$LISTE_INFORMATION_CHAMP[self::PAYS] = (object)
            [
                "etiquette" => "Pays",
                "defaut" => "",
                "indice" => "Ex. : CANADA (nombre maximum de caractères : " .
                    self::PAYS_NOMBRE_CARACTERE_MAXIMUM .
                    " )",
                "description" => "Pays de résidence",
                "obligatoire" => true,
            ];

            self::$LISTE_INFORMATION_CHAMP[self::REGION] = (object)
                [
                "etiquette" => "Région",
                "defaut" => "",
                "indice" => "Ex. : Bas-Saint-Laurent (nombre maximum de caractères : " .
                self::REGION_NOMBRE_CARACTERE_MAXIMUM .
                " )",
                "description" => "région de la province",
                "obligatoire" => true,
            ];

            self::$LISTE_INFORMATION_CHAMP[self::VILLE] = (object)
                [
                "etiquette" => "Ville",
                "defaut" => "",
                "indice" => "Ex. : Matane (nombre maximum de caractères : " .
                self::VILLE_NOMBRE_CARACTERE_MAXIMUM .
                " )",
                "description" => "Ville de résidence",
                "obligatoire" => true,
            ];

            self::$LISTE_INFORMATION_CHAMP[self::RUE] = (object)
                [
                "etiquette" => "Rue",
                "defaut" => "",
                "indice" => "Ex. : 616 Av. St-Rédempteur (nombre maximum de caractères : " .
                self::RUE_NOMBRE_CARACTERE_MAXIMUM .
                " )",
                "description" => "Adresse de résidence",
                "obligatoire" => true,
            ];

            self::$LISTE_INFORMATION_CHAMP[self::CODE_POSTAL] = (object)
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
                "idClient-invalide" => true,

                "nom-vide" => "Le nom ne doit pas être vide",
                "nom-trop-long" => "Le nombre maximum de caractères pour le nom est : " . self::NOM_NOMBRE_CARACTERE_MAXIMUM,
                "nom-non-alphabetique" => "Le nom doit contenir uniquement des lettres",

                "prenom-vide" => "Le prénom ne doit pas être vide",
                "prenom-trop-long" => "Le nombre maximum de caractères pour le prénom est : " . self::PRENOM_NOMBRE_CARACTERE_MAXIMUM,
                "prenom-non-alphabetique" => "Le prénom doit contenir uniquement des lettres",

                "email-vide" => "Le email ne doit pas être vide",
                "email-trop-long" => "Le nombre maximum de caractères pour le email est : " . self::EMAIL_NOMBRE_CARACTERE_MAXIMUM,
                "email-invalide" => "Le email n'est pas valide",

                "motDePasse-vide" => "Le mot de passe ne doit pas être vide",
                "motDePasse-trop-long" => "Le nombre maximum de caractères pour le mot de passe est : " . self::MOT_DE_PASSE_NOMBRE_CARACTERE_MAXIMUM,
                "motDePasse-invalide" => "Les mots de passe ne correspondent pas",

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

                "codePostal-vide" => "Le code postal ne doit pas être vide",
                "codePostal-trop-long" => "Le nombre maximum de caractères pour le code postal est : " . self::CODE_POSTAL_NOMBRE_CARACTERE_MAXIMUM,
                "codePostal-invalide" => "Le code postal n'est pas valide",

                "administrateur-non-invalide" => "Format invalide",

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

    private static function validerAdministrateur($administrateur)
    {
        if ($administrateur == true || $administrateur == false) return true;
        return false;
    }

    private static function validerRue($rue)
    {
        // TODO
    }

    private static function valideCodePostal($codePostal)
    {
        // TODO
    }

    public function getListeMessageErreurActif($champ)
    {

        return $this->listeMessageErreurActif[$champ] ?? [];

    }

    public function getIdClient()
    {

        return $this->idClient;

    }

    public function setIdClient($idClient)
    {

        // Validation en premier

        if (null == $idClient) {
            return;
        }

        if (!is_int(filter_var($idClient, FILTER_VALIDATE_INT))) {

            $this->listeMessageErreurActif[self::ID_CLIENT][] =
            self::getListeMessageErreur()['idClient-invalide'];

            $this->idClient = null;

            return;

        }

        $this->idClient = $idClient;

    }

    public function getNom()
    {

        return $this->nom;

    }

    public function setNom($nom)
    {

        // Validation en premier

        if (empty($nom)) {

            $this->listeMessageErreurActif[self::NOM][] =
            self::getListeMessageErreur()['nom-vide'];

            return false;
        }

        if (strlen($nom) > self::NOM_NOMBRE_CARACTERE_MAXIMUM) {

            $this->listeMessageErreurActif[self::NOM][] =
            self::getListeMessageErreur()['nom-trop-long'];

            return false;
        }

        if (!self::validerNomPropre($nom)) {

            $this->listeMessageErreurActif[self::NOM][] =
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

            $this->listeMessageErreurActif[self::PRENOM][] =
            self::getListeMessageErreur()['prenom-vide'];


            return false;

        }

        if (strlen($prenom) > self::PRENOM_NOMBRE_CARACTERE_MAXIMUM) {

            $this->listeMessageErreurActif[self::PRENOM][] =
            self::getListeMessageErreur()['prenom-trop-long'];

            return false;
        }

        if (!self::validerNomPropre($prenom)) {

            $this->listeMessageErreurActif[self::PRENOM][] =
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

            $this->listeMessageErreurActif[self::EMAIL][] =
            self::getListeMessageErreur()['email-vide'];


            return false;
        }

        if (strlen($email) > self::EMAIL_NOMBRE_CARACTERE_MAXIMUM) {

            $this->listeMessageErreurActif[self::EMAIL][] =
            self::getListeMessageErreur()['email-trop-long'];

            return false;
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

            $this->listeMessageErreurActif[self::EMAIL][] =
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

        $this->motDePasse;

    }

    public function setMotDePasse($motDePasse)
    {

        // Validation en premier

        if (empty($motDePasse)) {

            $this->listeMessageErreurActif[self::MOT_DE_PASSE][] =
            self::getListeMessageErreur()['motDePasse-vide'];


            return false;
        }

        if (strlen($motDePasse) > self::MOT_DE_PASSE_NOMBRE_CARACTERE_MAXIMUM) {

            $this->listeMessageErreurActif[self::MOT_DE_PASSE][] =
            self::getListeMessageErreur()['motDePasse-trop-long'];

            return false;
        }

        $this->motDePasse = $motDePasse;

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

            $this->listeMessageErreurActif[self::PROVINCE][] =
            self::getListeMessageErreur()['province-vide'];


            return false;
        }

        if (strlen($province) > self::PROVINCE_NOMBRE_CARACTERE_MAXIMUM) {

            $this->listeMessageErreurActif[self::PROVINCE][] =
            self::getListeMessageErreur()['province-trop-long'];

            return false;
        }

        if (!self::validerNomPropre($province)) {

            $this->listeMessageErreurActif[self::PROVINCE][] =
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

            $this->listeMessageErreurActif[self::PAYS][] =
            self::getListeMessageErreur()['pays-vide'];


            return false;
        }

        if (strlen($pays) > self::REGION_NOMBRE_CARACTERE_MAXIMUM) {

            $this->listeMessageErreurActif[self::PAYS][] =
            self::getListeMessageErreur()['pays-trop-long'];

            return false;
        }

        if (!self::validerNomPropre($pays)) {

            $this->listeMessageErreurActif[self::PAYS][] =
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

            $this->listeMessageErreurActif[self::VILLE][] =
            self::getListeMessageErreur()['ville-vide'];


            return false;
        }

        if (strlen($ville) > self::VILLE_NOMBRE_CARACTERE_MAXIMUM) {

            $this->listeMessageErreurActif[self::VILLE][] =
            self::getListeMessageErreur()['ville-trop-long'];

            return false;
        }

        if (!self::validerNomPropre($ville)) {

            $this->listeMessageErreurActif[self::VILLE][] =
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

            $this->listeMessageErreurActif[self::RUE][] =
            self::getListeMessageErreur()['rue-vide'];

            return false;
        }

        if (strlen($rue) > self::RUE_NOMBRE_CARACTERE_MAXIMUM) {

            $this->listeMessageErreurActif[self::RUE][] =
            self::getListeMessageErreur()['rue-trop-long'];

            return false;
        }

        // TODO validerRue
        /*if ( !self::validerRue($rue) ){

        $this->listeMessageErreurActif[self::RUE][] =
        self::getListeMessageErreur()['rue-non-invalide'];

        }*/

        // Nettoyage en second

        $this->rue = filter_var($rue, FILTER_SANITIZE_STRING);

        return true;
    }

    public function getCodePostal()
    {

        return $this->codePostal;

    }

    public function setCodePostal($codePostal)
    {

        // Validation en premier

        if (empty($codePostal)) {

            $this->listeMessageErreurActif[self::CODE_POSTAL][] =
            self::getListeMessageErreur()['codePostal-vide'];

            return false;
        }

        if (strlen($codePostal) > self::CODE_POSTAL_NOMBRE_CARACTERE_MAXIMUM) {

            $this->listeMessageErreurActif[self::CODE_POSTAL][] =
            self::getListeMessageErreur()['codePostal-trop-long'];

            return false;
        }

        // TODO validerCodePostal
        /*if ( !self::validerCodePostal($codePostal) ){

        $this->listeMessageErreurActif[self::CODE_POSTAL][] =
        self::getListeMessageErreur()['codePostal-non-invalide'];

        }*/

        // Nettoyage en second

        $this->codePostal = filter_var($codePostal, FILTER_SANITIZE_STRING);
        return true;
    }

    public function getAdministrateur()
    {

        return $this->administrateur;

    }

    public function setAdministrateur($administrateur)
    {

        // Validation en premier

        if ( !self::validerAdministrateur($administrateur) ){

            $this->listeMessageErreurActif[self::ADMINISTRATEUR][] =
            self::getListeMessageErreur()['administrateur-non-invalide'];

        }

        // Nettoyage en second

        $this->administrateur = filter_var($administrateur, FILTER_SANITIZE_STRING);
        return true;
    }

}

// EOF
