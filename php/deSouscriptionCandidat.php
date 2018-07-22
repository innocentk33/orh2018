<?php
/**
 * Created by PhpStorm.
 * User: DEGNI
 * Date: 05/02/2018
 * Time: 12:13
 */
session_start();


include 'connexionBD.php';

try{
    if (!isset($_SESSION['ID_CND'])) {
        header('Location: ../index.php');
    }
    $req=$db->prepare("DELETE FROM souscrire_cnd WHERE ID_SERV_CND=:id_serv_cnd AND ID_CND=:id_cnd ");
    $req->bindParam(":id_serv_cnd", $_POST['id_service']);
    $req->bindParam(":id_cnd", $_SESSION['ID_CND']);
    $req->execute();
   header('location: ../orh_profil_candidat.php');

}catch(PDOException $e){
    echo $e->getMessage();
}catch(Exception $e){
    echo  $e->getMessage();
}

?>