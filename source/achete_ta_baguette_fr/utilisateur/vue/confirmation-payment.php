<?php
/**
 * Created by PhpStorm.
 * User: AlexandreCM
 * Date: 2019-03-17
 * Time: 20:24
 */

require_once("../../commun/vue/entete-fragment.php");
require_once("../../commun/vue/pied-de-page-fragment.php");
require_once("../../commun/vue/sidebar-client-fragment.php");
require_once (CHEMIN_RACINE_UTILISATEUR . "/action/action-confirmation-payment.php");

afficherEntete($page); ?>

    <!-- Centre de page -->
    <div class="row mb-3">

        <!-- Bar lateral gauche | sidebar utilisateur -->
        <div class="col-md-2">
            <?php afficherSideBarUtilisateur($page); ?>
        </div><!-- Fin bar lateral gauche -->

        <!-- Contenu -->
        <div class="col-md-10">
            <h1><?= $page->message ?></h1>
            <a href="/" class="btn btn-primary">Retour à la boutique</a>
        </div><!-- Fin du contenu -->

    </div><!-- Fin centre de page -->

<?php afficherPiedDePage($page); ?>