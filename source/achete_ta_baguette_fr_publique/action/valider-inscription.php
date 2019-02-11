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
    "user" => "Pierre"

    ];


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


                <!-- Contenu -->
                <div class="col-md-8">

                    <?php
                    include("boutique.html");
                    ?>

                <!-- Bar lateral droite -->
                <div class="col-md-2 border ">

                    <!-- include sidebar_right -->
                    <div class="sidebarRight">

                    </div>

                </div><!-- Fin bar lateral droite -->

            </div><!-- Fin centre de page -->

            <!-- Pied de page -->
            <div class="row mt-4">
                <div class="col-md-12 bg-primary">

                    <!-- include footer -->
                    <?php
                    include("footer.html");
                    ?>
        </div><!-- Fin container -->
      </body>
    </html>
    <?php

    }

    afficherPage($page);


 function display()
{
    echo "hello ".$_POST["nom"];
}
if(isset($_POST['submit']))
{
  if($_POST['password'] == $_POST['passwordCheck'])display();
  else echo "Erreur mot de passe differents";
  $date = date_parse($_POST['date']);
  if(checkdate($date['day'],$date['month'],$date['year']))
  display();
  else echo "date non valide";
}

?>
