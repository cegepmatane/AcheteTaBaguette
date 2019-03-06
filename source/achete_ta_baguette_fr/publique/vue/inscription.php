<?php
require_once "../../commun/vue/entete-fragment.php";
require_once("../../commun/vue/sidebar-utilisateur-fragment.php");
require_once "../../commun/vue/pied-de-page-fragment.php";
require_once "erreur-inscription.php";
require_once $_SERVER['CONFIGURATION_COMMUN'];
require_once CHEMIN_RACINE_COMMUN . "/accesseur/AccesseurClient.php";
require_once CHEMIN_RACINE_COMMUN . "/modele/Client.php";

$page = (object)
[
    "titre" => "Page d'inscription",
    "titrePrincipal" => "Le titre principal H1",
    "itemMenuActif" => "accueil",
    "isConnected" => false,
    "isEtapeUn" => true,
    "isEtapeDeux" => false,
    "erreur" => "",
    "client" => null,
    "isRetourEnArriere" => false
];

function afficherPremiereEtape($page)
{
    ?>
    <div class="content">
        <div class="row justify-content-md-center">
            <div class="col-md-8">
                <form method="post">
                    <fieldset>
                        <legend>Inscription</legend>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-12">
                                    <label class="col-form-label">Nom</label>
                                    <input type="text" value="<?php echo $page->client->nom ?>" class="form-control"
                                           id="nom" name="nom" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-12">
                                    <label class="col-form-label">Prénom </label>
                                    <input type="text" class="form-control"
                                           value="<?php echo $page->client->getPrenom() ?>" id="prenom" name="prenom"
                                           required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-2">
                                    <label class="col-form-label">Rue </label>
                                    <input type="text" class="form-control" id="rue"
                                           value="<?php echo $page->client->getRue() ?>" name="rue"
                                           required>
                                </div>
                                <div class="col-2">
                                    <label class="col-form-label">Ville </label>
                                    <input type="text" class="form-control" id="ville"
                                           value="<?php echo $page->client->getVille() ?> " name="ville"
                                           required>
                                </div>
                                <div class="col-2">
                                    <label class="col-form-label">Code Postal </label>
                                    <input type="text" class="form-control" id="codePostale"
                                           value="<?php echo $page->client->getCodePostal() ?> " name="codePostale"
                                           required>
                                </div>
                                <div class="col-3">
                                    <label class="col-form-label">Province </label>
                                    <input type="text" class="form-control" id="province" name="province"
                                           value="<?php echo $page->client->getProvince() ?> "
                                           required>
                                </div>
                                <div class="col-3">
                                    <label class="col-form-label">pays </label>
                                    <input type="text" class="form-control" id="pays" name="pays"
                                           value="<?php echo $page->client->getPays() ?> "
                                           required>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-md-center">
                            <button type="submit" class="btn btn-primary" name="action-aller-seconde-etape">Suivant
                            </button>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
    <?php
}

function afficherSecondeEtape($page)
{
    ?>
    <form method="post">
    <fieldset>
        <legend>Inscription</legend>
        <div class="form-group">
            <div class="row">
                <div class="col-12">
                    <input type="hidden" value="<?php echo $page->client->getNom() ?>" class="form-control" id="nom"
                           name="nom" required>
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="row">
                <div class="col-12">
                    <input type="hidden" class="form-control" value="<?php echo $page->client->getPrenom() ?>"
                           id="prenom" name="prenom" required>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-2">
                    <input type="hidden" class="form-control" id="rue" value="<?php echo $page->client->getRue() ?>"
                           name="rue"
                           required>
                </div>
                <div class="col-2">
                    <input type="hidden" class="form-control" id="ville"
                           value="<?php echo $page->client->getVille() ?> " name="ville"
                           required>
                </div>
                <div class="col-2">
                    <input type="hidden" class="form-control" id="codePostale"
                           value="<?php echo $page->client->getCodePostal() ?> " name="codePostale" required>
                </div>
                <div class="col-3">
                    <input type="hidden" class="form-control" id="province" name="province"
                           value="<?php echo $page->client->getProvince() ?> "
                           required>
                </div>
                <div class="col-3">
                    <input type="hidden" class="form-control" id="pays" name="pays"
                           value="<?php echo $page->client->getPays() ?> "
                           required>
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="row">
                <div class="col-12">
                    <label for="mail">Mail</label>
                    <input type="email" class="form-control" id="mail"
                           aria-describedby="emailHelp" name="mail">
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-12">
                    <label for="mot_de_passe">Mot de passe</label>
                    <input type="password" class="form-control" id="mot_de_passe"
                           name="mot_de_passe">
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="row">
                <div class="col-12">
                    <label for="mot_de_passe_verif">Confirmer mot de passe</label>
                    <input type="password" class="form-control" id="mot_de_passe_verif"
                           name="mot_de_passe_verif">
                </div>
            </div>
        </div>

        <div class="row justify-content-md-center">
            <div class="row">
                <div class="col-12">
                    <label class="form-check-label" for="defaultCheck1">
                        J'ai lu, compris et accepté les termes d'utilisation
                    </label>
                    <input type="checkbox" name="condition" value="agreed">
                </div>
            </div>
        </div>

        <div class="row justify-content-md-center">
            <button type="submit" class="btn btn-primary" name="retour-premiere-etape">Retour</button>
            <button type="submit" class="btn btn-primary" name="submit">Envoyer</button>
        </div>
    </fieldset>
    </form>
    </div>
    </div>
    </div>
    <?php
}


function afficherPage($page = null)
{
    // En cas d'erreur avec le paramètre $page, un objet $page vide est crée
    if (!is_object($page)) {
        $page = (object)[];
    }
    afficherEntete($page);

    if ($page->isEtapeUn == true && $page->isEtapeDeux == false) {
        afficherPremiereEtape($page);
    }
    if ($page->isEtapeUn == false && $page->isEtapeDeux == true) {
        afficherSecondeEtape($page);
    }

    afficherPiedDePage($page);

}

require_once(CHEMIN_RACINE_PUBLIQUE . "/action/action-inscription.php");
