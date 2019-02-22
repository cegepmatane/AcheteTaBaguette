<?php
require_once "../../commun/vue/entete-fragment.php";
require_once("../../commun/vue/sidebar-utilisateur-fragment.php");
require_once "../../commun/vue/pied-de-page-fragment.php";
require_once "erreur-inscription.php";
require_once $_SERVER['CONFIGURATION_COMMUN'];
require_once CHEMIN_RACINE_COMMUN . "/accesseur/AccesseurClient.php";

$page = (object)
    [
    "titre" => "Page d'inscription",
    "titrePrincipal" => "Le titre principal H1",
    "itemMenuActif" => "accueil",
    "isConnected" => false,
        "etape" => 1,
    "erreur" => "",
];

function afficherPremiereEtape($page =null){
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
                                    <input type="text" class="form-control" id="nom" name="nom" required>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-12">
                                    <label class="col-form-label">Prénom </label>
                                    <input type="text" class="form-control" id="prenom" name="prenom" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-2">
                                    <label class="col-form-label">Rue </label>
                                    <input type="text" class="form-control" id="rue" name="rue"
                                           required>
                                </div>
                                <div class="col-2">
                                    <label class="col-form-label">Ville </label>
                                    <input type="text" class="form-control" id="ville" name="ville"
                                           required>
                                </div>
                                <div class="col-2">
                                    <label class="col-form-label">Code Postal </label>
                                    <input type="text" class="form-control" id="codePostale" name="codePostale"
                                           required>
                                </div>
                                <div class="col-3">
                                    <label class="col-form-label">Province </label>
                                    <input type="text" class="form-control" id="province" name="province"
                                           required>
                                </div>
                                <div class="col-3">
                                    <label class="col-form-label">pays </label>
                                    <input type="text" class="form-control" id="pays" name="pays"
                                           required>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-12">
                                    <label class="col-form-label">Date de Naissance </label>
                                    <input type="date" class="form-control" placeholder="DD/MM/YYY" id="date" name="date"
                                           required/>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-md-center">
                            <button type="submit" class="btn btn-primary" name="action-aller-seconde-etape">Suivant</button>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
<?php
}
function afficherSecondeEtape($page=null){
    ?>
    <div class="content">
        <div class="row justify-content-md-center">
            <div class="col-md-8">
                <form>
                <fieldset>
                    <legend>Inscription</legend>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-12">
                                <input type="hidden" class="form-control" id="" name="nom" required>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-12">
                                <input type="hidden" class="form-control" id="Prenom" name="prenom" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-2">
                                <input type="hidden" class="form-control" id="rue" name="rue"
                                       required>
                            </div>
                            <div class="col-2">
                                <input type="hidden" class="form-control" id="ville" name="ville"
                                       required>
                            </div>
                            <div class="col-2">
                                <input type="hidden" class="form-control" id="codePostale" name="codePostale"
                                       required>
                            </div>
                            <div class="col-3">
                                <input type="hidden" class="form-control" id="province" name="province"
                                       required>
                            </div>
                            <div class="col-3">
                                <input type="hidden" class="form-control" id="pays" name="pays"
                                       required>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-12">
                                <input type="hidden" class="form-control" placeholder="DD/MM/YYY" name="date"
                                       required/>
                            </div>
                        </div>

                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-12">
                                <label for="mail">Mail</label>
                                <input type="email" class="form-control" id="mail"
                                       aria-describedby="emailHelp" name="mail" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-12">
                                <label for="mot_de_passe">Mot de passe</label>
                                <input type="password" class="form-control" id="mot_de_passe"
                                       name="mot_de_passe" required>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-12">
                                <label for="mot_de_passe_verif">Confirmer mot de passe</label>
                                <input type="password" class="form-control" id="mot_de_passe_verif"
                                       name="mot_de_passe_verif" required>
                            </div>
                        </div>
                    </div>

                    <div class="row justify-content-md-center">
                        <div class="row">
                            <div class="col-12">
                                <label class="form-check-label" for="defaultCheck1">
                                    J'ai lu, compris et accepté les termes d'utilisation
                                </label>
                                <input type="checkbox" name="condition" value="agreed" required>
                            </div>
                        </div>
                    </div>

                    <div class="row justify-content-md-center">
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
    afficherEntete($page);
        // En cas d'erreur avec le paramètre $page, un objet $page vide est créé.
        if (!is_object($page)) {
            $page = (object) [];
        }
        if($page->etape == 1) {
            afficherPremiereEtape($page);
        }if($page->etape == 2){
            afficherSecondeEtape($page);
        }

    ?>

    <!--  jQuery -->

    <?php
afficherPiedDePage($page);

}

require_once(CHEMIN_RACINE_PUBLIQUE . "/action/action-inscription.php");
