<?php
/**
 * Created by PhpStorm.
 * User: DEGNI
 * Date: 05/02/2018
 * Time: 14:59
 */

session_start();


include 'connexionBD.php';

try{
    if (!isset($_SESSION['ID_ENT'])) {
        header('Location: ../index.php');
    }
    $req=$db->prepare("DELETE FROM souscrire_ent WHERE ID_SERV_ENT=:id_serv_ent AND ID_ENT=:id_ent ");
    $req->bindParam(":id_serv_ent", $_POST['id_service']);
    $req->bindParam(":id_ent", $_SESSION['ID_ENT']);
    $req->execute();
    header('location: ../orh_profil_entreprise.php');

}catch(PDOException $e){
    //echo $e->getMessage();
}catch(Exception $e){
    //echo  $e->getMessage();
}

?>