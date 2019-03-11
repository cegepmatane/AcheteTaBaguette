<?php
require_once(CHEMIN_RACINE_COMMUN . "/modele/Client.php");

//if($page->client == null) $page->client = new Client();
if(isset($_POST['action-aller-seconde-etape'])&& $page->isEtapeDeux == false && $page->isEtapeUn == true){
    if($page->client->setNom($_POST['nom']) && $page->client->setPrenom($_POST['prenom']) && $page->client->setRue($_POST['rue'])&& $page->client->setVille($_POST['ville'])&& $page->client->setCodePostal($_POST['codePostale'])&& $page->client->setProvince($_POST['province'])&& $page->client->setPays($_POST['pays'])){
        $page->isEtapeDeux = true;
        $page->isEtapeUn = false;
        $page->titre = "Etape 2";
    }else{
        $page->isEtapeUn = true;
        $page->isEtapeDeux = false;
        $page->erreur = "Erreur à la première étape";
        $page->titre = "Etape 1";
    }

}
if(isset($_POST['retour-premiere-etape'])) {
     $page->client->setNom($_POST['nom']);
     $page->client->setPrenom($_POST['prenom']);
     $page->client->setRue($_POST['rue']);
     $page->client->setVille($_POST['ville']);
     $page->client->setCodePostal($_POST['codePostale']);
     $page->client->setProvince($_POST['province']);
     $page->client->setPays($_POST['pays']);
     $page->isEtapeUn = true;
     $page->isEtapeDeux = false;
     $page->titre = "Etape 1";

    }
if(isset($_POST['submit'])){
    $page->client->setNom($_POST['nom']);
    $page->client->setPrenom($_POST['prenom']);
    $page->client->setRue($_POST['rue']);
    $page->client->setVille($_POST['ville']);
    $page->client->setCodePostal($_POST['codePostale']);
    $page->client->setProvince($_POST['province']);
    $page->client->setPays($_POST['pays']);
    $page->client->mot_de_passe_verif = $_POST['mot_de_passe_verif'];
    if($page->client->setEmail($_POST['mail']) && $page->client->setMotDePasse($_POST['mot_de_passe'])){
        $laBDD = new AccesseurClient();
        $laBDD->ajouterClient($page->client);
        $_SESSION[Client::EMAIL] = $page->client->getEmail();
        if ($page->client->getAdministrateur()) $_SESSION[Client::ADMINISTRATEUR] = true;

        header("Location: /boutique");
    }
}
afficherPage($page);