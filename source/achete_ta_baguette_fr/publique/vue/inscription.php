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
];

function afficherPage($page = null)
{
    afficherEntete($page);

    if (isset($_POST['submit'])) {

        $attribut = new stdClass();
        $attribut->nom = $_POST['nom'];
        $attribut->prenom = $_POST['prenom'];
        $attribut->pays = $_POST['pays'];
        $attribut->code_postal = $_POST['codePostale'];
        $attribut->province = $_POST['province'];
        $attribut->mail = $_POST['mail'];
        $attribut->date_de_naissance = $_POST['date'];
        $attribut->mot_de_passe = $_POST['mot_de_passe'];
        $attribut->mot_de_passe_verif = $_POST['mot_de_passe_verif'];
        $attribut->ville = $_POST['ville'];
        $attribut->rue = $_POST['rue'];

        $client = new Client($attribut);
        if (!empty($client->isValide())) {
            afficherErreurInscription();
        } else {
            $laBDD = new AccesseurClient();
            $laBDD->ajouterClient($client);
            $_SESSION['id'] = $laBDD->getClientParEmail($client->email);
            $_SESSION['isConnected'] = true;
            $_SESSION['admin'] = false;
            header("Location: /boutique");
        }

        // En cas d'erreur avec le paramètre $page, un objet $page vide est créé.
        if (!is_object($page)) {
            $page = (object) [];
        }
    }
    ?>

    <!--  jQuery -->
    <div class="content">
        <div class="row justify-content-md-center">
            <div class="col-md-8">
                <form action="" method="post">
                    <fieldset>
                        <legend>Inscription</legend>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-12">
                                    <label class="col-form-label">Nom</label>
                                    <input type="text" class="form-control" id="" name="nom" required>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-12">
                                    <label class="col-form-label">Prénom </label>
                                    <input type="text" class="form-control" id="Prenom" name="prenom" required>
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
                                    <input type="date" class="form-control" placeholder="DD/MM/YYY" name="date"
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
afficherPiedDePage($page);

}

afficherPage($page);
