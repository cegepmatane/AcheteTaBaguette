<?php

require_once (CHEMIN_RACINE_COMMUN . "/accesseur/BaseDeDonnee.php");
require_once(CHEMIN_RACINE_COMMUN . "/modele/Client.class.php");

class AccesseurClient
{

    private $AJOUTER_UTILISATEUR =
        "INSERT INTO CLIENT(nom, prenom,naissance,email,motDePasse,rue,ville,province,codePostal,pays) VALUES (?,?,?,?,?,?,?,?,?,?)";

    private static $SUPPRIMER_CLIENT =
        "DELETE FROM CLIENT WHERE idClient = ?";

    private static $MISE_A_JOUR_UTILISATEUR =
        "UPDATE CLIENT SET nomClient = ?, adresse = ?, email = ?) WHERE idClient = ?;";

    private static $GET_UTILISATEUR_PAR_ID =
        "SELECT nom, prenom, naissance, email, motDePasse, rue, ville, province, codePostal, pays, administrateur FROM CLIENT WHERE idClient like ?;";

    private static $GET_UTILISATEUR_PAR_EMAIL =
        //Remplacer idClient par id ?
        "SELECT idClient, motDePasse, administrateur FROM CLIENT WHERE email like ?;";


    private static $connexion = null;

    public function __construct()
    {
        if (!self::$connexion) {
            self::$connexion = BaseDeDonnee::getConnexion();
        }
    }

    public function ajouterClient(object $client)
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

    public function getClientParId($idClient)
    {
        $requete = self::$connexion->prepare(self::$GET_UTILISATEUR_PAR_ID);
        $requete->bindValue(1, $idClient);

        $requete->execute();

        if ($requete->rowCount() > 0) {
            $reponse = $requete->fetch();
            return $reponse;
        } else {
            echo "Aucune données trouvés !";
            return $reponse = ["isConnected" => false];
        }
    }

    public function miseAJourClient($client)
    {
        $requete = self::$connexion->prepare($this->MISE_A_JOUR_UTILISATEUR);
        $requete->bindValue(3, $client->email, PDO::PARAM_STR);

        $requete->execute();

        if ($requete->rowCount() > 0) {
            return true;
        }

        return false;

    }

    public function verifierClient($client)
    {
        $requete = "SELECT idClient, motDePasse, administrateur FROM CLIENT WHERE email = '$client->email' ORDER BY idClient DESC LIMIT 1";
        $stmt = self::$connexion->query($requete);
        $resultat = $stmt->fetch();
        if ($stmt->execute()) {
            while ($row = $stmt->fetch()) {
                if(sha1($client->motDePasse) == print_r($row->motDePasse, true)) {
                    $resultat->idClient = print_r($row->idClient, true);
                    $resultat->motDePasse = print_r($row->motDePasse, true);
                    $resultat->administrateur = print_r($row->administrateur, true);
                }
            }
        }
        return $resultat;
    }
}
