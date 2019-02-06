<?php

function afficherSideBarUtilisateur($page = null){

    // En cas d'erreur avec le paramètre $page, un objet $page vide est créé.
    if(!is_object($page)) $page = (object)[];

    ?>

<div class="sidebarLeft">

    <!-- Si deconnecte -->
    <?php
    if($page->isConnected == false){
    ?>
    <div class="deconnecter" style="display: none;">
        <div class="row mb-2 text-center">
            <div class="col-md-12">
                <a href="#" class="btn btn-outline-primary">Se connecter</a>
            </div>
        </div>
        <div class="row mb-3 text-center">
            <div class="col-md-12">
                <a href="#" class="btn btn-outline-primary">S'inscrire</a>
            </div>
        </div>
    </div>
    <?php
    }
    ?>

    <!-- Si connecte -->
    <?php
    if($page->isConnected == true){
    ?>
    <div class="connecter" style="display: block;">
        <div class="row mb-3">
            <div class="col-md-12">

                <h3>Bonsoir
                  <?php
                  echo  $page->user;
                   ?>

                </h3>
            </div>
        </div>
      </div>
      <?php
        }
      ?>

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
                                <span>rue :</span>
                                <span>616 Av. St-Redempteur</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <span>Ville :</span>
                                <span>Matane</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <span>Provaince :</span>
                                <span>Québec</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <span>Code postal :</span>
                                <span>G4W 0H2</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <span>Pays :</span>
                                <span>Canada</span>
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
        <?php
        if($page->isConnected == true){
        ?>

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
            <?php
          }else {
            ?>
            <div class="row mb-3 text-center">
                <div class="col-md-12 align-self-end">
                    <div class="row mb-2">
                        <div class="col-md-12">
                            <a href="#" class="btn btn-outline-primary">Se Connecter</a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <a href="#" class="btn btn-outline-primary">S'inscrire</a>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            }
             ?>

    </div>

    <?php

}
