<?php
/**
 * Created by PhpStorm.
 * User: inno-kirito
 * Date: 18/01/2018
 * Time: 14:29
 */

session_start();

header("Content-Type: text/html ; charset=utf-8");
header("Cache-Control: no-cache , private");
include 'connexionBD.php';

// initialisation de l'objet json (la reponse)
$json['titre']="ENVOI DE CV";
$json["message"] = "";
$json['erreurInfo']="";
$json["action"] = "";
$json["lien"] = "";
$path_cv="";
$destination ="";

try{
    if (!isset($_SESSION['ID_CND'])) {
        header('Location: index.php');
    }
    // verification du fichier (cv pdf)

    $db->beginTransaction();
    if(!empty($_FILES['cv']['tmp_name'])){
        //le fichier est il vraiment un fichier? si oui est ce un pdf ?

        if ($err = $_FILES['cv']['error']) {
            if ($err == UPLOAD_ERR_INI_SIZE) {$json["erreurInfo"] = "La taille de votre fichier est volumineuse que le max autorisé (>2Mo)"; throw  new Exception("bomm");}
            elseif ($err == UPLOAD_ERR_FORM_SIZE) $json["erreurInfo"] = "La taille de votre fichier est volumineuse que le max autorisé (>2Mo)";
            elseif ($err == UPLOAD_ERR_PARTIAL)  $json["erreurInfo"] = "Votre fichier n'a été que partiellement téléchargé";
            elseif ($err == UPLOAD_ERR_NO_FILE)  $json["erreurInfo"] = "Votre fichier n'a pu être téléchargé.";

            throw new Exception("decancun");
        }

        if( !(is_file($_FILES['cv']['tmp_name']) && stristr(mime_content_type($_FILES['cv']['tmp_name']) ,"pdf" ))  ){ // ce nest pas un fichier ou un pdf
            $json["erreurInfo"] = "Votre fchier doit être au format pdf.";
            throw new Exception("decancun");
        }

        //upload
        $path_cv = md5(microtime(TRUE)*1000);
        $destination = './user/cv/'.$path_cv;

    }else{
        throw new Exception("decancun");
    }
            // enregistrement du chemin du cv dans la bd

        // 1- verification sil y a deja existence dun cv du candidat (NB: le candidat ne peut envoyer qu'1 cv)

    $ancienCV ="";

    $req = $db->prepare("SELECT * FROM cv WHERE ID_CND =:id_cnd");
    $req->bindParam(":id_cnd",$_SESSION['ID_CND']);
    $req->execute();

     if ($donnees = $req->fetch()){ // un cv existe deja. il faut donc le modifier
         // on retiens le nom de l'ancien cv

         $ancienCV = $donnees['LIB_CV'];
         // on donne un nouveau nom
         $req = $db->prepare("UPDATE cv SET LIB_CV=:lib_cv WHERE ID_CV=:id_cv");
         $req->bindParam(":lib_cv",$path_cv);
         $req->bindParam(":id_cv",$donnees['ID_CV']);
         $req->execute();
         // historisation
         $req = $db->prepare("UPDATE cv SET DATE_MODIF_CV=CURRENT_TIMESTAMP() WHERE ID_CV=:id_cv");
         $req->bindParam(":id_cv", $donnees['ID_CV']);
         $req->execute();
          //notification a orh en effacant le cv dans la table des cv lus
         $req = $db->prepare("DELETE FROM voir_cv WHERE ID_CV=:id_cv");
         $req->bindParam(":id_cv", $donnees['ID_CV']);
         $req->execute();

     }else { // il s'agit d'un premier envoi.
         $req = $db->prepare("INSERT INTO cv(ID_CV,ID_CND,LIB_CV) VALUES(:id_cv,:id_cnd, :lib_cv)");
         $req->bindParam(":id_cv",$id_cv,PDO::PARAM_NULL);
         $req->bindParam(":id_cnd",$_SESSION['ID_CND']);
         $req->bindParam(":lib_cv",$path_cv);
         $req->execute();
     }

     //upload
    if(!move_uploaded_file($_FILES['cv']['tmp_name'], $destination)){
        $json["erreurInfo"] = "Votre fichier n'a pu être téléchargé.";
        $destination ="";
        throw new Exception("decancun");
    }
    if (!empty($ancienCV)) unlink("./user/cv/".$ancienCV); // on peut supprimer lancien CV


    $db->commit();


    $json["message"]=" <div class='text-success'>Votre CV a été envoyé avec succès!!!</div>".
        "ORH est averti et en prendra connaissance dans les plus brefs délais.";
    $json["lien"] = "decancun";

}catch(PDOException $e){
    $db->rollBack();
    $json["message"]=" Echec lors du téléchargement du fichier!";
    $json["action"] = "";
    echo $e->getMessage();

}catch(Exception $e){
    $db->rollBack();
    $json["message"]="Echec lors du téléchargement. Veuillez ressayer!";
    $json["action"] = "";

    echo $e->getMessage();

}


echo json_encode($json);

?>