<?php
require_once($_SERVER['CONFIGURATION_COMMUN']);
require_once CHEMIN_RACINE_COMMUN . "/modele/Client.php";
session_start();
function afficherEntete($page = null)
{
    if (!is_object($page)) {
        return;
    }

    ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <!-- Global Site Tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-135374910-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-135374910-1');
</script>

    <meta charset="utf-8">
    <title> <?=$page->titre ?? "";?> </title>

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
                <header>
                    <!-- Banderole du site avec logo, titre, slogan -->
                    <div class="row align-items-center">

                        <!-- logo -->
                        <div class="col-md-2">

                        </div>

                        <!-- Titre et slogan-->
                        <div class="col-md-8 text-center">
                            <div class="row">
                                <div class="col-md-12">
                                    <h1> <img
                                alt="Achete ta baguette"
                                src="/commun/illustration/acheteBaguette.png"
                                class="img-fluid"
                                href="https://www.w3schools.com/html/"
                                /></h1>
                                </div>
                            </div>

                        </div>
                    </div>

                    <!-- menu -->
                    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
                        <a class="navbar-brand" href="/">Accueil</a>

                        <div class="collapse navbar-collapse" id="navbarColor01">
                            <ul class="navbar-nav mr-auto">
                                <li class="nav-item">
                                    <a class="nav-link" href="/boutique/baguette">Baguette</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="/boutique/viennoiserie">Viennoiseries</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="/boutique/autre">Autres</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="/a-propos">À propos</a>
                                </li>
                                <?php
                                if (isset($_SESSION[Client::ADMINISTRATEUR])){
                                    ?>
                                <li class="nav-item">
                                    <a class="nav-link" href="/administration">Adminisatration</a>
                                </li>
                                    <?php
                                }
                                ?>
                            </ul>
                            <form class="form-inline my-2 my-lg-0">
                                <input class="form-control mr-sm-2" type="text" placeholder="Search">
                                <button class="btn btn-secondary my-2 my-sm-0" type="submit">Search</button>
                            </form>
                        </div>
                    </nav>

                    <!-- Fil d'Ariane -->
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active">Accueil</li>
                    </ol>
                </header>

            </div>
        </div><!-- Fin en-tete de page -->

<?php
}