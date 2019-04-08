<?php

require_once CHEMIN_RACINE_COMMUN . "/accesseur/AccesseurProduit.php";
require_once CHEMIN_RACINE_COMMUN . "/modele/Redirection.php";

if(!isset($_SESSION[Client::ADMINISTRATEUR]) && !$_SESSION[Client::ADMINISTRATEUR]) header('Location: /');

$page = (object)
[
    "titre" => "Administration",
    "addProduit" => false,
    "listeProduits" => null,
    "listeCategorie" => null,
];

$accesseurProduit = new AccesseurProduit();
$accesseurCategorie = new AccesseurCategorie();

function recupererLabelCategorieParProduit($page, $produit){
    foreach ($page->listeCategorie as $categorie) {
        if ($categorie->getIdCategorie() == $produit->getIdCategorie()) return $categorie->getLabel();

    }
}

$laRedirection = new Redirection("/administration/vue/index.php");

if (isset($_POST['action-ajouter-produit'])) {
    $file_name = $_FILES['image']['name'];
    $file_name =  time() . $file_name;
    $file_size = $_FILES['image']['size'];
    $file_tmp = $_FILES['image']['tmp_name'];
    $file_type = $_FILES['image']['type'];
    $file_ext = strtolower(end(explode('.', $_FILES['image']['name'])));
    $extensions = array("jpeg", "jpg", "png", "PNG");
    if (in_array($file_ext, $extensions) === false) {
        $errors[] = "extension not allowed, please choose a JPEG or PNG file.";
    }
    if (empty($errors) == true) {
        move_uploaded_file($file_tmp,  "../../publique/illustration/" . $file_name);
    } else {
        print_r($errors);
    }

    
    $produit = new Produit((object) $_POST);
    $produit->setSrcImage($file_name);
    $accesseurProduit->ajouterProduit($produit);
    $page->addProduit = true;
    $errors = array();
    
}

if (isset($_POST['action-supprimer-produit'])) $accesseurProduit->supprimerProduit(new Produit((object)$_POST));

$page->listeProduits = $accesseurProduit->recupererListeProduits();
$page->listeCategorie = $accesseurCategorie->recupererListeCategorie();