<?php
/**
 * Created by PhpStorm.
 * User: DEGNI
 * Date: 31/01/2018
 * Time: 23:40
 */
session_start();

header("Content-Type: text/html ; charset=utf-8");
header("Cache-Control: no-cache , private");
include 'connexionBD.php';

$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// initialisation de l'objet json (la reponse)
$json['titre']="MODIFICATION DE VOS INFORMATIONS";
$json["message"] = "";
$json['erreurInfo']="";
$json["action"] = "";



    try{
        if (!isset($_SESSION['ID_CND'])) {
            header('Location: index.php');
        }
        $db->beginTransaction();

        $req = $db->prepare("UPDATE candidat SET ID_GENRE=:id_genre,ID_NIVEAU=:id_niveau, ID_CONTRAT=:id_contrat, ID_SIT_PROF=:id_sit_prof,".
            "ID_SIT_MAT=:id_sit_mat,ID_NAT=:id_nat,NOM_CND=:nom_cnd,PRENOM_CND=:prenom_cnd,DATE_NAISS_CND=:date_naiss_cnd,CONTACT_CND=:contact_cnd,ANNEE_EXP_CND=:annee_exp_cnd".
            " WHERE ID_CND=:id_cnd"
        );
        $date_naiss=date("Y-m-d",strtotime($_POST['date_naiss'])); // conversion de la date au format mysql
        $req->bindParam(":id_cnd",$_SESSION['ID_CND']);
        $req->bindParam(":id_genre",$_POST['genre']);
        $req->bindParam(":id_niveau",$_POST['niveau']);
        $req->bindParam(":id_contrat", $_POST['contrat']);
        $req->bindParam(":id_sit_prof", $_POST['sit_prof']);
        $req->bindParam(":id_sit_mat", $_POST['sit_mat']);
        $req->bindParam(":id_nat", $_POST['nat']);
        $req->bindParam(":nom_cnd", $_POST['nom']);
        $req->bindParam(":prenom_cnd", $_POST['prenom']);
        $req->bindParam(":date_naiss_cnd", $date_naiss);
        $req->bindParam(":contact_cnd", $_POST['tel']);
        $req->bindParam(":annee_exp_cnd", $_POST['anexp']);
        $req->execute();

        //echo "candidat effectué";

        // domaine de competence (mutiple select)
        $dom_comp = $_POST['dom_comp'];
        $req = $db->prepare("DELETE FROM avoir_dom WHERE ID_CND=:id_cnd"); // on supprime dabord les anciens domaines
        $req->bindParam(":id_cnd",$_SESSION['ID_CND']);
        $req->execute();
        foreach ($dom_comp as $id_dom){
            $req = $db->prepare("insert into avoir_dom(ID_CND, ID_DOM) VALUES(:id_cnd, :id_dom)"); // on insert les nouveaux domaines
            $req->bindParam(":id_cnd",$_SESSION['ID_CND']);
            $req->bindParam(":id_dom",$id_dom);
            $req->execute();
        }
         //echo "avoir_vomp ";
        // idem langue parlées
        $lang = $_POST['langue'];
        $req = $db->prepare("DELETE FROM parler WHERE ID_CND=:id_cnd"); // on supprime dabord les anciennes langues parlees
        $req->bindParam(":id_cnd",$_SESSION['ID_CND']);
        $req->execute();
        foreach ($lang as $id_lang){
            $req =$db->prepare("insert into parler(ID_CND, ID_LANG) VALUES(:id_cnd,:id_lang)"); // on insert les nouveaux
            $req->bindParam(":id_cnd",$_SESSION['ID_CND']);
            $req->bindParam(":id_lang",$id_lang);
            $req->execute();
        }
        //echo "langue";

        //idem localiser(cnd,pays, ville)
        $req = $db->prepare("UPDATE localiser_cnd SET ID_PAYS=:id_pays, ID_VILLE=:id_ville WHERE ID_CND=:id_cnd");
        $req->bindParam(":id_cnd",$_SESSION['ID_CND']);
        $req->bindParam(":id_pays",$_POST['pays']);
        $req->bindParam(":id_ville",$_POST['ville']);
        $req->execute();

          //echo "localiser";


        $db->commit();


        $json["message"]=" <div class='text-success'>Modifications éffectuées avec succès!!!</div>";
        $json["lien"] = "decancun";
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
