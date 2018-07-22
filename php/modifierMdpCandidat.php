<?php
/**
 * Created by PhpStorm.
 * User: DEGNI
 * Date: 02/02/2018
 * Time: 12:37
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

try{
    if(!isset($_SESSION['ID_CND'])){
        throw new Exception("session pas definie / decancun");
    }


        // verification du mot de passe. pour ce faire :
        // cherche l'id du compte
        $id_cnd = $_SESSION['ID_CND'];
        $req=$db->prepare("select ID_COMPTE_CND from creer_compte_cnd where ID_CND =:id_cnd");
        $req->bindParam(":id_cnd", $id_cnd);
        $req->execute();

        $id_compte_cnd = $req->fetch()["ID_COMPTE_CND"];
        //comparaison du mot de passe avec celui dans le compte
        $req=$db->prepare("select MDP_COMPTE_CND from compte_cnd where ID_COMPTE_CND =:id_compte_cnd");
        $req->bindParam(":id_compte_cnd", $id_compte_cnd);
        $req->execute();
        $mdp = $req->fetch()["MDP_COMPTE_CND"];

        if( $mdp != sha1($_POST['mdp']) ){
            $json["message"] = "<div class='text-danger'>Mot de passe actuel incorrect!</div>";
            throw new Exception("decancun");
        }
        if($_POST['mdpNew']!=$_POST['mdpVerif']){
            $json["message"] = "<div class='text-danger'>MOTS DE PASSE DIFFERENTS</div>";
            throw new Exception("decancun");
        }
    $mdpNew = sha1($_POST['mdpNew']);
    $req=$db->prepare("UPDATE compte_cnd SET MDP_COMPTE_CND=:mdpNew where ID_COMPTE_CND =:id_compte_cnd");
    $req->bindParam(":id_compte_cnd", $id_compte_cnd);
    $req->bindParam(":mdpNew", $mdpNew );
    $req->execute();


        $json["message"] = "<div class='text-success'>Modification éffectuée avec succès !!!</div>";



}catch(PDOException $e){
    $e->getMessage();
}catch(Exception $e){
    $e->getMessage();
}
echo json_encode($json);



?>