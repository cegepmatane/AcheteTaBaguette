<?php
require_once CHEMIN_RACINE_COMMUN . "/accesseur/AccesseurProduit.php";
require_once CHEMIN_RACINE_COMMUN . "/modele/Redirection.php";


$page = (object)
[
    "titre" => "Page index",
    "titrePrincipal" => "Le titre principal H1",
    "itemMenuActif" => "baguette",
    "isConnected" => true,
    "addProduit" => false,
    "nom" => "Affin",
    "prenom" => "Jean-Yves",
    "courriel" => "jean-yves@affin.net",
    "rue" => "616 Av. St-Redempteur",
    "ville" => "Matane",
    "province" => "Québec",
    "codePostal" => "G4W 0H2",
    "pays" => "Canada",
    "id_personne" => 1,
    "listeProduits" => null,
];


$laBDD = new AccesseurProduit();
$laBDD2 = new AccesseurCategorie();


function supprimerProduit($produit)
{
    echo 'test';
    $laBDD->supprimerProduit($produit);

}

function recupererLabelCategorieParProduit($page, $produit)
{

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
    $laBDD->ajouterProduit($produit);
    $page->addProduit = true;
    $errors = array();
    
}
if (isset($_POST['action-supprimer-produit'])) {
    $produit = new Produit((object)$_POST);
    $laBDD->supprimerProduit($produit);
}
$page->listeProduits = $laBDD->recupererListeProduits();
$page->listeCategorie = $laBDD2->recupererListeCategorie();
?>