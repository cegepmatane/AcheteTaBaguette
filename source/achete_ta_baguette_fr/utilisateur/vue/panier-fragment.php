<?php
/**
 * Created by PhpStorm.
 * User: AlexandreCM
 * Date: 2019-03-06
 * Time: 16:44
 */

function afficherPanier($page = null){
    $page->titre = "Panier";
?>

    <div class="row mb-3">
        <div class="col-md-12">
            <h1><?= $page->titre ?></h1>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <table class="table">
                <tr>
                    <th>#</th>
                    <th>Produit</th>
                    <th>Prix unitaire</th>
                    <th>Prix total</th>
                </tr>

                <?php for ($i = 0; $i < 2; $i++) { ?>
                <tr>
                    <td></td>
                    <td><p><span class="font-weight-bold"><?= $nb=2 ?></span> x unProduit</p></td>
                    <td><p><?= $prix=2 ?> CND$</p></td>
                    <td><p><?= $prix*$nb ?> CND$</p></td>
                </tr>
                <?php } ?>

            </table>
        </div>

    </div>

<?php
}