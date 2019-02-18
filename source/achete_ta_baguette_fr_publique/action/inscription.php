<?php
/**
 * Created by PhpStorm.
 * User: yonne
 * Date: 18/02/2019
 * Time: 16:52
 */

$attribut = new stdClass();
$attribut->nom = $_POST['nom'];
$attribut->prenom = $_POST['prenom'];
$attribut->pays = $_POST['pays'];
$attribut->code_postal = $_POST['codePostale'];
$attribut->province = $_POST['province'];
$attribut->mail = $_POST['mail'];
$attribut->date_de_naissance = $_POST['date'];
$attribut->mot_de_passe = $_POST['mot_de_passe'];
$attribut->mot_de_passe_verif = $_POST['mot_de_passe_verif'];
$attribut->ville = $_POST['ville'];
$attribut->rue = $_POST['rue'];

$client = new Client($attribut);
if (!empty($client->isValide())) {
    afficherErreurInscription();
    header("Location: /inscription");
} else {
    $laBDD = new AccesseurClient();
    $laBDD->ajouterClient($client);
    $_SESSION['id'] = $laBDD->getClientParEmail($client->email);
    $_SESSION['isConnected'] = true;
    $_SESSION['admin'] = false;
    header("Location: /boutique");
}