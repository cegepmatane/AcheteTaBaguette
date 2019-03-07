<?php
require_once CHEMIN_RACINE_COMMUN . "/accesseur/AccesseurProduit.php";
require_once CHEMIN_RACINE_COMMUN . "/modele/Redirection.php";


$page = (object)
[
	"titre" => "Page index",
	"titrePrincipal" => "Le titre principal H1",
	"itemMenuActif" => "baguette",
	"isConnected" => true,
	"addProduit" => false,
	"nom" => "Affin",
	"prenom" => "Jean-Yves",
	"courriel" => "jean-yves@affin.net",
	"rue" => "616 Av. St-Redempteur",
	"ville" => "Matane",
	"province" => "Québec",
	"codePostal" => "G4W 0H2",
	"pays" => "Canada",
	"id_personne" => 1,
	"listeProduits" => null,
];



$laBDD = new AccesseurProduit();
$laBDD2 = new AccesseurCategorie();
$page->listeProduits = $laBDD->recupererListeProduits();
$page->listeCategorie = $laBDD2->recupererlisteCategorie();

function supprimerProduit ($produit){
	$laBDD->supprimerProduit($produit);
}
function recupererLabelCategorieParProduit($page, $produit){
	
		foreach ($page->listeCategorie as $categorie) {
			if($categorie->getIdCategorie() == $produit->getIdCategorie()) return $categorie->getLabel();

		}


	}

	$laRedirection = new Redirection("/administration/vue/index.php");

	if(isset($_POST['action-modifier-produit'])){ 

		$attribut = (object)
		[
			"nom" => "",
			"categorie" => "",
			"description" => "",
			"stock" => null,
			"prix" => "12",
			"srcImage" => "test.png", 
		];
		$produit = new Produit($attribut);
		$produit->setNom($_POST['produit']);
		$produit->setIdCategorie($_POST['categorie']);
		$produit->setDescription($_POST['description']);
		$produit->setStock($_POST['stock']);
		$produit->setPrix($_POST['prix']);
		$laBDD->ajouterProduit($produit);
		$page->addProduit = true;

		if($page->addProduit ?? false){
			header("Location: " . "/administration/vue/index.php");
			exit;
			$page->addProduit = false;
		}

	}

	$page->listeProduits = $laBDD->recupererListeProduits();
	$page->listeCategorie = $laBDD2->recupererlisteCategorie();
	?>