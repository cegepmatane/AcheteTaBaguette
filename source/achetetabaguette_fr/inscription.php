<?php
include("header.html");
?>
<div class="content">
    <div class="row justify-content-md-center">
        <div class="col-md-8">
            <form action="../controleur/inscription.php" method="post">
                <fieldset>
                <legend>Inscription</legend>
                <div class="form-group">
                    <label class="col-form-label" for="nom">Nom</label>
                    <input type="text" class="form-control" id="nom">
                </div>
                <div class="form-group">
                    <label class="col-form-label" for="prenom">Prénom</label>
                    <input type="text" class="form-control" id="Prenom">
                </div>
                <div class="form-group">
                    <label for="mail">Mail</label>
                    <input type="email" class="form-control" id="mail" aria-describedby="emailHelp">
                </div>
                <div class="form-group">
                    <label for="motDePasse1">Mot de passe</label>
                    <input type="password" class="form-control" id="motDePasse1">
                </div>
                <div class="form-group">
                    <label for="motDePasse2">Confirmer mot de passe</label>
                    <input type="password" class="form-control" id="motDePasse2">
                </div>
                <div class="row justify-content-md-center">
                  <label class="form-check-label" for="defaultCheck1">
                    J'ai lu, compris et accepté les termes d'utilisation
                  </label>
                    <input type="checkbox" name="condition" value="agreed">
                </div>
                    <div class="row justify-content-md-center">
                      <button type="submit" class="btn btn-primary">Envoyer</button>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>

</div>
