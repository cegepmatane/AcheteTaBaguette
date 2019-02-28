<?php

//Le chemin vers le code PHP de la section nom_de_domaine_com_commun
//qui est hors du $_SERVER['DOCUMENT_ROOT'].
//Idéalement, une variable d'environnement devrait être utilisée.
define(CHEMIN_RACINE_COMMUN, $_SERVER['CHEMIN_RACINE_COMMUN']);
define(CHEMIN_RACINE_ADMINISTRATION, "/var/www/code/achete_ta_baguette_fr_administration");
define(CHEMIN_RACINE_PUBLIQUE, "/var/www/code/achete_ta_baguette_fr_publique");
define(CHEMIN_RACINE_UTILISATEUR, "/var/www/code/achete_ta_baguette_fr_utilisateur");

//Le chemin vers le code PHP des vues de la section commun
define(CHEMIN_VUE_COMMUN, $_SERVER['DOCUMENT_ROOT']. "/commun/vue");


//Définir l'URL du site pour la partie non PHP de la
//section nom_de_domaine_com_commun.
define(URL_COMMUN, $_SERVER['HTTP_HOST' . "/commun"]);

//Inclusion du fichier de mot de passe et des informations de connexion à la
//base de données.
require_once(CHEMIN_RACINE_COMMUN . "/configuration/mot-de-passe.dev.php");

//Définition des constantes de connexion à la base de données.
define(BASE_DE_DONNEE_HOST, '127.0.0.1');
define(BASE_DE_DONNEE_NOM, $baseDeDonnee);
define(BASE_DE_DONNEE_UTILISATEUR, $utilisateur);
define(BASE_DE_DONNEE_MOT_DE_PASSE, $motDePasse);
define(BASE_DE_DONNEE_CHARSET, 'utf8mb4'); //utf8mb4 est spécifique à MySQL. Le reste du monde l'appelle UTF-8.

//Définir ici toutes les constantes communes à l'ensemble du site

function determinerSectionWebCourante(){

    $cheminAbsolutFichierPrincipal = getcwd();

    $cheminRelatifSectionWeb =
        str_replace($_SERVER['DOCUMENT_ROOT'],
                    $cheminAbsolutFichierPrincipal,"");

    $sectionWeb = explode("/", $cheminRelatifSectionWeb)[1];

    return $sectionWeb;

}

function determinerSectionCodeCourante($sectionWebCourante){

    $listeNomRepertoire = explode("/", $_SERVER['DOCUMENT_ROOT']);

    $nomRepertoireDocumentRoot =
        $listeNomRepertoire[$listeNomRepertoire.count - 1];

    $sectionCode = $nomRepertoireDocumentRoot . "_" . $sectionWebCourante;

    return $sectionCode;

}

$sectionWebCourante = determinerSectionWebCourante();

//L'URL du site pour la partie non PHP de la section
//nom_de_domaine_com_publique.
define(URL_SECTION, $_SERVER['HTTP_HOST'] . "/" . $sectionWebCourante);


$sectionCodeCourante = determinerSectionCodeCourante($sectionWebCourante);

//Le chemin vers le code PHP de la section
//nom_de_domaine_com_publique ou
//nom_de_domaine_com_utilisateur ou
//nom_de_domaine_com_adminitration ou
//nom_de_domaine_com_commun
//qui est hors du $_SERVER['DOCUMENT_ROOT'].
define(CHEMIN_RACINE_SECTION, "/var/www/code/" . $sectionCodeCourante);

if("achete_ta_baguette_fr_commun" != $sectionCodeCourante){

//    require_once(CHEMIN_RACINE_SECTION . "/configuration/configuration.php");

}

// EOF