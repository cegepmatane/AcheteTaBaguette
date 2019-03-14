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

$idProduit = $_GET['idProduit'];
$produit = $laBDD-> recupererProduitParId($idProduit);

function modifierProduit ($produit){
	echo 'test';
	$laBDD->modifierProduit($produit);
	
}
function recupererLabelCategorieParProduit($page, $produit){
	
	foreach ($page->listeCategorie as $categorie) {
		if($categorie->getIdCategorie() == $produit->getIdCategorie()) return $categorie->getLabel();

	}

}

if(isset($_POST['action-modifier-produit'])){

	$produit = new Produit((object)$_POST);
	$laBDD->modifierProduit($produit);

}

$page->listeProduits = $laBDD->recupererListeProduits();
$page->listeCategorie = $laBDD2->recupererListeCategorie();

?>