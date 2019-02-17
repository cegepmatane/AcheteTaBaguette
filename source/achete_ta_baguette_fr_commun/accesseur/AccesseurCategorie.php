<?php

require_once CHEMIN_RACINE_COMMUN . "/accesseur/BaseDeDonnee.php";
require_once CHEMIN_RACINE_COMMUN . "/modele/Categorie.class.php";

class AccesseurCategorie
{

    private static $RECUPERER_CATEGORIE_PAR_ID =
        "SELECT * " .
        "FROM CATEGORIE " .
        "WHERE " .
        "idCategorie" . "= :idCategorie"
    ;

    private static $connexion = null;

    public function __construct()
    {
        if (!self::$connexion) {
            self::$connexion = BaseDeDonnee::getConnexion();
        }
    }

    public function recupererCategorieParId($idCategorie)
    {

        $requete = self::$connexion->prepare(self::$RECUPERER_CATEGORIE_PAR_ID);

        $requete->bindValue(
            ':idCategorie',
            $idCategorie,
            PDO::PARAM_INT);

        $requete->execute();

        if ($requete->rowCount() > 0) {
            $reponse = $requete->fetch();
            return $reponse->label;
        } else {
            echo "Aucune données trouvés !";
            return $reponse = ["isConnected" => false];
        }

    }

}
