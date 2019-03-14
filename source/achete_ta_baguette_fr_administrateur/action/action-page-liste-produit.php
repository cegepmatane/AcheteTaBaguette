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

	// $attribut = (object)
	// [
	// 	"nom" => "",
	// 	"categorie" => "",
	// 	"description" => "",
	// 	"stock" => null,
	// 	"prix" => "12",
	// 	"srcImage" => "test.png", 
	// ];
	// $produit = new Produit($attribut);
	// $produit->setNom($_POST['PRODUIT::NOM']);
	// $produit->setIdCategorie($_POST['PRODUIT::CATEGORIE']);
	// $produit->setDescription($_POST['PRODUIT::DESCRIPTION']);
	// $produit->setStock($_POST[PRODUIT::STOCK]);
	// $produit->setPrix($_POST[PRODUIT::PRIX]);
	$produit = new Produit((object) $_POST);
	$laBDD->ajouterProduit($produit);
	$page->addProduit = true;

	

		/*if($page->addProduit ?? false){
			header("Location: " . "/administration/vue/index.php");
			exit;
			$page->addProduit = false;
		}*/

    $file_name = $_FILES['image']['name'];
    $file_name =  time() . $file_name;
    print_r($file_name);
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
        echo "Success";
    } else {
        print_r($errors);
    }


    $produit = new Produit($attribut);
    $produit->setNom($_POST['produit']);
    $produit->setIdCategorie($_POST['categorie']);
    $produit->setDescription($_POST['description']);
    $produit->setStock($_POST['stock']);
    $produit->setPrix($_POST['prix']);
    $produit->setSrcImage("/publique/illustration/".$file_name);
    $laBDD->ajouterProduit($produit);
    $page->addProduit = true;

    /*if($page->addProduit ?? false){
        header("Location: " . "/administration/vue/index.php");
        exit;
        $page->addProduit = false;
    }*/
}
if (isset($_POST['action-supprimer-produit'])) {

    $produit = new Produit((object)$_POST);
    $laBDD->supprimerProduit($produit);


}
$page->listeProduits = $laBDD->recupererListeProduits();
$page->listeCategorie = $laBDD2->recupererListeCategorie();
?>