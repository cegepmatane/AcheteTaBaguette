<?php

class Produit
{

private $listeMessageErreurActif = [];
	private $idProduit;
    private $nom;
    private $description;
    private $prix;
    private $idCategorie;
    private $stock;
    private $srcImage;
    
	private static function getListeMessageErreur(){

        if(empty(self::$LISTE_MESSAGE_ERREUR)){

            self::$LISTE_MESSAGE_ERREUR =
            [
                "id_produit-invalide" =>
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

    public function __construct($attribut)
    {
	  


	if(!is_object($attribut)){ 
        $attribut = (object)[];
    }
		$this->setIdProduit($attribut->idProduit ?? "");
        $this->setNom($attribut->nom ?? "");
        $this->setPrix($attribut->prix ?? null);
        $this->setIdCategorie($attribut->idCategorie ?? NULL);
		$this->setStock($attribut->stock ?? NULL);
        $this->setSrcImage($attribut->srcImage ?? NULL);
        $this->setDescription($attribut->description ?? "");
        
    }

	public function setIdProduit($idProduit)
    {
        // Validation en premier

        if(null == $idProduit) return;

        if(!is_int(filter_var($idProduit, FILTER_VALIDATE_INT))){

            $this->listeMessageErreurActif['idProduit'][] =
                self::getListeMessageErreur()['id_produit-invalide'];

            $this->idProduit= null;

            return;

        }

        $this->idProduit = $idProduit;

    }

	 public function setNom($nouveauNom)
    {
      $this->nom=$nouveauNom;
    }

     public function setDescription($nouvelleDescription)
    {
      $this->description=$nouvelleDescription;
    }

     public function setSrcImage($nouveauSrcImage)
    {
      $this->srcImage=$nouveauSrcImage;
    }

    public function setPrix($nouveauPrix)
    {
        if ($nouveauPrix < 0) {
            $this->prix = 0;
        } else {
            $this->prix = $nouveauPrix;
        }
    }

    public function setIdCategorie($nouvelleCategorie)
    {
        $this->idCategorie = $nouvelleCategorie;
    }

    public function setStock($nouveauStock)
    {
        if ($nouveauStock < 0) {
            $this->nbStock = 0;
        } else {
            $this->stock = $nouveauStock;
        }
    }

    public function getNom()
    {
        return $this->nom;
    }

        public function getDescription()
    {
        return $this->description;
    }
      public function getSrcImage()
    {
        return $this->srcImage;
    }
	public function getIdProduit()
    {
        return $this->idProduit;
    }
    public function getPrix()
    {
        return $this->prix;
    }
    public function getIdCategorie()
    {
        return $this->idCategorie;
    }
    public function getStock()
    {
        return $this->stock;
    }
    public function getId(){
        return $this->idProduit;
    }

}
