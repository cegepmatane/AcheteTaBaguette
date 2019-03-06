<?php
require_once("../../commun/vue/entete-fragment.php");
require_once("../../commun/vue/sidebar-utilisateur-fragment.php");
require_once("../../commun/vue/pied-de-page-fragment.php");

$page = (object)
[
    "titre" => "Notre mission",
    "itemMenuActif" => "A propos",
];

function afficherPage($page = null)
{
afficherEntete($page);
?>
<div class="row mb-3">

    <!-- Bar lateral gauche | sidebar utilisateur -->
    <div class="col-md-2">
        <?php afficherSideBarUtilisateur($page); ?>
    </div><!-- Fin bar lateral gauche -->

    <!-- Contenu -->
    <div class="col-md-8">
        <div class="row">
            <div class="col-md-12">
                <h1><?= $page->titre ?></h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <p class="text-justify">
                    Ce projet a été créé dans le cadre du cours de Projet Web par Sébastien Bois au Cégep de Matane. Le but du
                    projet est de créer un site web de commerce en ligne intégrant une option de paiement Paypal. Pour mettre en
                    oeuvre ce projet, nous avons choisi le thème des baguettes.
                    Nous devons gérer le projet de la création des différentes pages à l’intégration serveur en passant par
                    l’utilisation du Modèle-Vue-Contrôleur et par le référencement du site sur les moteurs de recherche.
                    L’équipe est constituée d’Alexandre Catherine-Mezeray, Maxime Yonnet, Antonin Seiler, Téo Bryer et Arthur
                    Chéramy.
                </p>
            </div>
        </div>
    </div><!-- Fin du contenu -->

</div><!-- Fin centre de page -->
    <?php afficherPiedDePage($page); ?>

    <?php
}

afficherPage($page);
