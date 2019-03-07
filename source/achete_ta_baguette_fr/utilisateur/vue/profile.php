<?php
require_once("../../commun/vue/entete-fragment.php");
// require_once("./utilisateur/vue/sidebar-client-fragment.php");
require_once("../../commun/vue/pied-de-page-fragment.php");
require_once("../../commun/vue/erreur.php");

require_once($_SERVER['CONFIGURATION_COMMUN']);


$page = (object)
[
    "titre" => "Page du client",
    "titrePrincipal" => "Le titre principal H1",
    "itemMenuActif" => "accueil",
];

include_once(CHEMIN_RACINE_COMMUN . "/action/action-edition-profile.php");


function afficherPage($page = null)
{

    // En cas d'erreur avec le paramètre $page, un objet $page vide est créé.

    if (!is_object($page)) $page = (object)[];
    afficherEntete($page);
    ?>

    <!--  jQuery -->
    <div class="content">
        <div class="row justify-content-md-center">
            <div class="col-md-8">
                <form action="" method="post">
                    <fieldset>
                        <legend>Mon profile</legend>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-12">
                                    <label class="col-form-label">Nom</label>
                                    <?php
                                    echo '<input type="text" class="form-control" id="" name="'.Client::NOM.'" value="' . $page->client->nom . '" required>';
                                    ?>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-12">
                                    <label class="col-form-label">Prénom </label>
                                    <?php
                                    echo '<input type="text" class="form-control" id="Prenom" name="'.Client::PRENOM.'" value="' . $page->client->prenom . '" required>';
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-2">
                                    <label class="col-form-label"><?php Client::RUE ?></label>
                                    <?php
                                    echo '<input type="text" class="form-control" id="'. Client::RUE. '" name="'.Client::RUE.'" value="' . $page->client->rue . '" required>';
                                    ?>
                                </div>
                                <div class="col-2">
                                    <label class="col-form-label"><?php Client::VILLE ?> </label>
                                    <?php
                                    echo '<input type="text" class="form-control" id=" '. Client::VILLE .'ville" name="'.Client::VILLE.'" value="' . $page->client->ville . '" required>'
                                    ?>
                                </div>
                                <div class="col-2">
                                    <label class="col-form-label"><?php Client::CODE_POSTAL ?></label>
                                    <?php
                                    echo '<input type="text" class="form-control" id="'. Client::CODE_POSTAL. '" name="'.Client::CODE_POSTAL.'" value="' . $page->client->codePostal . '" required>'
                                    ?>
                                </div>
                                <div class="col-3">
                                    <label class="col-form-label"> <?php Client::PROVINCE ?></label>
                                    <?php
                                    echo '<input type="text" class="form-control" id=" ' .Client::PROVINCE.'" name="'.Client::PROVINCE.'" value="' . $page->client->province . '" required>'
                                    ?>
                                </div>
                                <div class="col-3">
                                    <label class="col-form-label"><?php Client::PAYS ?></label>
                                    <?php
                                    echo '<input type="text" class="form-control" id="'.Client::PAYS.'" name="'.Client::PAYS.'" value="' . $page->client->pays . '" required>'
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-12">
                                    <label for="mail"><?php Client::EMAIL ?></label>
                                    <?php
                                    echo '<input type="email" class="form-control" id="mail"
                                           aria-describedby="emailHelp" name="'.Client::EMAIL.'" value="' . $page->client->email . '" required>'
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-12">
                                    <label for="mot_de_passe">Vérifier Mot de passe</label>
                                    <input type="password" class="form-control" id=" <?php echo Client::MOT_DE_PASSE ?>"
                                           name="<?php echo Client::MOT_DE_PASSE ?>" required>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-md-center">
                            <button type="submit" class="btn btn-primary" name="edition-profile">Sauvegarder</button>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>

    <?php
    afficherPiedDePage($page);

}

afficherPage($page);
