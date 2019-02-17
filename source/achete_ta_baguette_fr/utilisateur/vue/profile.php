<?php
require_once("..\\vue\\entete-fragment.php");
// require_once("./utilisateur/vue/sidebar-utilisateur-fragment.php");
require_once("..\commun\\vue\pied-de-page-fragment.php");
require_once(CHEMIN_RACINE_COMMUN . "/configuration/configuration.php");

require_once(CHEMIN_RACINE_COMMUN . "/modele/Client.class.php");
require_once(CHEMIN_RACINE_COMMUN . "/accesseur/AccesseurClient.php");



$page = (object)
[
    "titre" => "Page du profile",
    "titrePrincipal" => "Le titre principal H1",
    "itemMenuActif" => "accueil",
    "isConnected" => true,
    "idClient" => $_SESSION['id']
];


function afficherPage($page = null)
{
    $accesseurClient = new AccesseurClient();
    $profile = $accesseurClient->getClientParId($_SESSION['id']);
    // En cas d'erreur avec le paramètre $page, un objet $page vide est créé.

    if (!is_object($page)) $page = (object)[];
    afficherEntete($page);

    if (isset($_POST['submit'])) {

        $attribut = new stdClass();
        $attribut->nom = $_POST['nom'];
        $attribut->prenom = $_POST['prenom'];
        $attribut->pays = $_POST['pays'];
        $attribut->code_postal = $_POST['codePostale'];
        $attribut->province = $_POST['province'];
        $attribut->mail = $_POST['email'];
        $attribut->date_de_naissance = $_POST['date'];
        $attribut->mot_de_passe = $_POST['mot_de_passe'];
        $attribut->mot_de_passe_verif = $_POST['mot_de_passe'];
        $attribut->ville = $_POST['ville'];
        $attribut->rue = $_POST['rue'];
        if($profile->motDePasse == sha1($attribut->mot_de_passe)){
            $client = new Client($attribut);
            $client->id = $_SESSION['id'];
            if(!empty($client->isValide())){
                 afficherErreurInscription();
            }else{
                $laBDD = new AccesseurClient();
                $laBDD->miseAJourClient($client);
            }
        }else afficherErreurInscription();

    }
    ?>

    <!--  jQuery -->
    <div class="content">
        <div class="row justify-content-md-center">
            <div class="col-md-8">
                <form action="" method="post">
                    <fieldset>
                        <legend>Mon Profile</legend>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-12">
                                    <label class="col-form-label">Nom</label>
                                    <?php
                                    echo '<input type="text" class="form-control" id="" name="nom" value="'.$profile->nom.'" required>';
                                    ?>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-12">
                                    <label class="col-form-label">Prénom </label>
                                    <?php
                                        echo '<input type="text" class="form-control" id="Prenom" name="prenom" value="'.$profile->prenom .'" required>';
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-2">
                                    <label class="col-form-label">Rue </label>
                                    <?php
                                    echo '<input type="text" class="form-control" id="rue" name="rue" value="'. $profile->rue . '" required>';
                                    ?>
                                </div>
                                <div class="col-2">
                                    <label class="col-form-label">Ville </label>
                                    <?php
                                    echo '<input type="text" class="form-control" id="ville" name="ville" value="'. $profile->ville .'" required>'
                                    ?>
                                </div>
                                <div class="col-2">
                                    <label class="col-form-label">Code Postale </label>
                                    <?php
                                    echo '<input type="text" class="form-control" id="codePostale" name="codePostale" value="'. $profile->codePostal.'" required>'
                                    ?>
                                </div>
                                <div class="col-3">
                                    <label class="col-form-label">Province </label>
                                    <?php
                                    echo '<input type="text" class="form-control" id="province" name="province" value="'. $profile->province .'" required>'
                                    ?>
                                </div>
                                <div class="col-3">
                                    <label class="col-form-label">pays </label>
                                    <?php
                                    echo'<input type="text" class="form-control" id="pays" name="pays" value="'.$profile->pays.'" required>'
                                    ?>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-12">
                                    <label class="col-form-label">Date de Naissance </label>
                                    <?php
                                    echo '<input type="date" class="form-control" placeholder="DD/MM/YYY" name="date" value="'. $profile->naissance.' " 
                                           required/>';
                                           ?>
                                </div>
                            </div>

                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-12">
                                    <label for="mail">Mail</label>
                                    <?php
                                    echo '<input type="email" class="form-control" id="mail"
                                           aria-describedby="emailHelp" name="email" value="'. $profile->email.'" required>'
                                           ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-12">
                                    <label for="mot_de_passe">Vérifier Mot de passe</label>
                                    <input type="password" class="form-control" id="mot_de_passe"
                                           name="mot_de_passe" required>
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
                            <button type="submit" class="btn btn-primary" name="submit">Sauvegarder</button>
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
