<?php
/**
 * Created by PhpStorm.
 * User: DEGNI
 * Date: 04/02/2018
 * Time: 14:29
 */


session_start();

header("Content-Type: text/html ; charset=utf-8");
header("Cache-Control: no-cache , private");
include 'connexionBD.php';

$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// initialisation de l'objet json (la reponse)


$destination_offre;

try{
    if (!isset($_SESSION['ID_ENT'])) {
        header('Location:../orh_profil_entreprise.php');
    }
    //statut entreprise
    $req = $db->prepare("SELECT OFFRE_STATUT_ENT FROM statut_ent WHERE ID_STATUT_ENT=:id_statut");
    $req->bindParam(":id_statut", $_SESSION['ID_STATUT_ENT']);
    $req->execute();
    $offre = $req->fetch()['OFFRE_STATUT_ENT'];
    if($offre == 0){

        header('Location:../orh_profil_entreprise.php');
    }

    $db->beginTransaction();


    // verification des fichier (logo et photo de profil de linterlocuteur)
    //--------- pour l'entreprise

    if(!empty($_FILES['offre']['tmp_name'])){
        //le fichier est il vraiment un fichier? si oui est ce une image ?
        if ($err = $_FILES['offre']['error']) {
            if ($err == UPLOAD_ERR_INI_SIZE) $json["erreurInfo"] = "Le taille du fichier est volumineux que le max autorisé (>2Mo)";
            elseif ($err == UPLOAD_ERR_FORM_SIZE) $json["erreurInfo"] = "La taille du est volumineuse que le max autorisé (>2Mo)";
            elseif ($err == UPLOAD_ERR_PARTIAL)  $json["erreurInfo"] = "Le logo n'a été que partiellement téléchargée";
            elseif ($err == UPLOAD_ERR_NO_FILE)  $json["erreurInfo"] = "Le logo n'a pu être téléchargée.";

            throw new Exception("decancun");
        }
        if( !(is_file($_FILES['offre']['tmp_name']) && stristr(mime_content_type($_FILES['offre']['tmp_name']) ,"pdf" ))  ){ // ce nest pas un fichier ou une image
            $json["erreurInfo"] = "Le logo doit être une image.";
            throw new Exception("decancun");
        }
    }else{
        header('Location:../orh_profil_entreprise.php');
    }


    //upload du  fichier

    $nom_generer = md5(microtime(TRUE)*1000);
    $destination_offre = './company/offre/'.$nom_generer;
    if(!move_uploaded_file($_FILES['offre']['tmp_name'], $destination_offre)){
        throw new Exception("decancun : file not uploaded");
    }

    $offre = $nom_generer;

    // ENregistrement de l'interlocuteur
    $req = $db->prepare("insert into offre_ent(ID_OFFRE_ENT,ID_ENT,PATH_OFFRE_ENT) values(:id_offre,:id_ent,:path)");
    $req->bindParam(":id_offre",$id_offre,PDO::PARAM_NULL);
    $req->bindParam(":id_ent",$_SESSION['ID_ENT']);
    $req->bindParam(":path",$offre);
    $req->execute();

    $db->commit();
    header('Location:../orh_profil_entreprise.php');


}catch(PDOException $e){
    echo $e->getMessage();
    $db->rollBack();
    unlink($destination_offre);


}catch(Exception $e){
    echo $e->getMessage();
    $db->rollBack();
    unlink($destination_offre);


}


?>