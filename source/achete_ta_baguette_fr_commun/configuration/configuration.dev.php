<?php

//Le chemin vers le code PHP de la section nom_de_domaine_com_commun
//qui est hors du $_SERVER['DOCUMENT_ROOT'].
//Idéalement, une variable d'environnement devrait être utilisée.
define(CHEMIN_RACINE_COMMUN, $_SERVER['CHEMIN_RACINE_COMMUN']);
define(CHEMIN_RACINE_ADMINISTRATION, "/var/www/code/achete_ta_baguette_fr_administrateur");
define(CHEMIN_RACINE_PUBLIQUE, "/var/www/code/achete_ta_baguette_fr_publique");
define(CHEMIN_RACINE_UTILISATEUR, "/var/www/code/achete_ta_baguette_fr_utilisateur");

//Le chemin vers le code PHP des vues de la section commun
define(CHEMIN_VUE_COMMUN, $_SERVER['DOCUMENT_ROOT']. "/commun/vue");


//Inclusion du fichier de mot de passe et des informations de connexion à la
//base de données.
require_once(CHEMIN_RACINE_COMMUN . "/configuration/mot-de-passe.php");

//Définition des constantes de connexion à la base de données.
define(BASE_DE_DONNEE_HOST, '127.0.0.1');
define(BASE_DE_DONNEE_NOM, $baseDeDonnee);
define(BASE_DE_DONNEE_UTILISATEUR, $utilisateur);
define(BASE_DE_DONNEE_MOT_DE_PASSE, $motDePasse);
define(BASE_DE_DONNEE_CHARSET, 'utf8mb4'); //utf8mb4 est spécifique à MySQL. Le reste du monde l'appelle UTF-8.

// EOF