<?php
require_once($_SERVER['CONFIGURATION_COMMUN']);
require_once(CHEMIN_RACINE_COMMUN . "/modele/Client.class.php");

function afficherSideBarUtilisateur($page = null) {
    if(!is_object($page)) $page = (object)[];

?>
<div class="sidebarLeft">

    <!-- Si connecte -->
<?php
    if($page->isConnected == true) {
?>
    <div class="connecter">
        <div class="row mb-3">
            <div class="col-md-12">
                <h3>Bonsoir <?php echo $page->prenom; ?> </h3>
            </div>
        </div>

        <!-- Informations utilisateur -->
        <div class="row mb-3">
            <div class="col-md-10 pt-2 mx-auto border">

                <!-- bouton panier -->
                <div class="row mb-3">
                    <div class="col-md-12">
                        <a href="#" class="btn btn-danger">Panier</a>
                    </div>
                </div>

                <!-- Adresse de livraison -->
                <div class="row mb-3">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12">
                                <strong>Adresse de livraison :</strong>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <span>Rue :</span>
                                <span><?php echo $page->rue; ?></span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <span>Ville :</span>
                                <span><?php echo $page->ville; ?></span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <span>Province :</span>
                                <span><?php echo $page->province; ?></span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <span>Code postal :</span>
                                <span><?php echo $page->codePostal; ?></span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <span>Pays :</span>
                                <span><?php echo $page->pays; ?></span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- <div class="row mb-3">
                    <div class="col-md-12">
                        plus d'info
                    </div>
                </div> -->

            </div>
        </div>

        <!--  -->
        <div class="row mb-3 text-center">
            <div class="col-md-12 align-self-end">
                <div class="row mb-2">
                    <div class="col-md-12">
                        <a href="#" class="btn btn-outline-primary">Modifier mes informations</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <a href="#" class="btn btn-outline-primary">Se déconnecter</a>
                    </div>
                </div>
            </div>
        </div>

    </div>
<?php
    }
?>

<?php
   if($page->isConnected == false) {
?>
    <!-- Si deconnecte -->
    <div class="deconnecter">
        <div class="row mb-2 text-center">
            <div class="col-md-12">
                <a href="#" class="btn btn-outline-primary">Se connecter</a>
            </div>
        </div>
        <div class="row mb-3 text-center">
            <div class="col-md-12">
                <a href="inscription" class="btn btn-outline-primary">S'inscrire</a>
            </div>
        </div>
    </div>
<?php
   }
?>
</div>

<?php
}
