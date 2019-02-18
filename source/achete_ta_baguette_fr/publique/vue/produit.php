<?php
require_once($_SERVER['CONFIGURATION_COMMUN']);
require_once(CHEMIN_RACINE_COMMUN . "/accesseur/AccesseurProduit.php");
require_once("../../commun/vue/entete-fragment.php");
require_once("../../commun/vue/sidebar-utilisateur-fragment.php");
require_once("../../commun/vue/pied-de-page-fragment.php");

function afficherUnProduit($page = null) {
    if (!is_object($page)) $page = (object)[];

    $page = (object)
    [
        "titre" => "produit",
        "titrePrincipal" => "Le titre principal H1",
        "itemMenuActif" => $_GET['type'],
        "isConnected" => $_SESSION["connection"],
        "idClient" => $_SESSION["id"]

    ];

    afficherEntete($page);

    $BDD = new AccesseurProduit();
    $produit = $BDD->recupererProduitParId($_GET['idProduit']);

    ?>

    <!-- Centre de page -->
    <div class="row mb-3">

        <!-- Bar lateral gauche | sidebar utilisateur -->
        <div class="col-md-2 border ">
            <?php afficherSideBarUtilisateur($page); ?>
        </div><!-- Fin bar lateral gauche -->

        <!-- Contenu -->
        <div class="col-md-8">
        
            <!-- Ligne image et produit description -->
            <div class="row">

                <!-- colonne imageProduit -->
                <div class="col-md-6">
                    <img
                            src="<?php echo $produit->srcImage ?>"
                            alt="produit"
                            class="img-fluid imageProduit"
                    />
                </div>

                <!-- colonne information produit -->
                <div class="col-md-6">

                    <!-- Ligne Titre produit -->
                    <div class="row">
                        <div class="col-md-12">
                            <h1 class="nomProduit"><?php echo $produit->nom ?></h1>
                        </div>
                    </div>

                    <!-- Prix du produit -->
                    <div class="row">
                        <div class="col-md-12">
                            <h2 class="product-price">
                                <span class="unitePrixProduit">CDN$</span>
                                <span class="prixProduit label-primary"><?php echo $produit->prix ?></span>
                            </h2>
                            <hr>
                        </div>
                    </div>

                    <!-- Ajout au panier -->
                    <div class="row align-items-center add-to-cart">

                        <!-- choix quantite et stock -->
                        <div class="col-md-5 product-qty quantite">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="input-group">
                                        <button type="button" class="btn btn-outline-secondary btn-number"  data-type="minus" data-field="quant[1]">-</button>
                                        <input type="text" name="quant[1]" class="form-control input-number text-center" value="1" min="1" max="10">
                                        <button type="button" class="btn btn-outline-secondary btn-number" data-type="plus" data-field="quant[1]">+</button>
                                    </div>
                                </div>
                            </div>

                            <!-- stock -->
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <?php if($produit->stock > 0) { ?>
                                        <span class="badge badge-success stockProduit">En stock</span>
                                    <?php } 
                                    else { ?>
                                        <span class="badge badge-danger stockProduit">Pas de stock</span>
                                    <?php } ?>
                                </div>
                            </div><!-- fin stock -->
                        </div><!-- fin choix quantite et stock -->

                        <!-- bouton ajout panier -->
                        <div class="col-md-7">
                            <!-- <a href="#" class="btn btn-lg btn-primary">Ajouter au panier</a> -->
                            <button class="btn btn-lg btn-primary boutonAjouterPanier">Ajouter au panier</button>
                        </div>
                    </div> <!-- fin Ajout au panier -->

                </div><!-- colonne information produit -->

            </div><!-- fin ligne image produit et description -->

            <!-- Ligne produit similaire -->
            <div class="row">
                <div class="col-md-12">

                    <!-- Titre produit similaire -->
                    <div class="row">
                        <div class="col-md-12 mt-5">
                            <h3 class="titreLigneProduitSimilaire">Produit similaire</h3>
                        </div>
                    </div>

                    <!-- liste produit similaire -->
                    <div class="row">

                        <!-- TODO boucle de 6 articles -->
                        <!-- Image et titre d'un produit similaire -->
                        <div class="col-md-2 border">
                            <a href="#">
                                <div class="row">
                                    <div class="col-md-12">
                                        <img
                                                class="img-fluid imageProduit"
                                                src="..\achetetabaguette_fr - publique\illustration\baguette.jpg"
                                                alt="produit"
                                        />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <span class="nomProduit"><strong>Du pain griller au feu de bois</strong></span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 text-right">
                                        <span class="unitePrixProduit">CDN$</span>
                                        <span class="prixProduit label-primary">2.50</span>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <!-- Image et titre d'un produit similaire -->
                        <div class="col-md-2 border">
                            <a href="#">
                                <div class="row">
                                    <div class="col-md-12">
                                        <img
                                                class="img-fluid imageProduit"
                                                src="..\achetetabaguette_fr - publique\illustration\baguette.jpg"
                                                alt="produit"
                                        />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <span class="nomProduit"><strong>Du pain griller au feu de bois</strong></span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 text-right">
                                        <span class="unitePrixProduit">CDN$</span>
                                        <span class="prixProduit label-primary">2.50</span>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <!-- Image et titre d'un produit similaire -->
                        <div class="col-md-2 border">
                            <a href="#">
                                <div class="row">
                                    <div class="col-md-12">
                                        <img
                                                class="img-fluid imageProduit"
                                                src="..\achetetabaguette_fr - publique\illustration\baguette.jpg"
                                                alt="produit"
                                        />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <span class="nomProduit"><strong>Du pain griller au feu de bois</strong></span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 text-right">
                                        <span class="unitePrixProduit">CDN$</span>
                                        <span class="prixProduit label-primary">2.50</span>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <!-- Image et titre d'un produit similaire -->
                        <div class="col-md-2 border">
                            <a href="#">
                                <div class="row">
                                    <div class="col-md-12">
                                        <img
                                                class="img-fluid imageProduit"
                                                src="..\achetetabaguette_fr - publique\illustration\baguette.jpg"
                                                alt="produit"
                                        />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <span class="nomProduit"><strong>Du pain griller au feu de bois</strong></span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 text-right">
                                        <span class="unitePrixProduit">CDN$</span>
                                        <span class="prixProduit label-primary">2.50</span>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <!-- Image et titre d'un produit similaire -->
                        <div class="col-md-2 border">
                            <a href="#">
                                <div class="row">
                                    <div class="col-md-12">
                                        <img
                                                class="img-fluid imageProduit"
                                                src="..\achetetabaguette_fr - publique\illustration\baguette.jpg"
                                                alt="produit"
                                        />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <span class="nomProduit"><strong>Du pain griller au feu de bois</strong></span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 text-right">
                                        <span class="unitePrixProduit">CDN$</span>
                                        <span class="prixProduit label-primary">2.5</span>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <!-- Image et titre d'un produit similaire -->
                        <div class="col-md-2 border">
                            <a href="#">
                                <div class="row">
                                    <div class="col-md-12">
                                        <img
                                                class="img-fluid imageProduit"
                                                src="..\achetetabaguette_fr - publique\illustration\baguette.jpg"
                                                alt="produit"
                                        />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <span class="nomProduit"><strong>Du pain griller au feu de bois</strong></span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 text-right">
                                        <span class="unitePrixProduit">CDN$</span>
                                        <span class="prixProduit label-primary">2.50</span>
                                    </div>
                                </div>
                            </a>
                        </div>


                    </div><!-- Fin liste produit similaire -->

                </div>
            </div><!-- Fin ligne produit similaire -->

        </div><!-- Fin du contenu -->

        <!-- Bar lateral droite -->
        <div class="col-md-2 border ">
            <?php //afficherACoteDroite($page); ?>
        </div><!-- Fin bar lateral droite -->
        
    </div><!-- Fin centre de page -->   

    <?php
    afficherPiedDePage($page);

}

afficherUnProduit($page);

