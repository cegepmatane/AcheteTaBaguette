<div class="row">
    <div class="col-md-9">
        <table class="table">
            <tr>
                <th>#</th>
                <th>Produit</th>
                <th>Prix unitaire</th>
                <th>Prix total</th>
            </tr>

            <?php foreach($page->panier->getListeProduit() as $article) {
                $produit = new Produit($article->getProduit()); ?>
                <tr>
                    <td>
                        <form method="post">
                            <input type="submit" name="supprimer-produit-panier" value="Supprimer" />
                            <input type="hidden" name="<?= Article::ID_PRODUIT ?>" value="<?= $produit->getIdProduit() ?>">
                            <input type="hidden" name="<?= Panier::EMAIL_CLIENT ?>" value="<?= $_SESSION[Client::EMAIL] ?>">
                        </form >
                    </td>
                    <td><p><span class="font-weight-bold"><?= $article->getQuantite() ?></span> x <?= $produit->getNom() ?></p></td>
                    <td><p><?= $produit->getPrix() ?> CND$</p></td>
                    <td><p><?= $article->getPrixTotal() ?> CND$</p></td>
                </tr>
            <?php } ?>

        </table>
    </div>
    <div class="col-md-3 text-center">
        <div class="row mb-3">
            <div class="col-md-12">
                <a href="/facture" class="btn btn-primary">Mes factures</a>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-12">
                <p class="font-weight-bold">Prix Total HT : <?= $page->panier->getPrixHT() ?></p>
                <p class="font-weight-bold">Prix Total TTC : <?= $page->panier->getPrixTTC() ?></p>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-12">
                <a href="/payment" class="btn btn-danger">Commander</a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <!--                        <a href="#" class="btn btn-primary">Vider le panier</a>-->
            </div>
        </div>
    </div>

</div>