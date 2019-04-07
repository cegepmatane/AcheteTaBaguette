<?php
/**
 * Created by PhpStorm.
 * User: AlexandreCM
 * Date: 2019-04-07
 * Time: 17:46
 */

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

$listefacture = $accesseurFacture->recupererListeFacture($_SESSION[Client::EMAIL]);