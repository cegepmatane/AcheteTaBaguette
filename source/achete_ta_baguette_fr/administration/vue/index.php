<?php

require_once("../../commun/vue/entete-fragment.php");
require_once("page-liste-produit.php");
require_once("../../commun/vue/pied-de-page-fragment.php");
require_once(CHEMIN_RACINE_ADMINISTRATION . "/action/action-page-liste-produit.php");

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

                <thead>
        <tr>
      <th  scope="col">Image</th>
        <th  scope="col">Cat&eacute;gorie</th>
      <th  scope="col">Produit</th>
      <th  scope="col">Description</th>
      <th  scope="col">Prix</th>
      <th  scope="col">Stock</th>
        <th  scope="col">Modifier</th>
        <th  scope="col">Supprimer</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($page->listeProduits as $produit) {?>
    <tr>
      <td><input type="image" src="illustration/add-image.png" /></td>
      <td> <?=  recupererLabelCategorieParProduit($page, $produit); ?> </td>
      <td> <?= $produit->getNom(); ?></td>
      <td> <?=  $produit->getDescription(); ?></td>
      <td> <?=  $produit->getPrix(); ?></td>
      <td> <?=  "" .$produit->getStock() . ""; ?></td>
      <td> <input type="image" src="illustration/edit.png"  /></td>
      <td> <input type="image" src="illustration/trash.png" onclick="insert()" /></td>
    </tr>
    <?php }?>
   </tbody>
</table>

 <form method="post">
<table class="table ">
                <thead>
            <tr>
      <th  scope="col">Image</th>
      <th  scope="col">Cat&eacute;gorie</th>
      <th  scope="col">Produit</th>
      <th  scope="col">Description</th>
      <th  scope="col">Prix</th>
      <th  scope="col">Stock</th>
      <th  scope="col"></th>

    </tr>
  </thead>
  <tbody>
    <tr>
      <td><input type="image" src="illustration/add-image.png" name="image" /></td>
      <td ><input type="text" class="form-control"  name="categorie"></td>
      <td ><input type="text" class="form-control"  name="produit"></td>
      <td><input type="text" class="form-control"  name="description"></td>
           <td><input type="text" class="form-control"  name="prix"></td>
      <td><input type="text" class="form-control" name="stock"></td>
      <td ><input type="submit" src="illustration/add.png" name="envoi"/></td>

    </tr>

  </tbody>
</table>
 </form>
</div><!-- Fin du contenu -->
</div><!-- Fin centre de page -->
        <?php afficherPiedDePage($page);
// EOF