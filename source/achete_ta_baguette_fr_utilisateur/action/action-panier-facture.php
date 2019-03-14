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

    $infoPDF = "";

    $listePanier = $accesseurPanier->recupererPanier($_SESSION[Client::EMAIL]);

    foreach ($listePanier as $panier) {
        $produit = $accesseurProduit->recupererProduitParId($panier->getIdProduit());
        $monProduit = (object)
            [
            "nom" => $produit->getNom(),
            "prix" => $produit->getPrix(),
            "nombre" => $panier->getNbProduit(),
        ];
        $page->listeProduit[] = $monProduit;

        $infoPDF = $infoPDF . $produit->getNom() . ";" . $produit->getPrix() . ";" . $panier->getNbProduit() . "\n\r";
    }

//$test = "Baguette simple;2.00; 4;6\n\rCroissant;1;2;2\n\rPain au chocolat;1.50;2;3";
    ob_start();
    $pdf = new PDF();
    $pdf->genererFacture($infoPDF);
    ob_end_flush();
}
