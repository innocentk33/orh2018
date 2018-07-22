<?php
/**
 * Created by PhpStorm.
 * User: DEGNI
 * Date: 13/02/2018
 * Time: 00:05
 */

session_start();

header("Content-Type: text/html ; charset=utf-8");
header("Cache-Control: no-cache , private");
include '../../php/connexionBD.php';

$path_img = "";
$destination = "";

try{
    if (!isset($_SESSION['ID_ADMIN'])) {
        header('Location: ../index.php');
    }


    $db->beginTransaction();
    $path_img = "orh_logo.png";
    if(!empty($_FILES['img']['tmp_name'])){
        //le fichier est il vraiment un fichier? si oui est ce une image ?

        if ($_FILES['img']['error']) {
            throw new Exception("decancun");
        }

        if( !(is_file($_FILES['img']['tmp_name']) && stristr(mime_content_type($_FILES['img']['tmp_name']) ,"image" ))  ){ // ce nest pas un fichier ou un pdf
            throw new Exception("decancun");
        }

        //upload
        $path_img = md5(microtime(TRUE)*1000);
        $destination = './actualite/'.$path_img;
        if(!move_uploaded_file($_FILES['img']['tmp_name'], $destination)){
            $destination ="";
            throw new Exception("decancun");
        }

    }


        $req = $db->prepare("INSERT INTO actualite(ID_ACT, ID_ADMIN, LIB_ACT, DESC_ACT, PATH_IMG_ACT) 
         VALUES(:id_act, :id_admin, :lib_act, :desc_act, :path)");

        $req->bindParam(":id_act",$id_act,PDO::PARAM_NULL);
        $req->bindParam(":id_admin",$_SESSION['ID_ADMIN']);
        $req->bindParam(":lib_act",$_POST['titre']);
        $req->bindParam(":desc_act",$_POST['desc']);
        $req->bindParam(":path",$path_img);
        $req->execute();




    $db->commit();

     header('location: ../actualite.php?actualite');

}catch(PDOException $e){
    if($path_photo!="orh_logo.png") unlink($destination);
    $db->rollBack();
   echo $e->getMessage();

}catch(Exception $e){
    $db->rollBack();
   echo $e->getMessage();

}



?>