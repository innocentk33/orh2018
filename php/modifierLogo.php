<?php
/**
 * Created by PhpStorm.
 * User: DEGNI
 * Date: 04/02/2018
 * Time: 04:15
 */

session_start();

header("Content-Type: text/html ; charset=utf-8");
header("Cache-Control: no-cache , private");
include 'connexionBD.php';

$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$logo="default.png";
$destination_logo ="";

try{
    if(!isset($_SESSION['ID_ENT'])){
        throw new Exception("session pas definie / decancun");
    }

    $db->beginTransaction();


    // verification des fichier (logo et photo de profil de linterlocuteur)
    //--------- pour l'entreprise

    if(!empty($_FILES['logo']['tmp_name'])){
        //le fichier est il vraiment un fichier? si oui est ce une image ?
        if ($err = $_FILES['logo']['error']) {
            if ($err == UPLOAD_ERR_INI_SIZE) $json["erreurInfo"] = "Le taille du logo est volumineuse que le max autorisé (>2Mo)";
            elseif ($err == UPLOAD_ERR_FORM_SIZE) $json["erreurInfo"] = "La taille du est volumineuse que le max autorisé (>2Mo)";
            elseif ($err == UPLOAD_ERR_PARTIAL)  $json["erreurInfo"] = "Le logo n'a été que partiellement téléchargée";
            elseif ($err == UPLOAD_ERR_NO_FILE)  $json["erreurInfo"] = "Le logo n'a pu être téléchargée.";

            throw new Exception("decancun");
        }
        if( !(is_file($_FILES['logo']['tmp_name']) && stristr(mime_content_type($_FILES['logo']['tmp_name']) ,"image" ))  ){ // ce nest pas un fichier ou une image
            $json["erreurInfo"] = "Le logo doit être une image.";
            throw new Exception("decancun");
        }
    }else{
        throw new Exception("decancun");
    }


    //upload du  fichier

    //logo
    $nom_generer = md5(microtime(TRUE)*1000);
    $destination_logo = './company/logo/'.$nom_generer;
     if(!move_uploaded_file($_FILES['logo']['tmp_name'], $destination_logo)){
         $json["erreurInfo"] = "Le logo n'a pu être téléchargée.";
         throw new Exception("decancun");
    }
    $logo = $nom_generer;



    // on retient l'ancien nom de la photo
    $req = $db->prepare("SELECT PATH_LOGO_ENT from entreprise WHERE ID_ENT=:id_ent");
    $req->bindParam(":id_ent", $_SESSION['ID_ENT']);
    $req->execute();
    $ancienNom = $req->fetch()[0];
    //on la renomme dans la bd
    $req = $db->prepare("UPDATE entreprise SET PATH_LOGO_ENT=:logo WHERE ID_ENT=:id_ent ");
    $req->bindParam(":logo", $logo);
    $req->bindParam(":id_ent", $_SESSION['ID_ENT']);
    $req->execute();

    // on supprime l'ancien fichier
    unlink("./company/logo/".$ancienNom);

    $db->commit();
    header('Location:../orh_profil_entreprise.php');

}catch(PDOException $e){

    if($logo!="default.png") unlink($destination_logo);
    $db->rollBack();
    echo $e->getMessage();



}catch(Exception $e){
    if($logo!="default.png") unlink($destination_logo);
    $db->rollBack();
    echo $e->getMessage();

}



?>