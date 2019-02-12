<?php
require_once("../../commun/vue/entete-fragment.php");
// require_once("./utilisateur/vue/sidebar-utilisateur-fragment.php");
require_once("../../commun/vue/pied-de-page-fragment.php");
require_once("erreur-inscription.php");


$page = (object)
    [
    "titre" => "Page index",
    "titrePrincipal" => "Le titre principal H1",
    "itemMenuActif" => "accueil",
    "isConnected" => true,
    "user" => "Pierre"
    ];



    function afficherPage($page = null){

        // En cas d'erreur avec le paramètre $page, un objet $page vide est créé.
        if(!is_object($page)) $page = (object)[];
          afficherEntete($page);
          include('../../../achete_ta_baguette_fr_commun/modele/client.class.php');
          if(isset($_POST['submit'])){
            $client = new Client($_POST['nom'], $_POST['prenom'], $_POST['adresse'], $_POST['mail'], $_POST['date'], $_POST['motDePasse1'], $_POST['motDePasse2']);
            if(!$client->validerClient($client)) afficherErreurInscription();
            else $client->envoyerClientVersBDD($client);
          }
          ?>

<!--  jQuery -->
<div class="content">
    <div class="row justify-content-md-center">
        <div class="col-md-8">
            <form action="" method="post">
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

      <?php
      afficherPiedDePage($page);

}

afficherPage($page);
