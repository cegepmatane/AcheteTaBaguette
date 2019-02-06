<?php

require_once("BaseDeDonnee.php");
require_once("../modele/Produit.php");

class AccesseurProduit {

    private static $SUBTITUT_ID_ENTITE_AFFAIRE = ":" .
                   EntiteAffaire::ID_ENTITE_AFFAIRE;

    private static $SUBTITUT_CHAMP_A = ":" .
                   EntiteAffaire::CHAMP_A;

    private static $SUBTITUT_CHAMP_B = ":" .
                   EntiteAffaire::CHAMP_B;

    private static $SUBTITUT_CHAMP_C = ":" .
                   EntiteAffaire::CHAMP_C;


    private static $RECUPERER_ENTITE_AFFAIRE_SQL =
        "SELECT " .
        EntiteAffaire::ID_ENTITE_AFFAIRE . "," .
        EntiteAffaire::CHAMP_A . "," .
        EntiteAffaire::CHAMP_B . "," .
        EntiteAffaire::CHAMP_C . " " .
        "FROM table_entite_affaire " .
        "WHERE " .
        EntiteAffaire::ID_ENTITE_AFFAIRE . "=" .
        self::$SUBTITUT_ID_ENTITE_AFFAIRE;

    private static $RECUPERER_LISTE_ENTITE_AFFAIRE_SQL =
        "SELECT " .
        EntiteAffaire::ID_ENTITE_AFFAIRE . "," .
        EntiteAffaire::CHAMP_A . "," .
        EntiteAffaire::CHAMP_B . "," .
        EntiteAffaire::CHAMP_C . " " .
        "FROM table_entite_affaire";

    private static $SUPPRIMER_ENTITE_AFFAIRE_SQL =
        "DELETE FROM table_entite_affaire " .
        "WHERE " .
        EntiteAffaire::ID_ENTITE_AFFAIRE . "=" .
        self::$SUBTITUT_ID_ENTITE_AFFAIRE;

    private static $MODIFIER_ENTITE_AFFAIRE_SQL =
        "UPDATE table_entite_affaire " .
        "SET " .
        EntiteAffaire::CHAMP_A . "=" . $SUBTITUT_CHAMP_A
        EntiteAffaire::CHAMP_B . "=" . $SUBTITUT_CHAMP_B
        EntiteAffaire::CHAMP_C . "=" . $SUBTITUT_CHAMP_C . " " .
        "WHERE " .
        EntiteAffaire::ID_ENTITE_AFFAIRE . "=" .
        self::$SUBTITUT_ID_ENTITE_AFFAIRE;

    private static $AJOUTER_ENTITE_AFFAIRE_SQL =
        "INSERT INTO table_entite_affaire " .
        "SET " .
        EntiteAffaire::CHAMP_A . "=" . $SUBTITUT_CHAMP_A
        EntiteAffaire::CHAMP_B . "=" . $SUBTITUT_CHAMP_B
        EntiteAffaire::CHAMP_C . "=" . $SUBTITUT_CHAMP_C . " " .
        "WHERE " .
        EntiteAffaire::ID_ENTITE_AFFAIRE . "=" .
        self::$SUBTITUT_ID_ENTITE_AFFAIRE;

    private static $connexion = null;

    function __construct(){

        if(!self::$connexion) self::$connexion =  BaseDeDonnee::getConnexion();
    }

    public function recupererEntiteAffaire($entiteAffaire){

        $id_entite_affaire =
            $entiteAffaire->getId_entite_affaire() ?? return false;

        if(!$entiteAffaire->isValide(EntiteAffaire::ID_ENTITE_AFFAIRE))
            return false;

        $requete = $connexion->prepare(self::$RECUPERER_ENTITE_AFFAIRE_SQL);

        $requete->bindValue(
            self::$SUBTITUT_ID_ENTITE_AFFAIRE,
            $id_entite_affaire,
            PDO::PARAM_INT);

        $requete->execute();

        return new EntiteAffaire($requete->fetchObject());

    }

    public function recupererListeEntiteAffaire(){

        $listeEntiteAffaire = [];

        $requete =
            $connexion->prepare(self::$RECUPERER_LISTE_ENTITE_AFFAIRE_SQL);

        $requete->execute();

        $listeEnregistrement = $requete->fetchAll(PDO::FETCH_OBJ);

        foreach($listeEnregistrement as $enregistrement) {

            $listeEntiteAffaire[] = new EntiteAffaire($enregistrement);

        }

        return $listeEntiteAffaire;

    }

    public function supprimerEntiteAffaire($entiteAffaire){

        $id_entite_affaire =
            $entiteAffaire->getId_entite_affaire() ?? return false;

        if(!$entiteAffaire->isValide(EntiteAffaire::ID_ENTITE_AFFAIRE))
            return false;

        $requete = $connexion->prepare(self::$SUPPRIMER_ENTITE_AFFAIRE_SQL);

        $requete->bindValue(
            self::$SUBTITUT_ID_ENTITE_AFFAIRE,
            $id_entite_affaire,
            PDO::PARAM_INT);

        $requete->execute();

        return $requete->rowCount() > 0;

    }

    public function modifierEntiteAffaire($entiteAffaire){

        $id_entite_affaire =
            $entiteAffaire->getId_entite_affaire() ?? return false;

        if(!$entiteAffaire->isValide()) return false;

        $requete = $connexion->prepare(self::$MODIFIER_ENTITE_AFFAIRE_SQL);

        $requete->bindValue(
            self::$SUBTITUT_ID_ENTITE_AFFAIRE,
            $id_entite_affaire,
            PDO::PARAM_INT);

        $requete->bindValue(
            self::$SUBTITUT_CHAMP_A,
            $entiteAffaire->getChamp_A(),
            PDO::PARAM_STR);

        $requete->bindValue(
            self::$SUBTITUT_CHAMP_B,
            $entiteAffaire->getChamp_B(),
            PDO::PARAM_STR);

        $requete->bindValue(
            self::$SUBTITUT_CHAMP_C,
            $entiteAffaire->getChamp_C(),
            PDO::PARAM_STR);

        $requete->execute();

        return $requete->rowCount() > 0;

    }

    public function ajouterEntiteAffaire($entiteAffaire){

        $valide = $entiteAffaire->isValide() ?? return false;

        if(!$valide) return false;

        $requete = $connexion->prepare(self::$MODIFIER_ENTITE_AFFAIRE_SQL);

        $requete->bindValue(
            self::$SUBTITUT_ID_ENTITE_AFFAIRE,
            $id_entite_affaire,
            PDO::PARAM_INT);

        $requete->bindValue(
            self::$SUBTITUT_CHAMP_A,
            $entiteAffaire->getChamp_A(),
            PDO::PARAM_STR);

        $requete->bindValue(
            self::$SUBTITUT_CHAMP_B,
            $entiteAffaire->getChamp_B(),
            PDO::PARAM_STR);

        $requete->bindValue(
            self::$SUBTITUT_CHAMP_C,
            $entiteAffaire->getChamp_C(),
            PDO::PARAM_STR);

        $requete->execute();

        if($requete->rowCount() > 0){

            $entiteAffaire->setId_entite_affaire($connexion->lastInsertId());
            return $entiteAffaire;

        }

        return false;

    }

}

// EOF
