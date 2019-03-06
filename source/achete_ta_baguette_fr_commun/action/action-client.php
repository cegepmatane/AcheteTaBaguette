<?php

require_once CHEMIN_RACINE_COMMUN . "/modele/Client.class.php";
require_once CHEMIN_RACINE_COMMUN . "/accesseur/AccesseurProduit.php";

static::$accesseurClient = new AccesseurClient();

function recupererClient($clientRecherche)
{

    $laBDD = new AccesseurClient();
    return $laBDD->getClientParId($clientRecherche);

}

function recupererClientParId($idClient)
{

}

function supprimerClient($clientRecherche)
{

    if (!$clientRecherche->isValide(Client::ID_CLIENT)) {
        return false;
    }

    //Supprimer la client avec $clientRecherche->id_client dans la BD.

    //Si erreur
    //    if($erreur) return false;

    return true;

}

function ajouterClient($client)
{

    if (!$client->isValide()) {
        return false;
    }

    //Ajouter la client avec $client dans la BD.

    //Si erreur
    //    if($erreur) return false;

    return true;

}

function modifierClient($client)
{

    if (!$client->isValide()) {
        return false;
    }

    //Modifier la client avec $clientRecherche->id_client dans la BD.

    //Si erreur
    //    if($erreur) return false;

    return true;

}

if ($_GET["navigation-retour-url"] ?? false && $_GET["navigation-retour-titre"] ?? false) {

    $page->navigationRetourURL = $_GET["navigation-retour-url"];
    $page->navigationRetourTitre = $_GET["navigation-retour-titre"];

} else if ($_POST["navigation-retour-url"] ?? false && $_POST["navigation-retour-titre"] ?? false) {

    $page->navigationRetourURL = $_POST["navigation-retour-url"];
    $page->navigationRetourTitre = $_POST["navigation-retour-titre"];

}

//Récupérer les données d'une client de la BD
//si un id_client existe en GET
if ($_GET[$page->id_client] ?? false) {

    if (!$page->client = recupererClient(new Client((object) $_GET))) {

        $page->messageNavigationRetour = "Client non trouvée" .
        $page->isNavigationRetour = true;

    }

}

if (!$page->isNavigationRetour) {

    switch ($_GET["action-navigation"] ?? "") {

        case "detailler-client":
            $page->titre = "Les détails d'une client";
            break;

        case "ajouter-client":
            $page->isAjouterClient = true;
            $page->titre = "Ajouter une client";
            break;

        case "modifier-client":
            $page->isModifierClient = true;
            $page->titre = "Modifier une client";
            break;

        case "supprimer-client":
            $page->isSupprimerClient = true;
            $page->titre = "Supprimer une client";
            break;

        default:

            //Construire l'objet $page->client
            //avec les données du formulaire.
            $page->client = new Client((object) $_POST);

            if ($_POST["action-supprimer-client"] ?? false) {

                if (supprimerClient($page->client)) {

                    $page->messageNavigationRetour =
                        "Suppression de client réussie";

                    $page->isNavigationRetour = true;

                } else {

                    $page->messageAction =
                        "Erreur de suppression de client";

                    $page->isSupprimerClient = true;

                    $page->titre = "Supprimer une client";

                }

            } else if ($_POST["action-ajouter-client"] ?? false) {

                if (ajouterClient($page->client)) {

                    $page->messageNavigationRetour =
                        "Ajout de client réussie";

                    $page->isNavigationRetour = true;

                } else {

                    $page->messageAction = "Erreur d'ajout de client";

                    $page->isAjouterClient = true;

                    $page->titre = "Ajouter une client";
                }

            } else if ($_POST["action-modifier-client"] ?? false) {

                if (modifierClient($page->client)) {

                    $page->messageNavigationRetour =
                        "Modification de client réussie";

                    $page->isNavigationRetour = true;

                } else {

                    $page->messageAction =
                        "Erreur de modification de client";

                    $page->isModifierClient = true;

                    $page->titre = "Ajouter une client";

                }

            }
    }

    $page->isformulaireEditable = $page->isAjouterClient ||
    $page->isModifierClient;
}

afficherPage($page);

// EOF
