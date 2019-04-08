<?php
require_once CHEMIN_RACINE_COMMUN . "/accesseur/AccesseurProduit.php";
require_once CHEMIN_RACINE_COMMUN . "/modele/Redirection.php";
require_once CHEMIN_RACINE_COMMUN . "/modele/Produit.php";

if(!isset($_SESSION[Client::ADMINISTRATEUR]) && !$_SESSION[Client::ADMINISTRATEUR]) header('Location: /');

$page = (object)
[
	"titre" => "Modifier"
];

$accesseurProduit = new AccesseurProduit();

if(isset($_POST['action-modifier-produit'])) {
    $produit = $accesseurProduit->miseAJourProduit(new Produit((object)$_POST));
    header('Location: /administration/modifier/'.$produit->getIdProduit());
}

$produit = $accesseurProduit->recupererProduitParId($_GET[Produit::ID_PRODUIT]);