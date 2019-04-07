<?php
/**
 * Created by PhpStorm.
 * User: 1834112
 * Date: 2019-03-13
 * Time: 12:49
 */

require_once(CHEMIN_RACINE_COMMUN . "/modele/Produit.php");
require_once(CHEMIN_RACINE_COMMUN . "/modele/Panier.php");
require_once(CHEMIN_RACINE_COMMUN . "/accesseur/AccesseurProduit.php");
require_once(CHEMIN_RACINE_COMMUN . "/accesseur/AccesseurPanier.php");

if (!isset($_SESSION[CLIENT::EMAIL])) header("location: /");
$page = (object)
[
    "titre" => "Panier",
    "panier" => [],
    "totalHT" => null,
    "totalTTC" => null,
    "pleinOuVide" => null
];

$accesseurPanier = new AccesseurPanier();

if(isset($_POST['supprimer-produit-panier'])) $accesseurPanier->supprimerProduitPanier(new Panier((object) $_POST));

$panier = $accesseurPanier->recupererPanier($_SESSION[Client::EMAIL]);
if($panier) {
    $page->pleinOuVide = "plein";
    $page->panier = $panier;
}
else {
    $page->pleinOuVide = "vide";
}