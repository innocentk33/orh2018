<?php
/**
 * Created by PhpStorm.
 * User: DEGNI
 * Date: 13/02/2018
 * Time: 20:58
 */

session_start();
include '../../php/connexionBD.php';

try{
    if (!isset($_SESSION['ID_ADMIN'])) {
        header('Location: ../index.php');
    }
    $req = $db->prepare("DELETE FROM service_cnd WHERE ID_SERV_CND=:id");
    $req->bindParam(":id", $_POST['id']);
    $req->execute();

    header('location: ../services.php?service');

}catch(PDOException $e){
    echo $e->getMessage();

}catch(Exception $e){
    echo $e->getMessage();
}

?>