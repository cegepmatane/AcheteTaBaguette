<?php
/**
 * Created by PhpStorm.
 * User: AlexandreCM
 * Date: 2019-03-07
 * Time: 13:42
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

if (isset($_POST['ajout-au-panier']))
{
    if (!isset($_SESSION[Client::EMAIL])) header("location: /connexion");

    $panier = new Panier((object) $_POST);
    $accesseurPanier = new AccesseurPanier();
    if ($accesseurPanier->ajouterPanier($panier)) $page->messageAction = "Produit ajouté au panier";
    else $page->messageAction = "Produit déjà présent dans le panier";

//    header('location: /boutique/produit/'.$panier->getIdProduit());
}
