<?php
/**
 * Created by PhpStorm.
 * User: AlexandreCM
 * Date: 2019-03-17
 * Time: 15:28
 */

require_once(CHEMIN_RACINE_COMMUN . "/modele/Client.php");
require_once(CHEMIN_RACINE_COMMUN . "/modele/Produit.php");
require_once(CHEMIN_RACINE_COMMUN . "/modele/Panier.php");
require_once(CHEMIN_RACINE_COMMUN . "/accesseur/AccesseurProduit.php");
require_once(CHEMIN_RACINE_COMMUN . "/accesseur/AccesseurPanier.php");

require_once(CHEMIN_RACINE_UTILISATEUR .'/vendor/autoload.php');


// Mise en forme du panier pour paypal
$accesseurPanier = new AccesseurPanier();
$accesseurProduit = new AccesseurProduit();

$panier = [];
$TVA = 0.2;
$prixPanier = 0;

$listePanier = $accesseurPanier->recupererPanier('jean-yves.affin@gmail.com');

foreach ($listePanier as $panierClient) {
    $produit = $accesseurProduit->recupererProduitParId($panierClient->getIdProduit());

    $items = (object)
    [
        "nom" => $produit->getNom(),
        "description" => $produit->getDescription(),
        "prix" => $produit->getPrix(),
        "quantite" => $panierClient->getNbProduit()
    ];
    $prixPanier += $produit->getPrix()*$panierClient->getNbProduit();
    $panier['item'][] = $items;
}
$panier['TVA'] = $TVA;
$panier['prix'] = $prixPanier;

//print_r($panier);
// Fin Mise en forme du panier pour paypal


// -------- Config Paypal --------
$ids = require(CHEMIN_RACINE_UTILISATEUR .'/configuration/configuration-paypal.php');
$apiContext = new \PayPal\Rest\ApiContext(
    new \PayPal\Auth\OAuthTokenCredential(
        $ids['id'],
        $ids['secret']
    )
);

$list = new \PayPal\Api\ItemList();
foreach ($panier['item'] as $produit) {
    $item = (new \PayPal\Api\Item())
        ->setName($produit->nom)
        ->setDescription($produit->description)
        ->setPrice($produit->prix)
        ->setCurrency('CAD')
        ->setQuantity($produit->quantite);
    $list->addItem($item);
}
//print_r($list);

$details = (new \PayPal\Api\Details())
    ->setTax($panier['TVA'])
    ->setSubtotal($panier['prix']);
//print_r($details);

$amount = (new \PayPal\Api\Amount())
    ->setTotal($panier['prix'] + $panier['TVA'])
    ->setCurrency("CAD")
    ->setDetails($details);
//print_r($amount);

$transaction = (new \PayPal\Api\Transaction())
    ->setItemList($list)
    ->setDescription('Achat sur achetetabaguette.fr')
    ->setAmount($amount)
    ->setCustom('demo-1');
//print_r(json_decode($transaction));

$payment = new \PayPal\Api\Payment();
$payment->addTransaction($transaction);
$payment->setIntent('sale');

$redirectUrls = (new \PayPal\Api\RedirectUrls())
    ->setReturnUrl('http://localhost:1200/utilisateur/vue/confirmation-payment.php')
    ->setCancelUrl('http://localhost:1200/panier');

$payment->setRedirectUrls($redirectUrls);
$payment->setPayer((new \PayPal\Api\Payer())->setPaymentMethod('paypal'));
//print_r(json_decode($payment));

try {
    $payment->create($apiContext);
    header('Location: ' . $payment->getApprovalLink());
} catch (\PayPal\Exception\PayPalConnectionException $e) {
    var_dump(json_decode($e->getData()));
}