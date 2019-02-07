<!doctype html>
<html lang="fr">
  <head>
    <title>Page Type</title>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://bootswatch.com/4/simplex/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>

  </head>
  <body>

    <div class="container-fluid">

        <!-- En-tete de page -->
        <div class="row">
            <div class="col-md-12">

                <!-- inclue header -->
                <?php
                include("header.html");
                ?>



            </div>
        </div><!-- Fin en-tete de page -->

        <!-- Centre de page -->
        <div class="row mb-3">

            <!-- Bar lateral gauche | sidebar utilisateur -->
            <div class="col-md-2 border ">

                <!-- include sidebar_left -->

                <?php
                include("sidebar-utilisateur.html");
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
