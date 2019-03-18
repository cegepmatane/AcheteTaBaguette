<?php
function afficherErreurInscriptionEtapeUne($client)
{
    ?>
        <div class="alert alert-primary" role="alert">
           Voici la liste d'erreur :

<?php
$Erreur[CLIENT::NOM] = $client->getListeMessageErreurActif(CLIENT::NOM);
$Erreur[CLIENT::PRENOM] = $client->getListeMessageErreurActif(CLIENT::PRENOM);
$Erreur[CLIENT::RUE] = $client->getListeMessageErreurActif(CLIENT::RUE);
$Erreur[CLIENT::VILLE] = $client->getListeMessageErreurActif(CLIENT::VILLE);
$Erreur[CLIENT::CODE_POSTAL] = $client->getListeMessageErreurActif(CLIENT::CODE_POSTAL);
$Erreur[CLIENT::PROVINCE] = $client->getListeMessageErreurActif(CLIENT::PROVINCE);
$Erreur[CLIENT::PAYS] = $client->getListeMessageErreurActif(CLIENT::PAYS);
$Erreur[CLIENT::REGION] = $client->getListeMessageErreurActif(CLIENT::REGION);


print_r("<ul>");
foreach ( $Erreur as $unTableauDerreur){
    foreach ($unTableauDerreur as $uneErreur){
       if(!empty($uneErreur)) print_r("<li> " .$uneErreur. "</li>");
    }
}
print_r("</ul>");
    echo "</div>";
}

function afficherErreurInscriptionEtapeDeux($client)
{

$Erreur[CLIENT::EMAIL] = $client->getListeMessageErreurActif(CLIENT::EMAIL);
$Erreur[CLIENT::MOT_DE_PASSE] = $client->getListeMessageErreurActif(CLIENT::MOT_DE_PASSE);

    ?>
        <div class="alert alert-primary" role="alert">
           Voici la liste d'erreur :

<?php

foreach ( $Erreur as $unTableauDerreur){
    foreach ($unTableauDerreur as $uneErreur){
        if(!empty($uneErreur)) print_r("<li> " .$uneErreur. "</li>");
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

<?php
}
