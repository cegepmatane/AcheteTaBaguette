<?php
require_once(CHEMIN_RACINE_COMMUN . "/modele/Client.class.php");

if($page->personne == null) $page->personne = new Client();
if(isset($_POST['action-aller-seconde-etape'])&& $page->isEtapeDeux == false && $page->isEtapeUn == true){
    if($page->personne->setNom($_POST['nom']) && $page->personne->setPrenom($_POST['prenom']) && $page->personne->setRue($_POST['rue'])&& $page->personne->setVille($_POST['ville'])&& $page->personne->setCodePostal($_POST['codePostale'])&& $page->personne->setProvince($_POST['province'])&& $page->personne->setPays($_POST['pays'])){
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
     $page->personne->setNom($_POST['nom']);
     $page->personne->setPrenom($_POST['prenom']);
     $page->personne->setRue($_POST['rue']);
     $page->personne->setVille($_POST['ville']);
     $page->personne->setCodePostal($_POST['codePostale']);
     $page->personne->setProvince($_POST['province']);
     $page->personne->setPays($_POST['pays']);
     $page->isEtapeUn = true;
     $page->isEtapeDeux = false;
     $page->titre = "Etape 1";

    }
if(isset($_POST['submit'])){
    $page->personne->setNom($_POST['nom']);
    $page->personne->setPrenom($_POST['prenom']);
    $page->personne->setRue($_POST['rue']);
    $page->personne->setVille($_POST['ville']);
    $page->personne->setCodePostal($_POST['codePostale']);
    $page->personne->setProvince($_POST['province']);
    $page->personne->setPays($_POST['pays']);
    $page->personne->mot_de_passe_verif = $_POST['mot_de_passe_verif'];
    if($page->personne->setEmail($_POST['mail']) && $page->personne->setMotDePasse($_POST['mot_de_passe'])){
        $laBDD = new AccesseurClient();
        $laBDD->ajouterClient($page->personne);
        $_SESSION['id'] = $laBDD->getClientParEmail($page->personne->email);
        $_SESSION['isConnected'] = true;
        $_SESSION['admin'] = false;
        header("Location: /boutique");
    }
}
afficherPage($page);
