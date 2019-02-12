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

              <?php
              include("../../commun/vue/header.html");
              ?>

            </div>
        </div><!-- Fin en-tete de page -->

<!--  jQuery -->
<div class="content">
    <div class="row justify-content-md-center">
        <div class="col-md-8">
            <form action="Inscription.php" method="post">
                <fieldset>
                <legend>Inscription</legend>
                <div class="form-group">
                    <label class="col-form-label" for="nom">Nom</label>
                    <input type="text" class="form-control" id="nom" name="nom" required>
                </div>
                <div class="form-group">
                  <label class="col-form-label" for="prenom">Prénom  </label>
                    <input type="text" class="form-control" id="Prenom" name="prenom"required>
                </div>
                <div class="form-group">
                  <label class="col-form-label" for="prenom">Adresse  </label>
                    <input type="text" class="form-control" id="adresse" name="adresse"required>
                </div>
                <div class="form-group">
                    <label class="col-form-label" for="date">Date de Naissance </label>
                      <input type="date" class="form-control" placeholder="DD/MM/YYY" name="date" required/>
                </div>
                <div class="form-group">
                    <label for="mail">Mail</label>
                    <input type="email" class="form-control" id="mail" aria-describedby="emailHelp" name="mail" required>
                </div>
                <div class="form-group">
                    <label for="motDePasse1">Mot de passe</label>
                    <input type="password" class="form-control" id="motDePasse1" name="motDePasse1" required>
                </div>
                <div class="form-group">
                    <label for="motDePasse2">Confirmer mot de passe</label>
                    <input type="password" class="form-control" id="motDePasse2" name="motDePasse2" required>
                </div>
                <div class="row justify-content-md-center">
                  <label class="form-check-label" for="defaultCheck1">
                    J'ai lu, compris et accepté les termes d'utilisation
                  </label>
                    <input type="checkbox" name="condition" value="agreed" required>
                </div>
                    <div class="row justify-content-md-center">
                      <button type="submit" class="btn btn-primary" name="submit">Envoyer </button>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>

</div>

<div class="row mt-4">
    <div class="col-md-12 bg-primary">
      <?php
      include('../../commun/vue/footer.html');
      include('../../../achete_ta_baguette_fr_commun/modele/client.class.php');
      if(isset($_POST['submit'])){
        $client = new Client($_POST['nom'], $_POST['prenom'], $_POST['adresse'], $_POST['mail'], $_POST['date'], $_POST['motDePasse1'], $_POST['motDePasse2']);
      }

      ?>
    </div><!-- Fin container -->
  </body>
</html>
