<?php

function afficherContenu($page = null) {
    if(!is_object($page)) return;
?>
        <!-- Centre de page -->
        <div class="row mb-3 text-center">

           

            <!-- Contenu -->
            <div class="col">

			<table class="table ">
				<thead>
			<tr>
      <th  scope="col">Image</th>
	  <th  scope="col">Catégorie</th>
      <th  scope="col">Produit</th>
      <th  scope="col">Description</th>
      <th  scope="col">Stock</th>
	  <th  scope="col">Modifier</th>
	  <th  scope="col">Supprimer</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td><input type="image" src="../illustration/add-image.png" /></td>
      <td >Baguette</td>
	  <td >Baguette classique</td>
      <td >rfedfuhdruhurhduhvaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaifguhdviudhiuhv</td>
	  <td>12</td>
	  <td ><input type="image" src="../illustration/edit.png" /></td>
	  <td ><input type="image" src="../illustration/trash.png" /></td>
    </tr>

	    <tr>
      <td><input type="image" src="../illustration/add-image.png" /></td>
      <td >Baguette</td>
	  <td >Baguette classique</td>
      <td >rfedfuhdruhurhduhvaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaifguhdviudhiuhv</td>
	  <td>12</td>
	  <td ><input type="image" src="../illustration/edit.png" /></td>
	  <td ><input type="image" src="../illustration/trash.png" /></td>
    </tr>

        <tr>
      <td><input type="image" src="../illustration/add-image.png" /></td>
      <td >Baguette</td>
	  <td >Baguette classique</td>
      <td >rfedfuhdruhurhduhvaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaifguhdviudhiuhv</td>
	  <td>12</td>
	  <td ><input type="image" src="../illustration/edit.png" /></td>
	  <td ><input type="image" src="../illustration/trash.png" /></td>
    </tr>

        <tr>
      <td><input type="image" src="../illustration/add-image.png" /></td>
      <td >Baguette</td>
	  <td >Baguette classique</td>
      <td >rfedfuhdruhurhduhvaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaifguhdviudhiuhv</td>
	  <td>12</td>
	  <td ><input type="image" src="../illustration/edit.png" /></td>
	  <td ><input type="image" src="../illustration/trash.png" /></td>
    </tr>

        <tr>
      <td><input type="image" src="../illustration/add-image.png" /></td>
      <td >Baguette</td>
	  <td >Baguette classique</td>
      <td >rfedfuhdruhurhduhvaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaifguhdviudhiuhv</td>
	  <td>12</td>
	  <td ><input type="image" src="../illustration/edit.png" /></td>
	  <td ><input type="image" src="../illustration/trash.png" /></td>
    </tr>

        <tr>
      <td><input type="image" src="../illustration/add-image.png" /></td>
      <td >Baguette</td>
	  <td >Baguette classique</td>
      <td >rfedfuhdruhurhduhvaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaifguhdviudhiuhv</td>
	  <td>12</td>
	  <td ><input type="image" src="../illustration/edit.png" /></td>
	  <td ><input type="image" src="../illustration/trash.png" /></td>
    </tr>
    
  </tbody>
</table>


<table class="table ">
				<thead>
			<tr>
      <th  scope="col">Image</th>
	  <th  scope="col">Catégorie</th>
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