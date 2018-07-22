<?php
/**
 * Created by PhpStorm.
 * User: DEGNI
 * Date: 13/02/2018
 * Time: 19:18
 */

session_start();

header("Content-Type: text/html ; charset=utf-8");
header("Cache-Control: no-cache , private");
include '../../php/connexionBD.php';

try{
    if (!isset($_SESSION['ID_ADMIN'])) {
        header('Location: ../index.php');
    }


    $db->beginTransaction();

    // recupere le nom du fichier image de l'actualite
    $req = $db->prepare("select PATH_IMG_ACT from actualite where ID_ACT=:id_act");
    $req->bindParam(":id_act",$_POST['id_act']);
    $req->execute();
    $nomFichier = $req->fetch()['PATH_IMG_ACT'];

    //on supprime l'enregistrement de la bd
    $req = $db->prepare("delete from actualite where ID_ACT=:id_act");
    $req->bindParam(":id_act",$_POST['id_act']);
    $req->execute();


    //on supprime le fichier image
    if($nomFichier != "orh_logo.png")unlink('./actualite/'.$nomFichier);

    $db->commit();

    header('location: ../actualite.php?actualite');

}catch(PDOException $e){
    $db->rollBack();
    echo $e->getMessage();

}catch(Exception $e){
    $db->rollBack();
    echo $e->getMessage();

}
?>