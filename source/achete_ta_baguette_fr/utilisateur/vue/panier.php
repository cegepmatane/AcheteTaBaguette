<?php
/**
 * Created by PhpStorm.
 * User: AlexandreCM
 * Date: 2019-03-06
 * Time: 16:44
 */

require_once("../../commun/vue/entete-fragment.php");
require_once("../../commun/vue/pied-de-page-fragment.php");
require_once("../../commun/vue/sidebar-client-fragment.php");

require_once(CHEMIN_RACINE_UTILISATEUR . "/action/action-pannier.php");

if(!is_object($page)) $page = (object)[];

afficherEntete($page); ?>

<!-- Centre de page -->
<div class="row mb-3">

    <!-- Bar lateral gauche | sidebar utilisateur -->
    <div class="col-md-2">
        <?php afficherSideBarUtilisateur($page); ?>
    </div><!-- Fin bar lateral gauche -->

    <!-- Contenu -->
    <div class="col-md-10">

        <div class="row mb-3">
            <div class="col-md-12">
                <h1><?= $page->titre ?></h1>
            </div>
        </div>

        <div class="row">
            <div class="col-md-9">
                <table class="table">
                    <tr>
                        <th>#</th>
                        <th>Produit</th>
                        <th>Prix unitaire</th>
                        <th>Prix total</th>
                    </tr>

                    <?php foreach($page->listeProduit as $produit) { ?>
                        <tr>
                            <td>
                                <form method="post">
                                    <input type="submit" name="supprimer-produit-panier" value="Supprimer" />
                                    <input type="hidden" name="<?= Panier::ID_PRODUIT ?>" value="<?= $produit->idProduit ?>">
                                    <input type="hidden" name="<?= Panier::EMAIL_CLIENT ?>" value="<?= $_SESSION[Client::EMAIL] ?>">
                                </form >
                            </td>
                            <td><p><span class="font-weight-bold"><?= $produit->nombre ?></span> x <?= $produit->nom ?></p></td>
                            <td><p><?= $produit->prix ?> CND$</p></td>
                            <td><p><?= $produit->totalUnitaire ?> CND$</p></td>
                        </tr>
                    <?php } ?>

                </table>
            </div>
            <div class="col-md-3 text-center">
                <div class="row mb-3">
                    <div class="col-md-12">
                        <p class="font-weight-bold">Prix Total HT : <?= $page->totalHT ?></p>
                        <p class="font-weight-bold">Prix Total TTC : <?= $page->totalTTC ?></p>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-12">
                        <a href="#" class="btn btn-danger">Commander</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
<!--                        <a href="#" class="btn btn-primary">Vider le panier</a>-->
                    </div>
                </div>
            </div>

        </div>

    </div><!-- Fin du contenu -->

</div><!-- Fin centre de page -->

<?php afficherPiedDePage($page); ?>

// EOF