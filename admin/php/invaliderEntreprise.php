<?php
/**
 * Created by PhpStorm.
 * User: DEGNI
 * Date: 21/02/2018
 * Time: 10:55
 */

session_start();
include '../../php/connexionBD.php';

try{
    if (!isset($_SESSION['ID_ADMIN'])) {
        header('Location: ../index.php');
    }
    $req = $db->prepare("update entreprise set ID_STATUT_ENT=(select ID_STATUT_ENT from statut_ent where OFFRE_STATUT_ENT='0' )
            where ID_ENT=:id_ent
            ");
    $req->bindParam(":id_ent", $_POST['id_ent']);
    $req->execute();

    header('location: ../entreprise.php?ent');

}catch(PDOException $e){
    echo $e->getMessage();

}catch(Exception $e){
    echo $e->getMessage();
}
