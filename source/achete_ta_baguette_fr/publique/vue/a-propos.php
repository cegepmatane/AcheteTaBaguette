<?php
require_once("../../commun/vue/entete-fragment.php");
require_once("../../commun/vue/sidebar-utilisateur-fragment.php");
require_once("../../commun/vue/pied-de-page-fragment.php");
require_once("erreur-inscription.php");


$page = (object)
[
    "titre" => "Notre mission",
    "titrePrincipal" => "Le titre principal H1",
    "itemMenuActif" => "A propos",
    "isConnected" => isset($_SESSION['connection']),
    "id" => $_SESSION['id']
];


function afficherPage($page = null)
{
afficherEntete($page);
?>
<div class="row mb-3">

    <!-- Bar lateral gauche | sidebar utilisateur -->
    <div class="col-md-2 border ">
        <?php afficherSideBarUtilisateur($page); ?>
    </div><!-- Fin bar lateral gauche -->

    <!-- Contenu -->
    <div class="col-md-8">
        <table style="height: 100px; margin-top: 150px;">
        <span style="margin-top: 200px;">
            <h1> Notre Mission </h1>
        </span>
            <spanstyle
            ="margin-top: 150px;">
            Ce projet a été créé dans le cadre du cours de Projet Web par Sébastien Bois au Cégep de Matane. Le but du
            projet est de créer un site web de commerce en ligne intégrant une option de paiement Paypal. Pour mettre en
            oeuvre ce projet, nous avons choisi le thème des baguettes.
            Nous devons gérer le projet de la création des différentes pages à l’intégration serveur en passant par
            l’utilisation du Modèle-Vue-Contrôleur et par le référencement du site sur les moteurs de recherche.
            L’équipe est constituée d’Alexandre Catherine-Mezeray, Maxime Yonnet, Antonin Seiler, Téo Bryer et Arthur
            Chéramy.
            </span>
        </table>
    </div><!-- Fin du contenu -->

    <!-- Bar lateral droite -->
    <!-- Fin bar lateral droite -->

</div><!-- Fin centre de page -->
    <?php afficherPiedDePage($page); ?>

    <?php
}

afficherPage($page);
