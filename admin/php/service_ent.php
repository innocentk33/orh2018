<?php
/**
 * Created by PhpStorm.
 * User: DEGNI
 * Date: 13/02/2018
 * Time: 20:57
 */


session_start();
include '../../php/connexionBD.php';

try{
    if (!isset($_SESSION['ID_ADMIN'])) {
        header('Location: ../index.php');
    }

    $req = $db->prepare("INSERT INTO service_ent(ID_SERV_ENT,ID_ADMIN, LIB_SERV_ENT, DESC_SERV_ENT) 
                       VALUES(:id, :id_admin,:lib,:desc)");
    $req->bindParam(":id", $id,PDO::PARAM_NULL);
    $req->bindParam(":id_admin", $_SESSION['ID_ADMIN']);
    $req->bindParam(":lib", $_POST['titre_ent']);
    $req->bindParam(":desc", $_POST['desc_ent']);
    $req->execute();
    header('location: ../services.php?service');

}catch(PDOException $e){
    echo $e->getMessage();

}catch(Exception $e){
    echo $e->getMessage();
}
?>