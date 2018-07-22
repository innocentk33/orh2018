<?php
/**
 * Created by PhpStorm.
 * User: inno-kirito
 * Date: 26/01/2018
 * Time: 01:37
 */

session_start();


include 'connexionBD.php';

try{
    if (!isset($_SESSION['ID_ENT'])) {
        header('Location: index.php');
    }
    $req=$db->prepare("INSERT INTO souscrire_ent(ID_SERV_ENT, ID_ENT) VALUES(:id_serv_ent, :id_ent) ");
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