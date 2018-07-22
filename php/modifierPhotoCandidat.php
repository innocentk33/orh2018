<?php
/**
 * Created by PhpStorm.
 * User: DEGNI
 * Date: 04/02/2018
 * Time: 02:10
 */

session_start();
include 'connexionBD.php';

$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// initialisation de l'objet json (la reponse)
$json['titre']="MODIFICATION DE LA PHOTO DE PROFIL";
$json["message"] = "";
$json['erreurInfo']="";
$json["action"] = "";
$json["lien"] = "";

$path_photo="";
$destination ="";

    try{
        $db->beginTransaction();

        // verification du fichier (photo de profil)
        $path_photo="default.png";
        if(!empty($_FILES['photo']['tmp_name'])){
            //le fichier est il vraiment un fichier? si oui est ce une image ?

            if ($err = $_FILES['photo']['error']) {
                if ($err == UPLOAD_ERR_INI_SIZE) $json["erreurInfo"] = "La taille de votre photo est volumineuse que le max autorisé (>2Mo)";
                elseif ($err == UPLOAD_ERR_FORM_SIZE) $json["erreurInfo"] = "La taille de votre photo est volumineuse que le max autorisé (>2Mo)";
                elseif ($err == UPLOAD_ERR_PARTIAL)  $json["erreurInfo"] = "Votre photo n'a été que partiellement téléchargée";
                elseif ($err == UPLOAD_ERR_NO_FILE)  $json["erreurInfo"] = "Votre photo n'a pu être téléchargée.";

                throw new Exception("decancun");
            }
            if( !(is_file($_FILES['photo']['tmp_name']) && stristr(mime_content_type($_FILES['photo']['tmp_name']) ,"image" ))  ){ // ce nest pas un fichier ou une image
                $json["erreurInfo"] = "Votre photo doit être une image.";
                throw new Exception("decancun");
            }

            }else{
            throw new Exception("decancun vide variable file");

        }



        $ancienNom ="";

        $req = $db->prepare("SELECT PATH_PHOTO_CND FROM candidat WHERE ID_CND =:id_cnd");
        $req->bindParam(":id_cnd",$_SESSION['ID_CND']);
        $req->execute();
;
        $ancienNom = $req->fetch()['PATH_PHOTO_CND']; // on retientt l'ancien nom
        // on donne un nouveau nom
        $path_photo = md5(microtime(TRUE)*1000);
        $destination = './user/photo_profil/'.$path_photo;
        //$path_photo = (move_uploaded_file($_FILES['photo']['tmp_name'], $destination))?$nom_generer:"default.png";

        // renommage dans la bd
        $req = $db->prepare("UPDATE candidat SET PATH_PHOTO_CND=:path_photo WHERE ID_CND=:id_cnd");
        $req->bindParam(":id_cnd",$_SESSION['ID_CND']);
        $req->bindParam(":path_photo",$path_photo);
        $req->execute();


        //upload
        if(!move_uploaded_file($_FILES['photo']['tmp_name'], $destination)){
            $json["erreurInfo"] = "Votre fichier n'a pu être téléchargé.";
            $path_photo="default.png";
            $destination ="";
            throw new Exception("decancun not move upload");
        }

        if($path_photo!="default.png")unlink("./user/photo_profil/".$ancienNom); // on peut supprimer lancienne photo



        $db->commit();

        $json["message"]=" <div class='text-success'>Photo de profil modifiée avec succès!!!</div>";
        $json["lien"] = "validé";

    }catch(PDOException $e){
        $db->rollBack();
        $json["message"]=" Echec lors de l'enregistrement. Veuillez ressayer!";
        $json["action"] = "";
        echo $e->getMessage();

    }catch(Exception $e){
        if($path_photo!="default.png") unlink($destination);
        $db->rollBack();
        $json["message"]="Echec lors de l'enregistrement. Veuillez ressayer!";
        $json["action"] = "";
        echo $e->getMessage();
    }


echo json_encode($json);


?>