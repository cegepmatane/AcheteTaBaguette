<?php
/**
 * Created by PhpStorm.
 * User: AlexandreCM
 * Date: 2019-03-13
 * Time: 18:51
 */

$page = (object)
[
    "titre" => "Panier",
    "messageAction" => "",
    "indicePetitStock" => 5,
    "nbProduitDefaut" => 1,

    "emailClient" => Panier::EMAIL_CLIENT,
    "idProduit" => Panier::ID_PRODUIT,
    "nbProduit" => Panier::NB_PRODUIT,
];

$accesseurProduit = new AccesseurProduit();
$produit = $accesseurProduit->recupererProduitParId($_GET[Panier::ID_PRODUIT]);

$produitSimilaireBase = $accesseurProduit->recupererProduitParType($produit->getIdCategorie());
$produitSimilaire = [];
$nb = 0;

foreach ($produitSimilaireBase as $unProduit) {
    if($nb == 6) break;
    $nb++;

    $produitSimilaire[] = new Produit($unProduit);
}

if (isset($_POST['ajout-au-panier']))
{
    if (!isset($_SESSION[CLIENT::EMAIL])) header("location: /connexion");
    $panier = new Panier((object) $_POST);
    $accesseurPanier = new AccesseurPanier();
    if ($accesseurPanier->ajouterPanier($panier)) $page->messageAction = "Produit ajouté au panier";
    else $page->messageAction = "Produit déjà présent dans le panier";
}
