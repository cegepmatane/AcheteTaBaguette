<?php
/**
 * Created by PhpStorm.
 * User: AlexandreCM
 * Date: 2019-03-13
 * Time: 18:51
 */

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