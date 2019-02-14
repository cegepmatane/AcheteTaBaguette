<?php
function afficherErreurInscription($erreur)
{
    ?>

    <?php
    foreach ($erreur as $uneErreur => $value) {
        ?>
        <div class="alert alert-primary" role="alert">
            <?php $value ?>
        </div>
        <?php
    }

}
