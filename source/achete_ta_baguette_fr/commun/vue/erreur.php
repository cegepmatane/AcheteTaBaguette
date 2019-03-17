<?php
function afficherErreurInscriptionEtapeUne($client)
{
    ?>
        <div class="alert alert-primary" role="alert">
           Voici la liste d'erreur :

<?php
print_r("<ul>");
            print_r("<li> " .$client->getListeMessageErreurActif(CLIENT::NOM)[0]. "</li>");
            print_r("<li> " .$client->getListeMessageErreurActif(CLIENT::PRENOM)[0]. "</li>");
            print_r("<li> " .$client->getListeMessageErreurActif(CLIENT::RUE)[0]. "</li>");
            print_r("<li> " .$client->getListeMessageErreurActif(CLIENT::VILLE)[0]. "</li>");
            print_r("<li> " .$client->getListeMessageErreurActif(CLIENT::CODE_POSTAL)[0]. "</li>");
            print_r("<li> " .$client->getListeMessageErreurActif(CLIENT::PROVINCE)[0]. "</li>");
            print_r("<li> " .$client->getListeMessageErreurActif(CLIENT::PAYS)[0]. "</li>");
            print_r("<li> " .$client->getListeMessageErreurActif(CLIENT::REGION)[0]. "</li>");

print_r("</ul>");
    echo "</div>";
}

function afficherErreurInscriptionEtapeDeux($client)
{
    ?>
        <div class="alert alert-primary" role="alert">
           Voici la liste d'erreur :

<?php
print_r("<ul>");
            print_r("<li> " .$client->getListeMessageErreurActif(CLIENT::EMAIL)[0]. "</li>");
            print_r("<li> " .$client->getListeMessageErreurActif(CLIENT::MOT_DE_PASSE)[0]. "</li>");
print_r("</ul>");
    echo "</div>";
}

function afficherErreurMotDePasse(){
    ?>
    <div class="alert alert-primary" role="alert">
        Le mot de passe est incorrect.
    </div>

<?php
}
