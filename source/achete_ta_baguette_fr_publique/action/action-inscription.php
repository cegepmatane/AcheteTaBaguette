<?php
require_once(CHEMIN_RACINE_COMMUN . "/modele/Client.php");

//if($page->client == null) $page->client = new Client();
if(isset($_POST['action-aller-seconde-etape'])&& $page->isEtapeDeux == false && $page->isEtapeUn == true){
    print_r($_POST);
    print_r($page->client->setNom($_POST[CLIENT::NOM]). " 1 " . $page->client->setPrenom($_POST[CLIENT::PRENOM]). " 1 " . $page->client->setRue($_POST[CLIENT::RUE]). " 1 ". $page->client->setVille($_POST[CLIENT::VILLE]). " 1 ". $page->client->setCodePostal($_POST[CLIENT::CODE_POSTAL]). " 1 ". $page->client->setProvince($_POST[CLIENT::PROVINCE]). " 1 ". $page->client->setPays($_POST[CLIENT::PAYS]));
    $page->client = new Client((object) $_POST);
    if($page->client->setNom($_POST[CLIENT::NOM]) && $page->client->setPrenom($_POST[CLIENT::PRENOM]) && $page->client->setRue($_POST[CLIENT::RUE])&& $page->client->setVille($_POST[CLIENT::VILLE])&& $page->client->setCodePostal($_POST[CLIENT::CODE_POSTAL])&& $page->client->setProvince($_POST[CLIENT::PROVINCE])&& $page->client->setPays($_POST[CLIENT::PAYS])){
        echo "gooo";
        $page->isEtapeDeux = true;
        $page->isEtapeUn = false;
        $page->titre = "Etape 2";
    }else{
        $page->isEtapeUn = true;
        $page->isEtapeDeux = false;
        $page->erreur = "Erreur à la première étape";
        $page->titre = "Etape 1";
        $page->client = new Client((Object) $_POST);
    }

}else if(isset($_POST['retour-premiere-etape'])) {
     $page->client->setNom($_POST[CLIENT::NOM]);
     $page->client->setPrenom($_POST[CLIENT::PRENOM]);
     $page->client->setRue($_POST[CLIENT::RUE]);
     $page->client->setVille($_POST[CLIENT::VILLE]);
     $page->client->setCodePostal($_POST[CLIENT::CODE_POSTAL]);
     $page->client->setProvince($_POST[CLIENT::PROVINCE]);
     $page->client->setPays($_POST[CLIENT::PAYS]);
     $page->isEtapeUn = true;
     $page->isEtapeDeux = false;
     $page->titre = "Etape 1";

    }else if(isset($_POST['submit'])){
    $page->client->setNom($_POST[CLIENT::NOM]);
    $page->client->setPrenom($_POST[CLIENT::PRENOM]);
    $page->client->setRue($_POST[CLIENT::RUE]);
    $page->client->setVille($_POST[CLIENT::VILLE]);
    $page->client->setCodePostal($_POST[CLIENT::CODE_POSTAL]);
    $page->client->setProvince($_POST[CLIENT::PROVINCE]);
    $page->client->setPays($_POST[CLIENT::PAYS]);
    $page->client->mot_de_passe_verif = $_POST['mot_de_passe_verif'];
    if($page->client->setEmail($_POST[CLIENT::EMAIL]) && $page->client->setMotDePasse($_POST[CLIENT::MOT_DE_PASSE])){
        $laBDD = new AccesseurClient();
        $laBDD->ajouterClient($page->client);
        $_SESSION[Client::EMAIL] = $page->client->getEmail();
        if ($page->client->getAdministrateur()) $_SESSION[Client::ADMINISTRATEUR] = true;

        header("Location: /boutique");
    }else{
        $page->isEtapeUn = false;
        $page->isEtapeDeux = true;
        $page->erreur = "Erreur à la seconde étape";

    }
}
afficherPage($page);