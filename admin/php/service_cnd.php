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

    $req = $db->prepare("INSERT INTO service_cnd(ID_SERV_CND,ID_ADMIN, LIB_SERV_CND, DESC_SERV_CND) 
                       VALUES(:id, :id_admin,:lib,:desc)");
    $req->bindParam(":id", $id,PDO::PARAM_NULL);
    $req->bindParam(":id_admin", $_SESSION['ID_ADMIN']);
    $req->bindParam(":lib", $_POST['titre_cnd']);
    $req->bindParam(":desc", $_POST['desc_cnd']);
    $req->execute();
    header('location: ../services.php?service');

}catch(PDOException $e){
    echo $e->getMessage();

}catch(Exception $e){
    echo $e->getMessage();
}

?>