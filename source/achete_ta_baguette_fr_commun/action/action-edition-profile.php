<?php

require_once(CHEMIN_RACINE_COMMUN . "/configuration/configuration.php");
require_once(CHEMIN_RACINE_COMMUN . "/modele/Client.php");
require_once(CHEMIN_RACINE_COMMUN . "/accesseur/AccesseurClient.php");

$accesseurClient = new AccesseurClient();
$page->client = $accesseurClient->recupererClientParEmail($_SESSION[Client::EMAIL]);
if (isset($_POST['edition-profile'])) {
    $client = new Client((object) $_POST);
    if ($page->client->motDePasse == sha1($_POST[Client::MOT_DE_PASSE])) {
        $laBDD = new AccesseurClient();
        $laBDD->miseAJourClient($client);
        header("Location: /");
    } else afficherErreurInscription();

}

?>