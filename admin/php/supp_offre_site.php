<?php
/**
 * Created by PhpStorm.
 * User: DEGNI
 * Date: 07/02/2018
 * Time: 13:17
 */

session_start();
include '../../php/connexionBD.php';

try{
    if (!isset($_SESSION['ID_ADMIN'])) {
        header('Location: ../index.php');
    }
    $req = $db->prepare("DELETE FROM offre_site WHERE ID_OFFRE_SITE=:id_offre");
    $req->bindParam(":id_offre", $_POST['id_offre']);
    $req->execute();

    header('location: ../ecrireoffre.php?ecrire_offre');

}catch(PDOException $e){
    echo $e->getMessage();

}catch(Exception $e){
    echo $e->getMessage();
}

?>