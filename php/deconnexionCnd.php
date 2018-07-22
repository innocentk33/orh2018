<?php
/**
 * Created by PhpStorm.
 * User: DEGNI
 * Date: 26/01/2018
 * Time: 05:44
 */
session_start();
session_destroy();
unset($_SESSION['ID_CND']);
header('Location:../index.php');

?>