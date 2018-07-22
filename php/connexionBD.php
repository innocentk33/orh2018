<?php
/**
 * Created by PhpStorm.
 * User: DEGNI
 * Date: 20/01/2018
 * Time: 15:28
 */

$user = 'root';
$pass = '';
$dsn = 'mysql:host=localhost;dbname=orh;charset=utf8';
try{
    $db = new PDO($dsn, $user, $pass, array(PDO::ATTR_PERSISTENT => true));
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch (PDOException $e){
    echo "erreur connexion à la bd";
}