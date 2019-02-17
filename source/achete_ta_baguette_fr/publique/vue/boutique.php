<?php
require_once("../../commun/vue/entete-fragment.php");
require_once("../../commun/vue/sidebar-utilisateur-fragment.php");
require_once("../../commun/vue/pied-de-page-fragment.php");
require_once("erreur-inscription.php");
require_once(CHEMIN_RACINE_COMMUN . "/accesseur/AccesseurProduit.php");



$page = (object)
[
    "titre" => "Notre mission",
    "titrePrincipal" => "Le titre principal H1",
    "itemMenuActif" => "A propos",
    "isConnected" => isset($_SESSION['connection']),
    "idClient" => $_SESSION['id'] = null
];


function afficherPage($page = null)
{
    afficherEntete($page);
    ?>
    <div class="row mb-3">

        <!-- Bar lateral gauche | sidebar utilisateur -->
        <div class="col-md-2 border ">
            <?php afficherSideBarUtilisateur($page); ?>
        </div><!-- Fin bar lateral gauche -->

        <!-- Contenu -->
        <div class="col-md-8">

           <?php afficherProduit(); ?>


        </div><!-- Fin du contenu -->

    </div><!-- Fin centre de page -->
    <?php afficherPiedDePage($page); ?>

    <?php
}

function afficherProduit(){

    $BDD = new AccesseurProduit();
    if(!isset($_GET['type'])){
        $type = false;
    }else if($_GET['type'] == 'baguette'){
        $type = 1;
    }else if($_GET['type'] == 'viennoiserie'){
        $type = 2;
    }else{
        $type = false;
    }

    if($type != false){
    $produitListe = $BDD->recupererProduitParType($type);

    echo '<div class="row justify-content-md-center">';
    foreach ($produitListe as $produit ) {
        ?>
        <div class="col-md-2 m-2 border">
            <?php
            echo '<a href="./produit.php?id='.$produit->idProduit.'">';
            ?>
                <div class="row">
                    <div class="col-md-12">
                        <img
                                <?php
                                echo 'src='.$produit->srcImage;
                                ?>
                                alt="produit"
                                class="img-fluid imageProduit"
                        />
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <span class="nomProduit"><strong><?php print_r($produit->nom) ?></strong></span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 text-right">
                        <span class="unitePrixProduit">CDN$</span>
                        <span class="prixProduit label-primary"><?php print_r($produit->prix) ?></span>
                    </div>
                </div>
            </a>
        </div>
        <?php
    }
    echo '</div>';
    }
}

afficherPage($page);
