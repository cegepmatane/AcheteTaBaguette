<?php

require_once("../../commun/vue/entete-fragment.php");
require_once("../../commun/vue/pied-de-page-fragment.php");
require_once "page-liste-produit.php";
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

afficherEntete($page);

?>
<!-- Centre de page -->

<div class="row mb-3 text-center">
  <!-- Contenu -->
  <div class="col">

    <table class="table "> 
      <form action="action-produit.php" method="post">
        <tr>
          <th  scope="col">Image</th>
          <th  scope="col">Cat&eacute;gorie</th>
          <th  scope="col">Produit</th>
          <th  scope="col">Description</th>
          <th  scope="col">Prix</th>
          <th  scope="col">Stock</th>
          <th  scope="col"></th>
        </tr>
        <tr>
          <td><input type="image" src="illustration/add-image.png" /></td>
          <td><input type="text" class="form-control" name="categorie" value="<?= $produit->idCategorie ?>"></td>
          <td><input type="text" class="form-control" name="produit" value="<?= $produit->nom ?>"></td>
          <td><input type="text" class="form-control" name="description" value="<?= $produit->description ?>"></td>
          <td><input type="text" class="form-control" name="prix" value="<?= $produit->prix ?>"></td>
          <td><input type="text" class="form-control" name="stock" value="<?= $produit->stock ?>"></td>
          <td ><input  class="add" type="submit" src="../illustration/add.png" name="action-modifier-produit"/></td>
        </tr>
      </form>
    </table>

  </div><!-- Fin du contenu -->
</div><!-- Fin centre de page -->


<?php afficherPiedDePage($page);

// EOF