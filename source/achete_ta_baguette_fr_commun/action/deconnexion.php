<?php
/**
 * Created by PhpStorm.
 * User: yonne
 * Date: 18/02/2019
 * Time: 16:44
 */

session_start();
session_destroy();
header("Location : /boutique");

?>