<?php
/**
 * Created by PhpStorm.
 * User: yonne et Alexandre
 * Date: 18/02/2019
 * Time: 16:52
 */

$page = (object)
[
    "titre" => "Connexion",
    "messageAction" => "",

    "client" => null,
    "idClient" => null,
    "isConnected" => false,
    "admin" => false,

    "email" => Client::EMAIL,
    "descriptionEmail" => Client::getInformation(Client::EMAIL)->description,
    "etiquetteEmail" => Client::getInformation(Client::EMAIL)->etiquette,
    "indiceEmail" => Client::getInformation(Client::EMAIL)->indice,
    "isEmailObligatoire" => Client::getInformation(Client::EMAIL)->obligatoire,

    "motDePasse" => Client::MOT_DE_PASSE,
    "descriptionMotDePasse" => Client::getInformation(Client::MOT_DE_PASSE)->description,
    "etiquetteMotDePasse" => Client::getInformation(Client::MOT_DE_PASSE)->etiquette ?? "Mot de passe",
    "indiceMotDePasse" => Client::getInformation(Client::MOT_DE_PASSE)->indice,
    "isMotDePasseObligatoire" => Client::getInformation(Client::MOT_DE_PASSE)->obligatoire ?? "Obligatoire",
];

//Redirection vers la page de retour avec un message de réussite.
/*if($page->isNavigationRetour ?? false && $page->navigationRetourURL ?? false){

    $location = $page->navigationRetourURL;
    header("Location: " . $location);
    exit;
}*/

if($_GET["navigation-retour-url"] ?? false && $_GET["navigation-retour-titre"] ?? false){

    $page->navigationRetourURL = $_GET["navigation-retour-url"];
    $page->navigationRetourTitre = $_GET["navigation-retour-titre"];

}else if($_POST["navigation-retour-url"] ?? false && $_POST["navigation-retour-titre"] ?? false){

    $page->navigationRetourURL = $_POST["navigation-retour-url"];
    $page->navigationRetourTitre = $_POST["navigation-retour-titre"];
}

if(!$page->isNavigationRetour){

    if(isset($_POST["action-connecter-client"])){

        $accesseurClient = new AccesseurClient();
        $client = $accesseurClient->recupererClientParEmail($_POST[Client::EMAIL]);

        if ($client && $client->getMotDePasse() == sha1($_POST[Client::MOT_DE_PASSE])) {
            $_SESSION[Client::EMAIL] = $client->getEmail();
            if ($client->getAdministrateur()) $_SESSION[Client::ADMINISTRATEUR] = true;

            header("Location: /");
            exit;

        } else {
            $page->messageAction = "Echec autentification";
        }

    }

}