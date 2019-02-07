<?php
require_once("sidebar-utilisateur-fragment.php");
require_once("entete-fragment.php");

$page = (object)
    [
    "style" => "acceuil.css",
    "titre" => "Page Type avec fragment",
    "titrePrincipal" => "Le titre principal H1",
    "itemMenuActif" => "accueil",
    "isConnected" => true,
    "user" => "admin"

    ];

    function afficherLigne($ligne){


    }
    function afficherPage($page = null){

    // En cas d'erreur avec le paramètre $page, un objet $page vide est créé.
    if(!is_object($page)) $page = (object)[];
    afficherEntete($page);

    ?>

    <!-- Centre de page -->
    <div class="row mb-3">

        <!-- Bar lateral gauche | sidebar utilisateur -->
        <div class="col-md-2 border ">

            <!-- include sidebar_left -->

            <?php
            afficherSideBarUtilisateur($page);
            ?>
        </div>


        <!-- Début du tableau -->

<div class="container">
  <div class="row">
    <div class="col-sm">
      Image
    </div>
    <div class="col-sm">
      produit français
    </div>
    <div class="col-sm">
      produit anglais
    </div>
    <div class="col-sm">
      Catégorie
    </div>
    <div class="col-sm">
      Prix
    </div>
    <div class="col-sm">
      Nombre de stock
    </div>
    <div class="col-sm">
      Supprimer
    </div>
    <div class="w-100"></div>
   <div class="col">Column</div>
   <div class="col">Column</div>
   <div class="col">Column</div>
   <div class="col">Column</div>
   <div class="col">Column</div>
   <div class="col">Column</div>
   <div class="col">Column</div>
   <div class="w-100"></div>
  <div class="col">Column</div>
  <div class="col">Column</div>
  <div class="col">Column</div>
  <div class="col">Column</div>
  <div class="col">Column</div>
  <div class="col">Column</div>
  <div class="col">Column</div>

  </div>
</div>




        <?php

        }

        afficherPage($page);
