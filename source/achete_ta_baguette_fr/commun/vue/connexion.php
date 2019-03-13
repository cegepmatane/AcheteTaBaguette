<?php
require_once("../../commun/vue/entete-fragment.php");
require_once("../../commun/vue/pied-de-page-fragment.php");
require_once(CHEMIN_RACINE_COMMUN . "/accesseur/AccesseurClient.php");
require_once(CHEMIN_RACINE_COMMUN . "/action/action-connexion.php");

afficherEntete($page);
?>
    <?= $page->messageAction; ?>
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

                        </div>

                        <!-- Champ mot de passe -->
                        <div class="form-group">

                            <div class="row">
                                <div class="col-md-12">
                                    <label for="<?= $page->motDePasse; ?>"
                                           title="<?= $page->descriptionMotDePasse; ?>">
                                        <?php echo $page->etiquetteMotDePasse; ?>
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

                </form>

            </div>
        </div>
    </div>

<?php
afficherPiedDePage($page);