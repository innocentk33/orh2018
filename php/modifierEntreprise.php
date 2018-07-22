<?php
/**
 * Created by PhpStorm.
 * User: inno-kirito
 * Date: 26/01/2018
 * Time: 01:55
 */
session_start();
header("Content-Type: text/html ; charset=utf-8");
header("Cache-Control: no-cache , private");
include 'connexionBD.php';

$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// initialisation de l'objet json (la reponse)
$json['titre']="MODIFICATIONS DES INFORMATIONS";
$json["message"] = "";
$json['erreurInfo']="";
$json["action"] = "";
$json["lien"] = "";



$photo="default.png";
$logo="default.png";
$destination_logo ="";
$destination_photo ="";

try{

    $db->beginTransaction();


    // ENregistrement de l'interlocuteur
    $req = $db->prepare("UPDATE interlocuteur SET ID_GENRE=:id_genre,NOM_INTER=:nom_inter,".
        "PRENOM_INTER=:prenom_inter,FONCTION_INTER=:fonction_inter,EMAIL_INTER=:email_inter,TEL_INTER=:tel_inter
         WHERE ID_INTER=:id_inter" );
    $req->bindParam(":id_inter",$_SESSION['ID_INTER']);
    $req->bindParam(":id_genre",$_POST['genre']);
    $req->bindParam(":nom_inter",$_POST['nom']);
    $req->bindParam(":prenom_inter", $_POST['prenom']);
    $req->bindParam(":fonction_inter", $_POST['fonction']);
    $req->bindParam(":email_inter", $_POST['email_inter']);
    $req->bindParam(":tel_inter", $_POST['tel_inter']);
    $req->execute();

    $req = $db->prepare("UPDATE entreprise SET ID_INTER=:id_inter,ID_TYPE_SOC=:id_type_soc,
ID_FORM_JUR=:id_form_jur, SIGLE_ENT=:sigle_ent,RAISON_SOCIALE_ENT=:raison_sociale_ent,
COMPTE_CONTRIB_ENT=:compte_contrib_ent,REG_COM_ENT=:reg_com_ent,TEL_ENT=:tel_ent,ADRESSE_POST_ENT=:adresse_post_ent,SITE_ENT=:site_ent,
FAX_ENT=:fax_ent WHERE ID_ENT=:id_ent");

    $site = (!empty($_POST['site']))?$_POST['site']:"";
    $fax = (!empty($_POST['fax']))?$_POST['fax']:"";

    $req->bindParam(":id_inter",$_SESSION['ID_INTER']);
    $req->bindParam(":id_ent",$_SESSION['ID_ENT']);
    $req->bindParam(":id_inter",$_SESSION['ID_INTER']);
    $req->bindParam(":id_type_soc",$_POST['type_soc']);
    $req->bindParam(":id_form_jur",$_POST['form_jur']);
    $req->bindParam(":sigle_ent", $_POST['sigle']);
    $req->bindParam(":raison_sociale_ent", $_POST['raison_sociale']);
    $req->bindParam(":compte_contrib_ent", $_POST['compte_contrib']);
    $req->bindParam(":reg_com_ent", $_POST['reg_com']);
    $req->bindParam(":tel_ent", $_POST['tel']);
    $req->bindParam(":adresse_post_ent", $_POST['adresse_post']);
    $req->bindParam(":site_ent", $site);
    $req->bindParam(":fax_ent",$fax);
    $req->execute();


    // secteur d'activité(mutiple select)

    $req = $db->prepare("DELETE FROM opere WHERE ID_ENT=:id_ent"); // on supprime dabord les anciennes langues parlees
    $req->bindParam(":id_ent",$_SESSION['ID_ENT']);
    $req->execute();
    $sect_act = $_POST['sect_act'];


    foreach ($sect_act as $id_sect){
        $req = $db->prepare("insert into opere(ID_ENT, ID_SECT) VALUES(:id_ent, :id_sect)");
        $req->bindParam(":id_ent",$_SESSION['ID_ENT']);
        $req->bindParam(":id_sect",$id_sect);
        $req->execute();
    }
    //localisation
    $req = $db->prepare("DELETE FROM localiser_ent WHERE ID_ENT=:id_ent"); // on supprime dabord les anciennes langues parlees
    $req->bindParam(":id_ent",$_SESSION['ID_ENT']);
    $req->execute();
    $req = $db->prepare("insert into localiser_ent(ID_ENT, ID_PAYS, ID_VILLE) values(:id_ent, :id_pays,:id_ville)");
    $req->bindParam(":id_ent",$_SESSION['ID_ENT']);
    $req->bindParam(":id_pays",$_POST['pays']);
    $req->bindParam(":id_ville",$_POST['ville']);
    $req->execute();




    $db->commit();


    $json["message"]=" <div class='text-success'>Infomations modifiées avec succès!!!</div>";

}catch(PDOException $e){
    echo $e->getMessage();
    $db->rollBack();
    $json["message"]=" Echec lors de l'enregistrement. Veuillez ressayer!";
    $json["action"] = "";


}catch(Exception $e){
    echo $e->getMessage();
    $db->rollBack();
    $json["message"]="Echec lors de l'enregistrement. Veuillez ressayer!";
    $json["action"] = "";

}


echo json_encode($json);

?>