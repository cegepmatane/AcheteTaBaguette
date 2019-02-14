<?php

require_once "C:\wamp64\www\AcheteTaBaguette\AcheteTaBaguette\source\achete_ta_baguette_fr_commun\configuration\configuration.php";

// https://phpdelusions.net/pdo
class BaseDeDonnee
{

    private static $pdo = null;
    private static $isInitialise = false;
    public static function getConnexion()
    {

        if (!self::$pdo) {
            $host = BASE_DE_DONNEE_HOST;
            $db = BASE_DE_DONNEE_NOM;
            $user = BASE_DE_DONNEE_UTILISATEUR;
            $pass = BASE_DE_DONNEE_MOT_DE_PASSE;
            $charset = BASE_DE_DONNEE_CHARSET;

            $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
                PDO::ATTR_EMULATE_PREPARES => false,
            ];
            try {
                    self::$pdo = new PDO($dsn, $user, $pass, $options);
            } catch (\PDOException $e) {
                throw new \PDOException($e->getMessage(), (int) $e->getCode());
            }self::$isInitialise = true;
        }

        return self::$pdo;
    }
}
