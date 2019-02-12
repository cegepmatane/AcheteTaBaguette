<?php

function afficherPiedDePage($page = null) {
    if(!is_object($page)) return;
?>

        <!-- Pied de page -->
        <div class="row mt-4">
            <div class="col-md-12 bg-primary">
            
                <footer class="footer">

                    <!-- contenu footer -->
                    <div class="row pt-4 justify-content-around align-items-center"> 

                        <!-- Adresse -->
                        <div class="col-md-2">
                            <a  alt="Adresse" href="https://www.google.ca/maps/place/Rue+Saint+Antoine,+Saint-Jean-sur-Richelieu,+QC,+Canada/@45.276341,-73.2546747,17z/data=!3m1!4b1!4m5!3m4!1s0x4cc9a281ec4537ab:0xa60b61f4cc5beeb4!8m2!3d45.2763372!4d-73.252486">
                                <img 
                                alt="Achete ta baguette" 
                                src="/commun/illustration/adresse.png"
                                class="img-fluid"
                                href="https://www.w3schools.com/html/"
                                />
                            </a>
                        </div>

                        <!-- Nom site -->
                        <div class="col-md-3">
                            <img 
                            alt="Achete ta baguette" 
                            src="/commun/illustration/achete.png"
                            class="img-fluid"
                            href="https://www.w3schools.com/html/"
                            />
                        </div>

                        <!-- GoogleMaps -->
                        <div class="col-md-2">
                                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d969375.0014612963!2d-73.48320803120802!3d45.04924948487961!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4cc9a281ec4537ab%3A0xa60b61f4cc5beeb4!2sRue+Saint+Antoine%2C+Saint-Jean-sur-Richelieu%2C+QC!5e0!3m2!1sfr!2sca!4v1549935431409" frameborder="0" style="border:0" allowfullscreen></iframe>
                        </div>

                    </div>
                        
                    <!-- Credits -->
                    <div class="row">
                        <div class="col-md-12">
                            <p class="text-center text-light">Site réalisé dans le cadre d'un projet Web au Cégep de Matane 2019 &copy AcheteTaBaguette </p>
                        </div>
                    </div>
                        
                </footer>
            </div>
        </div><!-- Fin pied de page -->

    </div><!-- Fin container -->
  </body>
</html>

<?php
}