<?php
/**
 * Created by PhpStorm.
 * User: 1834112
 * Date: 2019-03-13
 * Time: 12:49
 */

require_once("../../commun/vue/entete-fragment.php");
require_once("../../commun/vue/pied-de-page-fragment.php");
require_once("../../commun/vue/sidebar-client-fragment.php");

require_once(CHEMIN_RACINE_COMMUN . "/modele/Produit.php");
require_once(CHEMIN_RACINE_COMMUN . "/modele/Panier.php");
require_once(CHEMIN_RACINE_COMMUN . "/accesseur/AccesseurProduit.php");
require_once(CHEMIN_RACINE_COMMUN . "/accesseur/AccesseurPanier.php");


$page = (object)
[
    "titre" => "Panier",
    "listeProduit" => [],
    "totalHT" => null,
    "totalTTC" => null,

];

$accesseurPanier = new AccesseurPanier();
$accesseurProduit = new AccesseurProduit();

if(isset($_POST['supprimer-produit-panier'])) $accesseurPanier->supprimerProduitPanier(new Panier((object) $_POST));

$listePanier = $accesseurPanier->recupererPanier($_SESSION[Client::EMAIL]);

foreach($listePanier as $panier) {
    $produit = $accesseurProduit->recupererProduitParId($panier->getIdProduit());
    $monProduit = (object)
    [
        "idProduit" => $produit->getIdProduit(),
        "nom" => $produit->getNom(),
        "prix" => $produit->getPrix(),
        "nombre" => $panier->getNbProduit(),
        "totalUnitaire" => $produit->getPrix()*$panier->getNbProduit(),

    ];
    $page->listeProduit[] = $monProduit;

    $page->totalHT += $produit->getPrix()*$panier->getNbProduit();
    $page->totalTTC += round($produit->getPrix()*$panier->getNbProduit() + $produit->getPrix()*$panier->getNbProduit() * (0.05+0.09975),2);
}