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
    "quantiteDefaut" => 1,

    "emailClient" => Panier::EMAIL_CLIENT,
    "idProduit" => Produit::ID_PRODUIT,
    "quantite" => Article::QUANTITE
];

$accesseurProduit = new AccesseurProduit();
$produit = $accesseurProduit->recupererProduitParId($_GET[Produit::ID_PRODUIT]);

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
    $accesseurPanier = new AccesseurPanier();
    if ($accesseurPanier->ajouterPanier(new Panier((object) $_POST))) $page->messageAction = "Produit ajouté au panier";
    else $page->messageAction = "Produit déjà présent dans le panier";
}
