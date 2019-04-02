  <?php

  require_once("../../commun/vue/entete-fragment.php");
  require_once("../../commun/vue/pied-de-page-fragment.php");
  require_once("page-liste-produit.php");
  require_once(CHEMIN_RACINE_ADMINISTRATION . "/action/action-page-liste-produit.php");


  afficherEntete($page);

  ?>
  <!-- Centre de page -->

  <div class="row mb-3 text-center">
    <!-- Contenu -->
    <div class="col">

      <table class="table "><!-- Table produits -->

        <thead> <!--  Intitulés des colonnes -->
          <tr>
            <th  scope="col">Image</th>
            <th  scope="col">Catégorie</th>
            <th  scope="col">Produit</th>
            <th  scope="col">Description</th>
            <th  scope="col">Prix</th>
            <th  scope="col">Stock</th>
            <th  scope="col">Modifier</th>
            <th  scope="col">Supprimer</th>
          </tr>
        </thead><!-- Fin Intitulés des colonnes -->

        <tbody> <!--  Affichage liste de produits existants ( lignes du tableau ) -->
         <?php foreach ($page->listeProduits as $produit) {?> 


          <tr>
            <td><input type="image" src="illustration/add-image.png" /></td>
            <td> <?=  recupererLabelCategorieParProduit($page, $produit); ?> </td>
            <td> <?= $produit->getNom(); ?></td>
            <td> <?=  $produit->getDescription(); ?></td>
            <td> <?=  $produit->getPrix(); ?></td>
            <td> <?=  "" .$produit->getStock() . ""; ?></td>
            <td> <a href="modifier/<?= $produit->getIdproduit(); ?>">Modifier</a></td>
            <td> <form method="post" action="index.php">
              <input type="submit" src="../illustration/trash.png"  name="action-supprimer-produit" id="button" value="bar"></input>
              <input type="hidden" name="idProduit" value="<?= $produit->getIdProduit(); ?>"></input>
            </form ></td>
          </tr>

        <?php }?>
      </tbody> <!--  Fin Affichage liste de produits existants ( lignes du tableau ) -->
    </table> <!-- Fin Table produits -->

    <form method="post" enctype="multipart/form-data">  <!-- Formulaire ajout produit -->
      <table class="table ">  <!-- Tableau ajout produit -->
        <thead><!--  Intitulés des colonnes -->
          <tr>
            <th scope="col">Image</th>
            <th scope="col">Cat&eacute;gorie</th>
            <th scope="col">Produit</th>
            <th scope="col">Description</th>
            <th scope="col">Prix</th>
            <th scope="col">Stock</th>
            <th scope="col"></th>
          </tr>
        </thead><!-- Fin  Intitulés des colonnes -->

        <tbody><!-- Affichage des chammps pour l'ajout -->
          <tr>
            <td>
              <div class="container">
                <div class="col-md-6">
                  <div class="form-group">
                    <div class="input-group">
                      <input type="file" name="image"/>
                    </div>
                    <img id='img-upload'/>
                  </div>
                </div>
              </div>
            </form>
          </div>
          <img id='img-upload'/>
        </div>
      </div>
    </div>
  </div>


  <td>  
    <select class="custom-select" name="<?= PRODUIT::ID_CATEGORIE ?>"  >
      <option value="" selected disabled hidden>Choisir catégorie</option>
      <?php foreach ($page->listeCategorie as $categorie) {?>
       <option value= "<?= $categorie->getIdCategorie() ?>"> <?= $categorie->getLabel() ?></option>
     <?php }?>
    </select>
 </td>

 <td><input type="text" class="form-control"  name=" <?= PRODUIT::NOM ?>"></td>
 <td><input type="text" class="form-control"  name=" <?= PRODUIT::DESCRIPTION ?>"></td>
 <td><input type="text" class="form-control"  name=" <?= PRODUIT::PRIX ?>"></td>
 <td><input type="text" class="form-control" name="  <?=PRODUIT::STOCK ?>"></td>
 <td><input  class="add" type="submit" src="../illustration/add.png" name="action-ajouter-produit"/></td>
</tr>

</tbody> <!-- FIN Affichage des chammps pour l'ajout -->
</table>
</form>
</div><!-- Fin du contenu -->
</div><!-- Fin centre de page -->
<?php afficherPiedDePage($page);
  // EOF