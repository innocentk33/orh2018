<?php
/**
 * Created by PhpStorm.
 * User: DEGNI
 * Date: 26/01/2018
 * Time: 10:29
 */

session_start();
session_destroy();
unset($_SESSION['ID_ENT']);
header('Location:../index.php');

?>