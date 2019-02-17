<?php
require_once("../../commun/vue/entete-fragment.php");
// require_once("./utilisateur/vue/sidebar-utilisateur-fragment.php");
require_once("../../commun/vue/pied-de-page-fragment.php");
require_once("erreur-inscription.php");
require_once (CHEMIN_RACINE_COMMUN . "/accesseur/AcesseurClient.php");
require_once(CHEMIN_RACINE_COMMUN . "/modele/Client.class.php");

if(!isset($_POST['page'])) {
    $page = (object)
    [
        "titre" => "Page d'inscription",
        "titrePrincipal" => "Le titre principal H1",
        "itemMenuActif" => "accueil",
        "isConnected" => true,
        "user" => "Pierre"
    ];
}


function afficherPage($page = null)
{


    if (isset($_POST['submit'])) {

        $attribut = new stdClass();
        $attribut->email = $_POST['mail'];
        $attribut->mot_De_Passe = $_POST['mot_de_passe'];
        $laBDD = new AccesseurClient();
        $resultat = $laBDD->verifierClient($attribut);
        if($resultat != false){
            session_start();
            //Remplacer idclient par ID ?
            $_SESSION["id"] = $resultat->idClient;
            header("Location: inscription.php");
        }else{
            afficherErreurInscription();
        }
    }

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
                        <legend>Inscription</legend>
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

                        <div class="row justify-content-md-center">
                            <button type="submit" class="btn btn-primary" name="submit">Se connecter</button>
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
