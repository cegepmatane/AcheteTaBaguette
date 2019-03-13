<?php
function afficherErreurInscription($listeErreur)
{
    ?>
        <div class="alert alert-primary" role="alert">
           Voici la liste d'erreur :

<?php
print_r("<ul>");
    foreach($listeErreur as $uneErreur){
        if($uneErreur != "1" && $uneErreur != "Format invalide"){
            print_r("<li> " .$uneErreur. "</li>");
        }
    }
print_r("</ul>");
    echo "</div>";
}

function afficherErreurMotDePasse(){
    ?>
    <div class="alert alert-primary" role="alert">
        Le mot de passe est incorrect.
    </div>

<?
}
