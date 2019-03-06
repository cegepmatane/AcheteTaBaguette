<?php

require_once "entete-fragment-admin.php";
require_once "page-liste-produit.php";
require_once "pied-de-page-fragment.php";
require_once CHEMIN_RACINE_ADMINISTRATION . "/action/action-produit.php";

/*
Un tableau associatif en clé valeur permet de définir les éléments dynamiques
de la page qui ne sont pas en lien avec les données du modèle. En le changeant
de type en (object), il est plus facilement utilisable par l'IDE et permet les
suggestions automatiques des attributs de l'objet.
 */


/*
La fonction afficherPage produit le code HTML de la page d'accueil.
Le paramètre $page permet aux fragments de page inclus d'utiliser les
éléments dynamiques propres à la page d'accueil.
 */

      







    // En cas d'erreur avec le paramètre $page, un objet $page vide est créé.
    // if (!is_object($page)) {
    //     $page = (object) [];
    // }

      

    afficherEntete($page);


    //            if (!is_object($page)) {
    //     return;
    // }
    
   
    
    ?>
        <!-- Centre de page -->

  <div class="row mb-3 text-center">
            <!-- Contenu -->
  <div class="col">

  <form action="action.php" method="post">
    <p>Nom : <input type="text" name="nom" value="eee" /></p>
    <p>Description : <input type="text" name="description" value="eee" /></p>
    <p>Prix : <input type="float" name="prix" value="eee" /></p>
    <p>Stock : <input type="int" name="stock" value="eee" /></p>
    <p>Numéro de la catégorie associée : <input type="int" name="idCategorie" value="eee" /></p>
    <p>Chemin de l'image associée : <input type="text" name="srcImage" value="eee" /></p>
    <p><input type="submit" value="OK"></p>
  </form>

</div><!-- Fin du contenu -->
</div><!-- Fin centre de page -->





        <?php afficherPiedDePage($page);




// EOF