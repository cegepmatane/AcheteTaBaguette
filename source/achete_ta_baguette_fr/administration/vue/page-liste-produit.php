<?php
require_once($_SERVER['CONFIGURATION_COMMUN']);
require_once(CHEMIN_RACINE_COMMUN . "/accesseur/AccesseurProduit.php");
require_once(CHEMIN_RACINE_COMMUN . "/accesseur/AccesseurCategorie.php");

function afficherContenu($page = null) {
    if(!is_object($page)) return;
    $laBDD = new AccesseurProduit();
    $laBDD2 = new AccesseurCategorie();
    $listeProduits = $laBDD-> recupererListeProduits();
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
      <th  scope="col">Stock</th>
	  <th  scope="col">Modifier</th>
	  <th  scope="col">Supprimer</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($listeProduits as $value) { ?>
       <tr>
      <td><input type="image" src="../illustration/add-image.png" /></td>
      <td> <?php echo $laBDD2->recupererCategorieParId((int)$value->getIdCategorie()); ?> </td>
      <td> <?php echo $value->getNom();?></td>
      <td> <?php echo $value->getDescription();?></td>
      <td> <?php echo "".$value->getStock()."";?></td>
      <td> <input type="image" src="../illustration/edit.png" /></td>
      <td> <input type="image" src="../illustration/trash.png" /></td>
    </tr>;
    <?php } ?>
    
    
    
   </tbody>
</table>


<table class="table ">
				<thead>
			<tr>
      <th  scope="col">Image</th>
	  <th  scope="col">Cat&eacute;gorie</th>
      <th  scope="col">Produit</th>
      <th  scope="col">Description</th>
      <th  scope="col">Stock</th>
	  <th  scope="col"></th>
	  
    </tr>
  </thead>
  <tbody>
    <tr>
      <td><input type="image" src="../illustration/add-image.png" /></td>
      <td ><input type="text" class="form-control" id="usr"></td>
	  <td ><input type="text" class="form-control" id="usr"></td>
      <td><input type="text" class="form-control" id="usr"></td>
	  <td><input type="text" class="form-control" id="usr"></td>
	  <td ><input type="image" src="../illustration/add.png" /></td>
	  
    </tr>
    
  </tbody>
</table>
             

            </div><!-- Fin du contenu -->

         
            
        </div><!-- Fin centre de page -->

        <?php
}
    ?>
