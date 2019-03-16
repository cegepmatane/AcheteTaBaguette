<?php
require_once(CHEMIN_RACINE_COMMUN . "/accesseur/AccesseurProduit.php");
require_once(CHEMIN_RACINE_COMMUN . "/accesseur/AccesseurCategorie.php");

function afficherContenu($page = null) {
    if(!is_object($page)) return;

    $laBDD = new AccesseurProduit();
    switch ($page->itemMenuActif) {
        case 'baguette':
            $listeProduits = $laBDD-> recupererProduitParType(1);
            break;
        case 'viennoiserie':
             $listeProduits = $laBDD-> recupererProduitParType(2);
            break;
        case 'autre':
             $listeProduits = $laBDD-> recupererProduitParType(3);
            break;
        default:
            $listeProduits = $laBDD-> recupererListeProduits();
            break;
    }
    
?>
    <div class="row justify-content-md-center">

     <?php foreach ($listeProduits as $value) { ?>
        <div class="col-md-2 m-2 border">
            <a href="/boutique/produit/<?php echo $value->getIdProduit(); ?>">
                <div class="row">
                    <div class="col-md-12">
                        <img
                        src="/publique/illustration/<?php echo $value->getSrcImage(); ?>"
                        alt="produit"
                        class="img-fluid imageProduit"
                        />
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <span class="nomProduit"><strong><?php echo $value->getNom(); ?></strong></span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 text-right">
                        <span class="unitePrixProduit">CDN$</span>
                        <span class="prixProduit label-primary"><?php echo $value->getPrix(); ?></span>
                    </div>
                </div>
            </a>
        </div>
     <?php } ?>
    
     </div>

        <?php
}
    ?>
