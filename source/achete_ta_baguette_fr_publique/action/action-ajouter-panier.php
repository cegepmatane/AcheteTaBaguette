<?php
/**
 * Created by PhpStorm.
 * User: AlexandreCM
 * Date: 2019-03-07
 * Time: 13:42
 */

if (isset($_POST['ajout-au-panier']))
{
    if (!isset($_SESSION[Client::EMAIL])) header("location: /connexion");







}
