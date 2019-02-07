<?php
include("header.html");
?>
<!--  jQuery -->
<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>

<!-- Bootstrap Date-Picker Plugin -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>

<div class="content">
    <div class="row justify-content-md-center">
        <div class="col-md-8">
            <form action="../controleur/inscription.php" method="post">
                <fieldset>
                <legend>Inscription</legend>
                <div class="form-group">
                    <label class="col-form-label" for="nom">Nom</label>
                    <input type="text" class="form-control" id="nom" required>
                </div>
                <div class="form-group">
                  <label class="col-form-label" for="prenom">Prénom  </label>
                    <input type="text" class="form-control" id="Prenom" required>
                </div>
                <div class="form-group">
                    <label class="col-form-label" for="date">Date de Naissance </label>
                      <input type='text' class="form-control" placeholder="DD/MM/YYY" required/>
                </div>
                <div class="form-group">
                    <label for="mail">Mail</label>
                    <input type="email" class="form-control" id="mail" aria-describedby="emailHelp" required>
                </div>
                <div class="form-group">
                    <label for="motDePasse1">Mot de passe</label>
                    <input type="password" class="form-control" id="motDePasse1" required>
                </div>
                <div class="form-group">
                    <label for="motDePasse2">Confirmer mot de passe</label>
                    <input type="password" class="form-control" id="motDePasse2" required>
                </div>
                <div class="row justify-content-md-center">
                  <label class="form-check-label" for="defaultCheck1">
                    J'ai lu, compris et accepté les termes d'utilisation
                  </label>
                    <input type="checkbox" name="condition" value="agreed" required>
                </div>
                    <div class="row justify-content-md-center">
                      <button type="submit" class="btn btn-primary">Envoyer </button>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>

</div>
