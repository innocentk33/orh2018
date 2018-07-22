<?php
/**
 * Created by PhpStorm.
 * User: DEGNI
 * Date: 04/02/2018
 * Time: 05:24
 */

session_start();

header("Content-Type: text/html ; charset=utf-8");
header("Cache-Control: no-cache , private");
include 'connexionBD.php';

$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// initialisation de l'objet json (la reponse)
$json['titre']="MODIFICATION DU MOT DE PASSE";
$json["message"] = "<div class='text-danger'>ECHEC!</div>";
$json['erreurInfo']="";
$json["action"] = "";
$json["lien"] = "";

try{
    if(!isset($_SESSION['ID_ENT'])){
        throw new Exception("session pas definie / decancun");
    }

        $db->beginTransaction();
    // verification du mot de passe. pour ce faire :
    // cherche l'id du compte
    $id_ent = $_SESSION['ID_ENT'];
    $req=$db->prepare("select ID_COMPTE_ENT from creer_compte_ent where ID_ENT =:id_ent");
    $req->bindParam(":id_ent", $id_ent);
    $req->execute();

    $id_compte_ent = $req->fetch()["ID_COMPTE_ENT"];
    //comparaison du mot de passe avec celui dans le compte
    $req=$db->prepare("select MDP_COMPTE_ENT from compte_ent where ID_COMPTE_ENT =:id_compte_ent");
    $req->bindParam(":id_compte_ent", $id_compte_ent);
    $req->execute();
    $mdp = $req->fetch()["MDP_COMPTE_ENT"];

    if( $mdp != sha1($_POST['mdp']) ){
        $json["message"] = "<div class='text-danger'>Mot de passe actuel incorrect!</div>";
        throw new Exception("decancun");
    }
    if($_POST['mdpNew']!=$_POST['mdpVerif']){
        $json["message"] = "<div class='text-danger'>MOTS DE PASSE DIFFERENTS</div>";
        throw new Exception("decancun");
    }
    $mdpNew = sha1($_POST['mdpNew']);
    $req=$db->prepare("UPDATE compte_ent SET MDP_COMPTE_ENT=:mdpNew where ID_COMPTE_ENT =:id_compte_ent");
    $req->bindParam(":id_compte_ent", $id_compte_ent);
    $req->bindParam(":mdpNew", $mdpNew );
    $req->execute();


    $json["message"] = "<div class='text-success'>Modification éffectuée avec succès !!!</div>";
    $json["action"] = "click";

    $db->commit();

}catch(PDOException $e){
    $db->rollBack();
   //echo $e->getMessage();
}catch(Exception $e){
    $db->rollBack();
    //echo $e->getMessage();
}
echo json_encode($json);





?>