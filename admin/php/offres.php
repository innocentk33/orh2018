<?php
/**
 * Created by PhpStorm.
 * User: inno-kirito
 * Date: 25/01/2018
 * Time: 00:25
 */


session_start();
include '../../php/connexionBD.php';

try{
    if (!isset($_SESSION['ID_ADMIN'])) {
        header('Location: ../index.php');
    }
    date("Y-m-d",strtotime($_POST['date_exp']));
    $req = $db->prepare("INSERT INTO offre_site(ID_ADMIN, OFFRE_SITE, DATE_EXPIRATION) 
                       VALUES(:id_admin,:offre_site,:date_exp)");
    $req->bindParam(":id_admin", $_SESSION['ID_ADMIN']);
    $req->bindParam(":offre_site", $_POST['offre']);
    $req->bindParam(":date_exp", $_POST['date_exp']);
    $req->execute();
    header('location: ../ecrireoffre.php?ecrire_offre');

}catch(PDOException $e){
    echo $e->getMessage();

}catch(Exception $e){
    echo $e->getMessage();
}

?>