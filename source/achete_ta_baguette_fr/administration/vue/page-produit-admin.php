<?php

require_once("../../commun/vue/entete-fragment.php");
require_once("../../commun/vue/pied-de-page-fragment.php");
require_once "page-liste-produit.php";
require_once CHEMIN_RACINE_ADMINISTRATION . "/action/action-produit.php";


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
          <th  scope="col">Catégorie</th>
          <th  scope="col">Produit</th>
          <th  scope="col">Description</th>
          <th  scope="col">Prix</th>
          <th  scope="col">Stock</th>
          <th  scope="col"></th>
        </tr>
        <tr>
          <td><img src="/publique/illustration/<?= $produit->getSrcImage() ?>" alt="produit" height="50"></td>
          <td><input type="text" class="form-control" name="categorie" value="<?= $produit->getCategorie() ?>"></td>
          <td><input type="text" class="form-control" name="produit" value="<?= $produit->getNom() ?>"></td>
          <td><input type="text" class="form-control" name="description" value="<?= $produit->getDescription() ?>"></td>
          <td><input type="text" class="form-control" name="prix" value="<?= $produit->getPrix() ?>"></td>
          <td><input type="text" class="form-control" name="stock" value="<?= $produit->getStock() ?>"></td>
          <td><input class="add" type="submit" src="../illustration/add.png" name="action-modifier-produit"/></td>
        </tr>
      </form>
    </table>

  </div><!-- Fin du contenu -->
</div><!-- Fin centre de page -->


<?php afficherPiedDePage($page);

// EOF