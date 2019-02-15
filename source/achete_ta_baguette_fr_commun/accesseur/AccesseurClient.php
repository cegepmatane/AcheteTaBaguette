<?php

require_once "BaseDeDonnee.php";
class AccesseurClient
{

    private $AJOUTER_UTILISATEUR =
        "INSERT INTO CLIENT(nom, prenom,naissance,email,motDePasse,rue,ville,province,codePostal,pays) VALUES (?,?,?,?,?,?,?,?,?,?)";

    private static $SUPPRIMER_CLIENT =
        "DELETE FROM CLIENT WHERE idClient = ?";

    private static $MISE_A_JOUR_UTILISATEUR =
        "UPDATE CLIENT SET nomClient = ?, adresse = ?, email = ?) WHERE idClient = ?;";

    private static $GET_ID_UTILISATEUR =
        "SELECT idClient FROM CLIENT WHERE nomClient = ?, adresse = ?, email = ?";

        
    private static $connexion = null;

    public function __construct()
    {
        if (!self::$connexion) {
            self::$connexion = BaseDeDonnee::getConnexion();
        }
    }

    public function ajouterClient( object $client)
    {
        $requete = self::$connexion->prepare($this->AJOUTER_UTILISATEUR);
        $requete->bindValue(1, $client->nom, PDO::PARAM_STR);
        $requete->bindValue(2, $client->prenom, PDO::PARAM_STR);
        $newdate = date('Y-m-d', strtotime($client->date_de_naissance));
        $requete->bindValue(3, $newdate, PDO::PARAM_STR);
        $requete->bindValue(4, $client->email, PDO::PARAM_STR);
        $requete->bindValue(5, sha1($client->mot_de_passe), PDO::PARAM_STR);
        $requete->bindValue(6, $client->rue, PDO::PARAM_STR);
        $requete->bindValue(7, $client->ville, PDO::PARAM_STR);
        $requete->bindValue(8, $client->province, PDO::PARAM_STR);
        $requete->bindValue(9, $client->code_postal, PDO::PARAM_STR);
        $requete->bindValue(10, $client->pays, PDO::PARAM_STR);

        return $requete->execute();

    }

    public function supprimerClient($client)
    {
        $requete = self::$connexion->prepare($this->SUPPRIMER_CLIENT);
        $requete->bindValue(1, $client->getidClient);

        $requete->execute();

        if ($requete->rowCount() > 0) {
            return true;
        }

        return false;
    }

    public function getIdClient(object $client)
    {
        $requete = self::$connexion->prepare($this->GET_ID_UTILISATEUR);
        $requete->bindValue(1, $client->nom, PDO::PARAM_STR);
        $requete->bindValue(2, $client->adresse, PDO::PARAM_STR);
        $requete->bindValue(3, $client->email, PDO::PARAM_STR);

        $requete->execute();

        if ($requete->rowCount() > 0) {
            $reponse = $requete->fetch();
            if (!is_array($reponse)) {
                echo "Erreur getidClient (AccesseurCLIENT.php) !";
            }
            if (is_array($reponse)) {
                return $reponse["idClient"];
            }
        }
    }

    public function miseAJourClient($client)
    // Va mettre à jour dans le base de données le CLIENT correspondant à l'id du CLIENT passé en paramètre
    // Le CLIENT de la base de données prendra les valeurs des attributs du CLIENT passé en paramètre
    {
        $requete = self::$connexion->prepare($this->MISE_A_JOUR_UTILISATEUR);
        $requete->bindValue(1, $client->nom, PDO::PARAM_STR);
        $requete->bindValue(2, $client->adresse, PDO::PARAM_STR);
        $requete->bindValue(3, $client->email, PDO::PARAM_STR);
        $requete->bindValue(5, getidClient($client), PDO::PARAM_STR);

        $requete->execute();

        if ($requete->rowCount() > 0) {
            return true;
        }

        return false;

    }

}
