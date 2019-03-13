<?php
/**
 * Created by PhpStorm.
 * User: AlexandreCM
 * Date: 2019-03-06
 * Time: 16:44
 */
require_once(CHEMIN_RACINE_COMMUN . "/modele/Produit.php");
require_once(CHEMIN_RACINE_COMMUN . "/modele/Panier.php");
require_once(CHEMIN_RACINE_COMMUN . "/accesseur/AccesseurProduit.php");
require_once(CHEMIN_RACINE_COMMUN . "/accesseur/AccesseurPanier.php");

function afficherPanier($page = null){
    $page->titre = "Panier";

    $accesseurPanier = new AccesseurPanier();
    $accesseurProduit = new AccesseurProduit();
    $totalPrix = null;

    if(isset($_POST['supprimer-produit-panier']))
    {
        $accesseurPanier->supprimerProduitPanier(new Panier((object) $_POST));
    }

    $listePanier = $accesseurPanier->recupererPanier($_SESSION[Client::EMAIL]);
?>
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

                <?php foreach($listePanier as $panier) {
                    $produit = $accesseurProduit->recupererProduitParId($panier->getIdProduit());
                    $totalPrix += $produit->prix*$panier->getNbProduit(); ?>
                <tr>
                    <td>
                        <form method="post">
                            <input type="submit" name="supprimer-produit-panier" value="Supprimer" />
                            <input type="hidden" name="<?= Panier::ID_PRODUIT ?>" value="<?= $panier->getIdProduit() ?>">
                            <input type="hidden" name="<?= Panier::EMAIL_CLIENT ?>" value="<?= $panier->getEmailClient() ?>">
                        </form >
                    </td>
                    <td><p><span class="font-weight-bold"><?= $panier->getNbProduit() ?></span> x <?= $produit->nom ?></p></td>
                    <td><p><?= $produit->prix ?> CND$</p></td>
                    <td><p><?= $produit->prix*$panier->getNbProduit() ?> CND$</p></td>
                </tr>
                <?php } ?>

            </table>
        </div>
        <div class="col-md-3 text-center">
            <div class="row mb-3">
                <div class="col-md-12">
                    <p class="font-weight-bold">Prix Total HT : <?= $totalPrix ?></p>
                    <p class="font-weight-bold">Prix Total TTC : <?= $ttc = round($totalPrix + $totalPrix*(0.05+0.09975),2) ?></p>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-12">
                    <a href="#" class="btn btn-danger">Commander</a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <a href="#" class="btn btn-primary">Vider le panier</a>
                </div>
            </div>
        </div>

    </div>

<?php
}