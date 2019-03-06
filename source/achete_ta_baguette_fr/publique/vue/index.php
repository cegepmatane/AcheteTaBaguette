<?php
require_once("../../commun/vue/entete-fragment.php");
require_once("../../commun/vue/pied-de-page-fragment.php");
require_once("../../commun/vue/sidebar-utilisateur-fragment.php");

$page = (object)
[
    "titre" => "",
    "itemMenuActif" => "accueil",
];

function afficherPage($page = null){

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
                <?php //afficherContenu($page); ?>
            </div><!-- Fin du contenu -->
            
        </div><!-- Fin centre de page -->

        <?php afficherPiedDePage($page); ?>

<?php
}

afficherPage($page);

// EOF