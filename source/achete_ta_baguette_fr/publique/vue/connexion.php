<?php
require_once("../../commun/vue/entete-fragment.php");
// require_once("./utilisateur/vue/sidebar-utilisateur-fragment.php");
require_once("../../commun/vue/pied-de-page-fragment.php");
require_once("erreur-inscription.php");
require_once($_SERVER['CONFIGURATION_COMMUN']);
require_once(CHEMIN_RACINE_COMMUN . "/accesseur/AccesseurClient.php");
require_once(CHEMIN_RACINE_COMMUN . "/modele/Client.class.php");

if(!isset($_POST['page'])) {
    $page = (object)
    [
        "titre" => "Connexion",
//        "navigationRetourURL" => "/",
//        "navigationRetourTitre" => "Accueil",
//        "messageNavigationRetour" => "",
//        "isNavigationRetour" => false,
//        "isConnecterClient" => false,
        "messageAction" => "",
        "resultat" => null,

        "client" => null,
        "idClient" => null,
        "isConnected" => false,
        "admin" => false,

        "email" => Client::EMAIL,
        "descriptionEmail" => Client::getInformation(Client::EMAIL)->description,
        "etiquetteEmail" => Client::getInformation(Client::EMAIL)->etiquette,
        "indiceEmail" => Client::getInformation(Client::EMAIL)->indice,
        "isEmailObligatoire" => Client::getInformation(Client::EMAIL)->obligatoire,

        "motDePasse" => Client::MOT_DE_PASSE,
        "descriptionMotDePasse" => Client::getInformation(Client::MOT_DE_PASSE)->description,
        "etiquetteMotDePasse" => Client::getInformation(Client::MOT_DE_PASSE)->etiquette,
        "indiceMotDePasse" => Client::getInformation(Client::MOT_DE_PASSE)->indice,
        "isMotDePasseObligatoire" => Client::getInformation(Client::MOT_DE_PASSE)->obligatoire,
    ];
}

function afficherPageConnexion($page = null)
{
    if (!is_object($page)) $page = (object)[];

    //Redirection vers la page de retour avec un message de réussite.
    if($page->isNavigationRetour ?? false && $page->navigationRetourURL ?? false){

        $location = $page->navigationRetourURL;
        header("Location: " . $location);
        exit;
    }

    afficherEntete($page);
?>

    <?= $page->messageAction; ?>
    <?= $page->resultat; ?>
    <div class="content">
        <div class="row justify-content-md-center">
            <div class="col-md-8">
                <form method="post">
                    <fieldset>

                        <legend><?= $page->titre ?? "" ?></legend>

                        <!-- Champ email -->
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="<?= $page->email; ?>"
                                           title="<?= $page->descriptionEmail; ?>">
                                        <?= $page->etiquetteEmail; ?>
                                    </label>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-8">
                                    <input type="mail"
                                           class="form-control"
                                           name="<?= $page->email; ?>"
                                           id="<?= $page->email; ?>"
                                    >
                                </div>
                                <div class="col-md-4">
                                    <span><?= $page->isEmailObligatoire ? "obligatoire" : ""; ?></span>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <span><?= $page->indiceEmail; ?></span>
                                </div>
                            </div>
                            <?php //afficherErreurFormulaire($page->client->getListeMessageErreurActif($page->mail)); ?>

                        </div>

                        <!-- Champ mot de passe -->
                        <div class="form-group">

                            <div class="row">
                                <div class="col-md-12">
                                    <label for="<?= $page->motDePasse; ?>"
                                           title="<?= $page->descriptionMotDePasse; ?>">
                                        <?= $page->etiquetteMotDePasse; ?>
                                    </label>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-8">
                                    <input type="password"
                                           class="form-control"
                                           name="<?= $page->motDePasse; ?>"
                                           id="<?= $page->motDePasse; ?>"
                                    >
                                </div>
                                <div class="col-md-4">
                                    <span><?= $page->isMotDePasseObligatoire ? "obligatoire" : ""; ?></span>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <span><?= $page->indiceMotDePasse; ?></span>
                                </div>
                            </div>
                            <?php //afficherErreurFormulaire($page->client->getListeMessageErreurActif($page->motDePasse)); ?>

                        </div>

                        <!-- Boutton connexion -->
                        <div class="row justify-content-md-center">
                            <div class="col-sm-2">
                                <button type="submit" class="btn btn-primary" name="action-connecter-client">Se connecter</button>
                            </div>

                        </div>

                    </fieldset>

                    <input type="hidden"
                           name="navigation-retour-url"
                           value="<?= $page->navigationRetourURL ?? ""; ?>">

                    <input type="hidden"
                           name="navigation-retour-titre"
                           value="<?= $page->navigationRetourTitre ?? ""; ?>">

                    <?php
                    if($page->isAjouterPersonne ?? false){ ?>

                    <input type="submit"
                           name="action-ajouter-personne"
                           value="Ajouter la personne">

                    <?php
                    } ?>

                </form>

            </div>
        </div>
    </div>

<?php
    afficherPiedDePage($page);
}
require_once(CHEMIN_RACINE_COMMUN . "/action/action-connexion.php");
