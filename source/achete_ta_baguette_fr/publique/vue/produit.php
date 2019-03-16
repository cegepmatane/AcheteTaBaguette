<?php
require_once($_SERVER['CONFIGURATION_COMMUN']);
require_once(CHEMIN_RACINE_COMMUN . "/modele/Client.php");
require_once(CHEMIN_RACINE_COMMUN . "/modele/Produit.php");
require_once(CHEMIN_RACINE_COMMUN . "/accesseur/AccesseurProduit.php");
require_once(CHEMIN_RACINE_COMMUN . "/modele/Panier.php");
require_once(CHEMIN_RACINE_COMMUN . "/accesseur/AccesseurPanier.php");

require_once("../../commun/vue/entete-fragment.php");
require_once("../../commun/vue/sidebar-client-fragment.php");
require_once("../../commun/vue/pied-de-page-fragment.php");
require_once(CHEMIN_RACINE_PUBLIQUE . "/action/action-produit.php");

afficherEntete($page);

?>

<!-- Centre de page -->
<div class="row mb-3">

    <!-- Bar lateral gauche | sidebar utilisateur -->
    <div class="col-md-2">
        <?php afficherSideBarUtilisateur($page); ?>
    </div><!-- Fin bar lateral gauche -->

    <!-- Contenu -->
    <div class="col-md-9">

        <!-- Ligne image et produit description -->
        <div class="row">

            <!-- colonne imageProduit -->
            <div class="col-md-6">
                <img
                src="/publique/illustration/<?php echo $produit->getSrcImage() ?>"
                alt="produit"
                class="img-fluid imageProduit"
                />
            </div>

            <!-- colonne information produit -->
            <div class="col-md-6">

                <!-- Ligne Titre produit -->
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="nomProduit"><?php echo $produit->getNom() ?></h1>
                    </div>
                </div>

                <!-- Prix du produit -->
                <div class="row">
                    <div class="col-md-12">
                        <h2>
                            <span class="unitePrixProduit">CDN$</span>
                            <span class="prixProduit label-primary"><?php echo $produit->getPrix() ?></span>
                        </h2>
                        <hr>
                    </div>
                </div>

                <!-- Ajout au panier -->
                <form method="post">
                    <div class="row">

                        <!-- choix quantite et stock -->
                        <div class="col-md-5 product-qty quantite">
                            <div class="row justify-content-center">
                                <div class="col-md-7 mb-1">
                                    <input class="form-control" type="number" value="<?= $page->nbProduitDefaut ?>" min="1" name="<?= $page->nbProduit ?>">
                                </div>
                            </div>

                            <!-- stock -->
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <?php if($produit->getStock() > 0) { ?>
                                    <span class="badge badge-success stockProduit">En stock</span>
                                        <?php if($produit->getStock() < $page->indicePetitStock) { ?>
                                    <span class="">Il n'en reste plus que <?= $produit->getStock() ?></span>
                                        <?php }
                                    }
                                    else { ?>
                                    <span class="badge badge-danger stockProduit">Pas de stock</span>
                                    <?php } ?>
                                </div>
                            </div><!-- fin stock -->
                        </div><!-- fin choix quantite et stock -->

                        <input type="hidden" name="<?= $page->idProduit ?>" value="<?= $_GET[Panier::ID_PRODUIT] ?>">
                        <input type="hidden" name="<?= $page->emailClient ?>" value="<?= $_SESSION[Client::EMAIL] ?>">

                        <!-- bouton ajout panier -->
                        <div class="col-md-7">
                            <!-- <a href="#" class="btn btn-lg btn-primary">Ajouter au panier</a> -->
                            <button type="submit" name="ajout-au-panier" class="btn btn-lg btn-primary boutonAjouterPanier">Ajouter au panier</button>
                        </div>
                    </div>
                </form>
                <!-- fin Ajout au panier -->
                <div class="row">
                    <div class="col-md-12"><?= $page->messageAction ?></div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <h5><?php echo $produit->getDescription() ?></h5>
                    </div>
                </div>

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

                    <?php foreach ($produitSimilaire as $unProduit) {
                        $unProduit = new Produit($unProduit);
                        ?>

                        <!-- Image et titre d'un produit similaire -->
                        <div class="col-md-2 border">
                            <a href="/boutique/produit/<?= $unProduit->getIdProduit() ?>">
                                <div class="row">
                                    <div class="col-md-12">
                                        <img
                                        class="img-fluid imageProduit"
                                        src="/publique/illustration/<?= $unProduit->getSrcImage() ?>"
                                        alt="produit"
                                        />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <span class="nomProduit"><strong><?= $unProduit->getNom() ?></strong></span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 text-right">
                                        <span class="unitePrixProduit">CDN$</span>
                                        <span class="prixProduit label-primary"><?= $unProduit->getPrix() ?></span>
                                    </div>
                                </div>
                            </a>
                        </div>

                    <?php } ?>

                </div><!-- Fin liste produit similaire -->

            </div>
        </div><!-- Fin ligne produit similaire -->

    </div><!-- Fin du contenu -->

</div><!-- Fin centre de page -->

<?php
afficherPiedDePage($page);
