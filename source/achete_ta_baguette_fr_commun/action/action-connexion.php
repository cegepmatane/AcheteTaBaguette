<?php
/**
 * Created by PhpStorm.
 * User: yonne et Alexandre
 * Date: 18/02/2019
 * Time: 16:52
 */
if($_GET["navigation-retour-url"] ?? false && $_GET["navigation-retour-titre"] ?? false){

    $page->navigationRetourURL = $_GET["navigation-retour-url"];
    $page->navigationRetourTitre = $_GET["navigation-retour-titre"];

}else if($_POST["navigation-retour-url"] ?? false && $_POST["navigation-retour-titre"] ?? false){

    $page->navigationRetourURL = $_POST["navigation-retour-url"];
    $page->navigationRetourTitre = $_POST["navigation-retour-titre"];
}

print_r($page->isNavigationRetour);
if(!$page->isNavigationRetour){

    if(isset($_POST["action-connecter-client"])){

        $accesseurClient = new AccesseurClient();
        $resultat = $accesseurClient->recupererClientParEmail($_POST[Client::EMAIL]);

        if ($resultat && $resultat->motDePasse == sha1($_POST['mot_de_passe'])) {
            $_SESSION['id'] = $resultat->idClient;
            $_SESSION['isConnected'] = true;
            $_SESSION['admin'] = false;
            header("Location: /boutique");
        } else {
            $page->messageAction = "Echec autentification";
        }

    }

}
afficherPageConnexion($page);