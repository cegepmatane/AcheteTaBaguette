<?php

require_once "entete-fragment.php";
require_once "sidebar-utilisateur-fragment.php";
require_once "pied-de-page-fragment.php";
require_once "../../publique/vue/boutique-fragment.php";
//require_once(CHEMIN_RACINE_COMMUN . "/modele/Client.class.php");

/*
Un tableau associatif en clé valeur permet de définir les éléments dynamiques
de la page qui ne sont pas en lien avec les données du modèle. En le changeant
de type en (object), il est plus facilement utilisable par l'IDE et permet les
suggestions automatiques des attributs de l'objet.
 */

$page = (object)
    [
    "titre" => "Page index",
    "titrePrincipal" => "Le titre principal H1",
    "itemMenuActif" => $_GET['type'],
    "isConnected" => $_SESSION["isConnected"],
    "idClient" => $_SESSION["id"],
    "client" => null,

    /*"id_personne" => Client::ID_CLIENT,
"nom" => Client::NOM,
"prenom" => Client::PRENOM,
"email" => Client::EMAIL,
"province" => Client::PROVINCE,
"region" => Client::REGION,
"ville" => Client::VILLE,
"rue" => Client::RUE,
"codePostal" => Client::CODE_POSTAL*/

];

/*
La fonction afficherPage produit le code HTML de la page d'accueil.
Le paramètre $page permet aux fragments de page inclus d'utiliser les
éléments dynamiques propres à la page d'accueil.
 */

function afficherPage($page = null)
{

    // En cas d'erreur avec le paramètre $page, un objet $page vide est créé.
    if (!is_object($page)) {
        $page = (object) [];
    }

    afficherEntete($page);?>

        <!-- Centre de page -->
        <div class="row mb-3">

            <!-- Bar lateral gauche | sidebar utilisateur -->
            <div class="col-md-2 border ">
                <?php afficherSideBarUtilisateur($page);?>
            </div><!-- Fin bar lateral gauche -->

            <!-- Contenu -->
            <div class="col-md-8">
                <?php afficherContenu($page);?>
            </div><!-- Fin du contenu -->

            <!-- Bar lateral droite -->
            <div class="col-md-2 border ">
                <?php //afficherACoteDroite($page); ?>
            </div><!-- Fin bar lateral droite -->

        </div><!-- Fin centre de page -->

        <?php afficherPiedDePage($page);?>

<?php
}

afficherPage($page);

// EOF