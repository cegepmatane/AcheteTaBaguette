<?php
/**
 * Created by PhpStorm.
 * User: AlexandreCM
 * Date: 2019-03-17
 * Time: 15:28
 */

require_once(CHEMIN_RACINE_COMMUN . "/modele/Produit.php");
require_once(CHEMIN_RACINE_COMMUN . "/modele/Panier.php");
require_once(CHEMIN_RACINE_COMMUN . "/accesseur/AccesseurProduit.php");
require_once(CHEMIN_RACINE_COMMUN . "/accesseur/AccesseurPanier.php");

require_once(CHEMIN_RACINE_UTILISATEUR .'/vendor/autoload.php');


// Mise en forme du panier pour paypal
$accesseurPanier = new AccesseurPanier();
$panier = $accesseurPanier->recupererPanier($_SESSION[Client::EMAIL]);
$TVA = 0.14975;

// -------- Config Paypal --------
$ids = require(CHEMIN_RACINE_UTILISATEUR .'/configuration/configuration-paypal.php');
$apiContext = new \PayPal\Rest\ApiContext(
    new \PayPal\Auth\OAuthTokenCredential(
        $ids['id'],
        $ids['secret']
    )
);

$list = new \PayPal\Api\ItemList();
foreach ($panier->getListeProduit() as $article) {
    $item = (new \PayPal\Api\Item())
        ->setName($article->getProduit()->getNom())
        ->setDescription($article->getProduit()->getDescription())
        ->setPrice($article->getProduit()->getPrix())
        ->setCurrency('CAD')
        ->setQuantity($article->getQuantite());
    $list->addItem($item);
}
//print_r($list);

$details = (new \PayPal\Api\Details())
    ->setTax($panier->getPrixHT() * $TVA)
    ->setSubtotal($panier->getPrixHT());
//print_r($details);

$amount = (new \PayPal\Api\Amount())
    ->setTotal($panier->getPrixTTC())
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
    ->setReturnUrl('http://localhost:1200/merci')
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