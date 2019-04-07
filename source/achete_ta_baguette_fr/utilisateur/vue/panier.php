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

require_once(CHEMIN_RACINE_UTILISATEUR . "/action/action-panier.php");

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

        <?php include("panier-".$page->pleinOuVide.".php"); ?>

    </div><!-- Fin du contenu -->

</div><!-- Fin centre de page -->

<?php afficherPiedDePage($page); ?>