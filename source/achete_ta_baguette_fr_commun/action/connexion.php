<?php
/**
 * Created by PhpStorm.
 * User: yonne
 * Date: 18/02/2019
 * Time: 16:52
 */

$attribut = new stdClass();
$attribut->email = $_POST['mail'];
$attribut->mot_De_Passe = $_POST['mot_de_passe'];
$laBDD = new AccesseurClient();
$resultat = $laBDD->verifierClient($attribut);
if ($resultat != false) {
    session_start();
    //Remplacer idclient par ID ?
    $_SESSION["id"] = $resultat->idClient;
    $_SESSION["connection"] = true;
    $_SESSION['admin'] = $resultat->admin == 1 ? true : false;
    header("Location: /boutique");
} else {
    afficherErreurInscription();
    header("Location: /connexion");

}
