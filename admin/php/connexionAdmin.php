<?php
/**
 * Created by PhpStorm.
 * User: inno-kirito
 * Date: 21/01/2018
 * Time: 16:54
 */
session_start();
 include '../../php/connexionBD.php';

 $json['message'] ="";

try{
    $req = $db->prepare("select * from admin where PSEUDO_ADMIN =:pseudo AND MDP_ADMIN=:mdp");
    $req->bindParam(":pseudo", $_POST['pseudo']);
    $mdp= sha1($_POST['mdp']);
    $req->bindParam(":mdp", $mdp);
    $req->execute();
    $donnees="";

    if( !($donnees = $req->fetch()) ){
        header('location: ../index.php');
    }
    $_SESSION['ID_ADMIN'] = $donnees['ID_ADMIN'];
    $_SESSION['EMAIL_ADMIN']= $donnees['EMAIL_ADMIN'];
    $_SESSION['PSEUDO_ADMIN']= $donnees['PSEUDO_ADMIN'];
    header('location: ../dashboard.php?dashboard');


}catch(PDOException $e){
    echo $e->getMessage();

}catch(Exception $e){
    echo $e->getMessage();
}
?>