<?php
/**
 * Created by PhpStorm.
 * User: AlexandreCM
 * Date: 2019-04-07
 * Time: 17:42
 */
require_once("../../commun/vue/entete-fragment.php");
require_once("../../commun/vue/pied-de-page-fragment.php");
require_once("../../commun/vue/sidebar-client-fragment.php");
require_once (CHEMIN_RACINE_UTILISATEUR . "/action/action-facture.php");

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
                <div class="col-md-11">
                    <h1><?= $page->titre ?></h1>
                </div>
            </div>
            <div class="row">
                <div class="col-md-9">
                    <table class="table">
                        <tr>
                            <th>#</th>
                            <th>Date</th>
                            <th>Prix HT</th>
                            <th>Prix TTC</th>
                        </tr>
<?php foreach ($listefacture as $facture) { ?>
                        <tr>
                            <td>
                                <form method="post">
                                    <input type="submit" name="detail-facture" value="Détail" />
                                    <input type="hidden" name="<?= Facture::ID_FACTURE ?>" value="<?= $facture->getIdFacture() ?>">
                                    <input type="hidden" name="<?= Facture::EMAIL_CLIENT ?>" value="<?= $facture->getEmailClient() ?>">
                                </form >
                            </td>
                            <td><?= $facture->getDateAchat() ?></td>
                            <td><?= $facture->getPrixHT() ?>$</td>
                            <td><?= $facture->getPrixTTC() ?>$</td>
                        </tr>
<?php } ?>
                    </table>
                </div>
            </div>
        </><!-- Fin du contenu -->

    </div><!-- Fin centre de page -->

<?php afficherPiedDePage($page); ?>