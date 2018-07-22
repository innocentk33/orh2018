<?php
/**
 * Created by PhpStorm.
 * User: inno-kirito
 * Date: 16/01/2018
 * Time: 20:58
 */
header("Content-Type: text/html ; charset=utf-8");
header("Cache-Control: no-cache , private");
include 'connexionBD.php';

$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// initialisation de l'objet json (la reponse)
$json['titre']="INSCRIPTION ENTREPRISE";
$json["message"] = "";
$json['erreurInfo']="";
$json["action"] = "";

$photo="default.png";
$logo="default.png";
$destination_logo ="";
$destination_photo ="";

try{
    $db->beginTransaction();

    //validation de l'email
    $email = filter_input(INPUT_POST,'email',FILTER_VALIDATE_EMAIL);
    if ($email===FALSE){ // email non valide
        $json["erreurInfo"] = "EMAIL NON VALIDE!";
        throw new Exception("decancun");
    }
    //existence de l'email
    $req=$db->prepare("select EMAIL_ENT from entreprise where EMAIL_ENT =:email and ACTIF_ENT='1'");
    $req->bindParam(":email", $_POST['email']);
    $req->execute();
    if($req->fetch()){
        $json["erreurInfo"] = "L'EMAIL EXITE DEJA!";
        throw new Exception("decancun");
    }

    //Verification des mots de passe
    if($_POST['mdp']!=$_POST['mdpverif']){ // mot de passe different
        $json["erreurInfo"] = "MOTS DE PASSE DIFFERENTS!";
        throw new Exception("decancun");
    }
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
    }

        //----------photo de profil de l'interlocuteur

    if(!empty($_FILES['photo']['tmp_name'])){
        //le fichier est il vraiment un fichier? si oui est ce une image ?
        if ($err = $_FILES['photo']['error']) {
            if ($err == UPLOAD_ERR_INI_SIZE) $json["erreurInfo"] = "La taille de la photo de l'interlocuteur est volumineuse que le max autorisé (>2Mo)";
            elseif ($err == UPLOAD_ERR_FORM_SIZE) $json["erreurInfo"] = "La taille de la photo de l'interlocuteur est volumineuse que le max autorisé (>2Mo)";
            elseif ($err == UPLOAD_ERR_PARTIAL)  $json["erreurInfo"] = "La photo de l'interlocuteur n'a été que partiellement téléchargée";
            elseif ($err == UPLOAD_ERR_NO_FILE)  $json["erreurInfo"] = "la photo de l'interlocuteur n'a pu être téléchargée.";

            throw new Exception("decancun");
        }

        if( !(is_file($_FILES['photo']['tmp_name']) && stristr(mime_content_type($_FILES['photo']['tmp_name']) ,"image" ))  ){ // ce nest pas un fichier ou une image
            $json["erreurInfo"] = "La photo de l'interlocuteur doit être une image.";
            throw new Exception("decancun");
        }

    }
    //upload des  fichiers
       //interlocuteur
    $nom_generer = md5(microtime(TRUE)*1000);
    $destination_photo = './company/photo_inter/'.$nom_generer;
    $photo = (move_uploaded_file($_FILES['photo']['tmp_name'], $destination_photo))?$nom_generer:"default.png";
       //logo
    $nom_generer = md5(microtime(TRUE)*1000);
    $destination_logo = './company/logo/'.$nom_generer;
    $logo = (move_uploaded_file($_FILES['logo']['tmp_name'], $destination_logo))?$nom_generer:"default.png";



    // ENregistrement de l'interlocuteur
    $req = $db->prepare("insert into interlocuteur(ID_INTER,ID_GENRE,NOM_INTER,PRENOM_INTER,FONCTION_INTER,EMAIL_INTER,TEL_INTER,PATH_PHOTO_INTER)".
        "values(:id_inter,:id_genre,:nom_inter,:prenom_inter,:fonction_inter,:email_inter,:tel_inter,:path_photo_inter)");
    $req->bindParam(":id_inter",$id_ent,PDO::PARAM_NULL);
    $req->bindParam(":id_genre",$_POST['genre']);
    $req->bindParam(":nom_inter",$_POST['nom']);
    $req->bindParam(":prenom_inter", $_POST['prenom']);
    $req->bindParam(":fonction_inter", $_POST['fonction']);
    $req->bindParam(":email_inter", $_POST['email_inter']);
    $req->bindParam(":tel_inter", $_POST['tel_inter']);
    $req->bindParam(":path_photo_inter", $photo);
    $req->execute();
    $id_inter = $db->lastInsertId();

            //enregistrement de l'entreprise
    $statut = $db->query("select ID_STATUT_ENT from statut_ent where OFFRE_STATUT_ENT='0'")->fetch()['ID_STATUT_ENT']; // statut par defaut de l'entreprise

    $req = $db->prepare("INSERT INTO entreprise(ID_ENT,ID_INTER,ID_TYPE_SOC,ID_FORM_JUR,ID_STATUT_ENT,SIGLE_ENT,".
        "EMAIL_ENT,RAISON_SOCIALE_ENT,COMPTE_CONTRIB_ENT,REG_COM_ENT,TEL_ENT,ADRESSE_POST_ENT,SITE_ENT,FAX_ENT,PATH_LOGO_ENT,CLE_ENT,ACTIF_ENT)".
        " VALUES(:id_ent,:id_inter,:id_type_soc,:id_form_jur,:id_statut_ent,:sigle_ent,:email_ent,:raison_sociale_ent,:compte_contrib_ent,".
        ":reg_com_ent,:tel_ent,:adresse_post_ent,:site_ent,:fax_ent,:path_logo_ent,:cle_ent,:actif_ent)"
    );
    $cle = md5(microtime(TRUE)*1000);
    $actif = 0;
    $site = (!empty($_POST['site']))?$_POST['site']:"";
    $fax = (!empty($_POST['fax']))?$_POST['fax']:"";

    $req->bindParam(":id_ent",$id_ent,PDO::PARAM_NULL);
    $req->bindParam(":id_inter",$id_inter);
    $req->bindParam(":id_type_soc",$_POST['type_soc']);
    $req->bindParam(":id_form_jur",$_POST['form_jur']);
    $req->bindParam(":id_statut_ent", $statut);
    $req->bindParam(":sigle_ent", $_POST['sigle']);
    $req->bindParam(":email_ent", $_POST['email']);
    $req->bindParam(":raison_sociale_ent", $_POST['raison_sociale']);
    $req->bindParam(":compte_contrib_ent", $_POST['compte_contrib']);
    $req->bindParam(":reg_com_ent", $_POST['reg_com']);
    $req->bindParam(":tel_ent", $_POST['tel']);
    $req->bindParam(":adresse_post_ent", $_POST['adresse_post']);
    $req->bindParam(":site_ent", $site);
    $req->bindParam(":fax_ent",$fax);
    $req->bindParam(":path_logo_ent",$logo);
    $req->bindParam(":cle_ent", $cle);
    $req->bindParam(":actif_ent", $actif);
    $req->execute();


    // secteur d'activité(mutiple select)
    $id_ent = $db->lastInsertId();
    $sect_act = $_POST['sect_act'];
    foreach ($sect_act as $id_sect){
        $req = $db->prepare("insert into opere(ID_ENT, ID_SECT) VALUES(:id_ent, :id_sect)");
        $req->bindParam(":id_ent",$id_ent);
        $req->bindParam(":id_sect",$id_sect);
        $req->execute();
    }

    //localisation
    $req = $db->prepare("insert into localiser_ent(ID_ENT, ID_PAYS, ID_VILLE) values(:id_ent, :id_pays,:id_ville)");
    $req->bindParam(":id_ent",$id_ent);
    $req->bindParam(":id_pays",$_POST['pays']);
    $req->bindParam(":id_ville",$_POST['ville']);
    $req->execute();

    // creation de compte
    $req = $db->prepare("insert into compte_ent(ID_COMPTE_ENT,MDP_COMPTE_ENT) values(:id_compte_ent, :mdp)");
    $req->bindParam(":id_compte_ent",$id_compte_ent,PDO::PARAM_NULL);
    $mdp = sha1($_POST['mdp']);
    $req->bindParam(":mdp",$mdp);
    $req->execute();

    $id_compte = $db->lastInsertId();  // id du compte creer

    //correspondance entre lentreprise et le compte.
    $req = $db->prepare("insert into creer_compte_ent(ID_ENT, ID_COMPTE_ENT) values(:id_ent, :id_compte_ent)");
    $req->bindParam(":id_ent",$id_ent);
    $req->bindParam(":id_compte_ent",$id_compte);
    $req->execute();




    $db->commit();


    $json["message"]=" <div class='text-success'>Compte ORH crée avec succès!!!</div>".
        "Pour y accedez, veuillez au préalable confirmé votre adresse email.<br>Un email de confirmation vous a été envoyé.";
    $json["action"] = "click";

}catch(PDOException $e){

    if($logo!="default.png") unlink($destination_logo);
    if($photo!="default.png") unlink($destination_photo);

    $db->rollBack();
    $json["message"]=" Echec lors de l'enregistrement. Veuillez ressayer!";
    $json["action"] = "";


}catch(Exception $e){
    if($logo!="default.png") unlink($destination_logo);
    if($photo!="default.png") unlink($destination_photo);
    $db->rollBack();
    $json["message"]="Echec lors de l'enregistrement. Veuillez ressayer!";
    $json["action"] = "";

}


echo json_encode($json);
?>