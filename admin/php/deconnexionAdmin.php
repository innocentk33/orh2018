<?php
/**
 * Created by PhpStorm.
 * User: DEGNI
 * Date: 05/02/2018
 * Time: 01:43
 */


session_start();
session_destroy();
unset($_SESSION['ID_ADMIN']);
header('Location:../index.php');
?>