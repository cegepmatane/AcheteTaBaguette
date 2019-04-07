<?php
/**
 * Created by PhpStorm.
 * User: AlexandreCM
 * Date: 2019-04-07
 * Time: 17:46
 */

require CHEMIN_RACINE_COMMUN . '/outil/genererFacture.php';
require_once(CHEMIN_RACINE_COMMUN . "/modele/Produit.php");
require_once(CHEMIN_RACINE_COMMUN . "/modele/Facture.php");
require_once(CHEMIN_RACINE_COMMUN . "/accesseur/AccesseurProduit.php");
require_once(CHEMIN_RACINE_COMMUN . "/accesseur/AccesseurFacture.php");

if (!isset($_SESSION[CLIENT::EMAIL])) header("location: /");
$page = (object)
[
    "titre" => "Mes factures"
];

$accesseurFacture = new AccesseurFacture();

if (isset($_POST['detail-facture'])) {

    $items = array();
    $prixUnitaire = array();
    $quantite = array();

    $facture = $accesseurFacture->recupererDetailFactureParId($_POST[Facture::ID_FACTURE]);
    foreach ($facture->getListeProduit() as $article) {
        $items[] = $article->getProduit()->getNom();
        $prixUnitaire[] = $article->getProduit()->getPrix();
        $quantite[] = $article->getQuantite();
    }

//$test = "Baguette simple;2.00; 4;6\n\rCroissant;1;2;2\n\rPain au chocolat;1.50;2;3";
    $pdf = new PDF();
    $pdf->genererFacture($items, $prixUnitaire, $quantite);
}

$listefacture = $accesseurFacture->recupererListeFacture($_SESSION[Client::EMAIL]);