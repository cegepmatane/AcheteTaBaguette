<?php

require CHEMIN_RACINE_COMMUN . '/outil/genererFacture.php';

require_once CHEMIN_RACINE_COMMUN . "/modele/Produit.php";
require_once CHEMIN_RACINE_COMMUN . "/modele/Panier.php";
require_once CHEMIN_RACINE_COMMUN . "/accesseur/AccesseurProduit.php";
require_once CHEMIN_RACINE_COMMUN . "/accesseur/AccesseurPanier.php";

if (isset($_GET['facture'])) {
    $page = (object)
        [
        "titre" => "Panier",
        "listeProduit" => [],
        "totalHT" => null,
        "totalTTC" => null,
    ];

    //$infoPDF = array();

    $items = array();
    $prixUnitaire = array();
    $quantite = array();

    $listePanier = $accesseurPanier->recupererPanier($_SESSION[Client::EMAIL]);

    foreach ($listePanier as $panier) {
        $produit = $accesseurProduit->recupererProduitParId($panier->getIdProduit());

        $items[] = $produit->getNom();
        $prixUnitaire[] = $produit->getPrix();
        $quantite[] = $panier->getNbProduit();
    }

//$test = "Baguette simple;2.00; 4;6\n\rCroissant;1;2;2\n\rPain au chocolat;1.50;2;3";
    $pdf = new PDF();
    $pdf->genererFacture($items, $prixUnitaire, $quantite);
}
