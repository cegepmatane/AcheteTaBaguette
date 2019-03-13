<?php

require_once("../../commun/vue/entete-fragment.php");
require_once("../../commun/vue/pied-de-page-fragment.php");
require_once("page-liste-produit.php");
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
              <td> <a href="page-produit-admin.php?idProduit=<?= $produit->getIdproduit(); ?>">Modifier</a></td>
              <td> <form method="post" action="index.php">
                <input type="submit" src="../illustration/trash.png"  name="action-supprimer-produit" id="button" value="bar"></input>
                <input type="hidden" name="idProduit" value="<?= $produit->getIdProduit(); ?>"></input>
            </form ></td>
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
          <td>
            <div class="container">
<div class="col-md-6">
    <div class="form-group">
        <label>Upload Image</label>
        <div class="input-group">
            <span class="input-group-btn">
                <span class="btn btn-default btn-file">
                    Browse… <input type="file" id="imgInp">
                </span>
            </span>
            <input type="text" class="form-control" readonly>
        </div>
        <img id='img-upload'/>
    </div>
</div>
</div>
</div>

           <!--  <input type="image" src="illustration/add-image.png" name="image" /></td> -->
          <!--  <td ><input type="text" class="form-control"  name="categorie"></td> -->
          <td>  <select class="custom-select" name="categorie"  >
              <option value="" selected disabled hidden>Choisir catégorie</option>
              <?php foreach ($page->listeCategorie as $categorie) {?>
                 <option value= "<?= $categorie->getIdCategorie() ?>"> <?= $categorie->getLabel() ?></option>
             <?php }?>

         </select></td>
         <td ><input type="text" class="form-control"  name="produit"></td>
         <td><input type="text" class="form-control"  name="description"></td>
         <td><input type="text" class="form-control"  name="prix"></td>
         <td><input type="text" class="form-control" name="stock"></td>
         <td ><input  class="add" type="submit" src="../illustration/add.png" name="action-ajouter-produit"/></td>
     </tr>

 </tbody>
</table>
</form>
</div><!-- Fin du contenu -->
</div><!-- Fin centre de page -->
<?php afficherPiedDePage($page);
// EOF