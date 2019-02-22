<?php
require_once(CHEMIN_RACINE_COMMUN . "/modele/Client.class.php");
$page->personne = new Client();

if(isset($_POST['action-aller-seconde-etape'])){
    if($page->personne->setNom($_POST['nom']) && $page->personne->setPrenom($_POST['prenom']) && $page->personne->setRue($_POST['rue'])&& $page->personne->setVille($_POST['ville'])&& $page->personne->setCodePostal($_POST['codePostale'])&& $page->personne->setProvince($_POST['province'])&& $page->personne->setPays($_POST['pays'])&& $page->personne->setDateDeNaissance($_POST['date'])){
        $page->etape = 2;
    }else{
        $page->etape= 1;
        $page->erreur = "Erreur à la première étape";
    }

}
afficherPage($page);
