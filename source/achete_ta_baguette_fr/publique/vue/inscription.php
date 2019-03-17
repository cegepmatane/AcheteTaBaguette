<?php
require_once "../../commun/vue/entete-fragment.php";
require_once("../../commun/vue/sidebar-client-fragment.php");
require_once "../../commun/vue/pied-de-page-fragment.php";
require_once  "../../commun/vue/erreur.php";
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
    "client" => new Client((object) null),
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
                                           id="<?php echo CLIENT::NOM ?>" name="<?php echo CLIENT::NOM ?>" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-12">
                                    <label class="col-form-label">Prénom </label>
                                    <input type="text" class="form-control"
                                           value="<?php echo $page->client->prenom ?>" id="<?php echo CLIENT::PRENOM ?>" name="<?php echo CLIENT::PRENOM ?>"
                                           required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-2">
                                    <label class="col-form-label">Rue </label>
                                    <input type="text" class="form-control" id="<?php echo CLIENT::RUE?>"
                                           value="<?php echo $page->client->getRue() ?>" name="<?php echo CLIENT::RUE?>"
                                           required>
                                </div>
                                <div class="col-2">
                                    <label class="col-form-label">Ville </label>
                                    <input type="text" class="form-control" id="<?php echo CLIENT::VILLE?>"
                                           value="<?php echo $page->client->getVille() ?> " name="<?php echo CLIENT::VILLE?>"
                                           required>
                                </div>
                                <div class="col-2">
                                    <label class="col-form-label">Code Postal </label>
                                    <input type="text" class="form-control" id="<?php echo CLIENT::CODE_POSTAL?>"
                                           value="<?php echo $page->client->getCodePostal() ?> " name="<?php echo CLIENT::CODE_POSTAL?>"
                                           required>
                                </div>
                                <div class="col-3">
                                    <label class="col-form-label">Province </label>
                                    <input type="text" class="form-control" id="<?php echo CLIENT::PROVINCE ?>" name="<?php echo CLIENT::PROVINCE?>"
                                           value="<?php echo $page->client->getProvince() ?> "
                                           required>
                                </div>
                                <div class="col-3">
                                    <label class="col-form-label">pays </label>
                                    <input type="text" class="form-control" id="<?php echo CLIENT::PAYS?>" name="<?php echo CLIENT::PAYS?>"
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
                    <input type="hidden" value="<?php echo $page->client->getNom() ?>" class="form-control" id=" <?php echo CLIENT::NOM ?>"
                           name="<?php echo CLIENT::NOM ?>" required>
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="row">
                <div class="col-12">
                    <input type="hidden" class="form-control" value="<?php echo $page->client->getPrenom() ?>"
                           id="<?php echo CLIENT::PRENOM ?>" name="<?php echo CLIENT::PRENOM ?>" required>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-2">
                    <input type="hidden" class="form-control" id="<?php echo CLIENT::RUE?>" value="<?php echo $page->client->getRue() ?>"
                           name="<?php echo CLIENT::RUE?>"
                           required>
                </div>
                <div class="col-2">
                    <input type="hidden" class="form-control" id="<?php echo CLIENT::VILLE ?>"
                           value="<?php echo $page->client->getVille() ?> " name="<?php echo CLIENT::VILLE ?>"
                           required>
                </div>
                <div class="col-2">
                    <input type="hidden" class="form-control" id="<?php echo CLIENT::CODE_POSTAL ?>"
                           value="<?php echo $page->client->getCodePostal() ?> " name="<?php echo CLIENT::CODE_POSTAL?>" required>
                </div>
                <div class="col-3">
                    <input type="hidden" class="form-control" id="<?php echo Client::PROVINCE ?>" name="<?php echo CLIENT::PROVINCE?>"
                           value="<?php echo $page->client->getProvince() ?> "
                           required>
                </div>
                <div class="col-3">
                    <input type="hidden" class="form-control" id="<?php echo CLIENT::PAYS?>" name="<?php echo CLIENT::PAYS?>"
                           value="<?php echo $page->client->getPays() ?> "
                           required>
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="row">
                <div class="col-12">
                    <label class="col-form-label">Mail</label>
                    <input type="text" class="form-control" id="<?php echo CLIENT::EMAIL?>"
                           name="<?php echo CLIENT::EMAIL?>">
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-12">
                    <label class="col-form-label">Mot de passe</label>
                    <input type="password" class="form-control" id="<?php echo CLIENT::MOT_DE_PASSE?>"
                           name="<?php echo CLIENT::MOT_DE_PASSE?>">
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="row">
                <div class="col-12">
                    <label class="col-form-label">Confirmer mot de passe</label>
                    <input type="password" class="form-control" id="mot_de_passe_verif"
                           name="mot_de_passe_verif">
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

    if(isset($page->erreur)){
        if($page->isEtapeUn == true) afficherErreurInscriptionEtapeUne($page->client);
        else afficherErreurInscriptionEtapeDeux($page->client);
    }
    if ($page->isEtapeUn == true && $page->isEtapeDeux == false) {
        afficherPremiereEtape($page);
    }
    if ($page->isEtapeUn == false && $page->isEtapeDeux == true) {
        afficherSecondeEtape($page);
    }

    afficherPiedDePage($page);

}

require_once(CHEMIN_RACINE_PUBLIQUE . "/action/action-inscription.php");
