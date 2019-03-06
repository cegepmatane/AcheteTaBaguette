<?php
require_once("entete-fragment.php");
require_once("sidebar-utilisateur-fragment.php");
require_once("pied-de-page-fragment.php");

$page = (object)
[
    "titre" => "Page index",
    "titrePrincipal" => "Le titre principal H1",
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
            <div class="col-md-8">
                <?php //afficherContenu($page); ?>
            </div><!-- Fin du contenu -->
            
        </div><!-- Fin centre de page -->

        <?php afficherPiedDePage($page); ?>

<?php
}

afficherPage($page);

// EOF