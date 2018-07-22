<?php


header("Content-Type: text/html ; charset=utf-8");
header("Cache-Control: no-cache , private");
include 'connexionBD.php';

$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// initialisation de l'objet json (la reponse)
$json['titre']="INSCRIPTION CANDIDAT";
$json["message"] = "";
$json['erreurInfo']="";
$json["action"] = "";

$path_photo="default.png";
$destination ="";

    try{
        $db->beginTransaction();

        //validation de l'email
        $email = filter_input(INPUT_POST,'email',FILTER_VALIDATE_EMAIL);
        if ($email===FALSE){ // email non valide
            $json["erreurInfo"] = "EMAIL NON VALIDE!";
            throw new Exception("decancun");
        }
        //existence de l'email
        $req=$db->prepare("select EMAIL_CND from candidat where EMAIL_CND =:email and ACTIF_CND='1'");
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

            //upload
            $nom_generer = md5(microtime(TRUE)*1000);
            $destination = './user/photo_profil/'.$nom_generer;
             $path_photo = (move_uploaded_file($_FILES['photo']['tmp_name'], $destination))?$nom_generer:"default.png";
        }



        $req = $db->prepare("INSERT INTO candidat(ID_CND,ID_GENRE,ID_NIVEAU,ID_CONTRAT,ID_SIT_PROF, ID_SIT_MAT,ID_NAT,NOM_CND, PRENOM_CND,DATE_NAISS_CND,CONTACT_CND,".
            "EMAIL_CND,ANNEE_EXP_CND,PATH_PHOTO_CND,CLE_CND,ACTIF_CND) VALUES(:id_cnd,:id_genre,:id_niveau,:id_contrat,:id_sit_prof,:id_sit_mat,:id_nat,:nom_cnd,:prenom_cnd,:date_naiss_cnd,:contact_cnd,".
            ":email_cnd,:annee_exp_cnd,:path_photo_cnd,:cle_cnd,:actif_cnd)"
            );
        $cle = md5(microtime(TRUE)*1000);
        $actif = 0;
        $date_naiss=date("Y-m-d",strtotime($_POST['date_naiss'])); // conversion de la date au format mysql
        $req->bindParam(":id_cnd",$id_cnd,PDO::PARAM_NULL);
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
        $req->bindParam(":email_cnd", $_POST['email']);
        $req->bindParam(":annee_exp_cnd", $_POST['anexp']);
        $req->bindParam(":path_photo_cnd",$path_photo);
        $req->bindParam(":cle_cnd", $cle);
        $req->bindParam(":actif_cnd", $actif);
        $req->execute();

        //echo "candidat effectué";

        // domaine de competence (mutiple select)
        $id_cnd = $db->lastInsertId();
        $dom_comp = $_POST['dom_comp'];
        foreach ($dom_comp as $id_dom){
            $req = $db->prepare("insert into avoir_dom(ID_CND, ID_DOM) VALUES(:id_cnd, :id_dom)");
            $req->bindParam(":id_cnd",$id_cnd);
            $req->bindParam(":id_dom",$id_dom);
            $req->execute();
        }
       // echo "avoir_vomp ";
        // idem langue parlées
        $lang = $_POST['langue'];
        foreach ($lang as $id_lang){
            $req =$db->prepare("insert into parler(ID_CND, ID_LANG) VALUES(:id_cnd,:id_lang)");
            $req->bindParam(":id_cnd",$id_cnd);
            $req->bindParam(":id_lang",$id_lang);
            $req->execute();
        }
        //echo "langue";

        //idem localiser(cnd,pays, ville)
        $req = $db->prepare("insert into localiser_cnd(ID_CND, ID_PAYS, ID_VILLE) values(:id_cnd, :id_pays,:id_ville)");
        $req->bindParam(":id_cnd",$id_cnd);
        $req->bindParam(":id_pays",$_POST['pays']);
        $req->bindParam(":id_ville",$_POST['ville']);
        $req->execute();

          //  echo "localiser";


        // creation de compte
        $req = $db->prepare("insert into compte_cnd(ID_COMPTE_CND,MDP_COMPTE_CND) values(:id_compte_cnd, :mdp)");
        $req->bindParam(":id_compte_cnd",$id_compte_cnd,PDO::PARAM_NULL);
        $mdp = sha1($_POST['mdp']);
        $req->bindParam(":mdp",$mdp);
        $req->execute();
       // echo "comptecnd";

        $id_compte = $db->lastInsertId();  // id du compte creer

           //correspondance entre le candidat et le compte.
        $req = $db->prepare("insert into creer_compte_cnd(ID_CND, ID_COMPTE_CND) values(:id_cnd, :id_compte_cnd)");
        $req->bindParam(":id_cnd",$id_cnd);
        $req->bindParam(":id_compte_cnd",$id_compte);
        $req->execute();

        $db->commit();


        $json["message"]=" <div class='text-success'>Compte ORH crée avec succès!!!</div>".
            "Pour y accedez, veuillez au préalable confirmé votre adresse email.<br>Un email de confirmation vous a été envoyé.";
        $json["action"] = "click";

    }catch(PDOException $e){
        if($path_photo!="default.png") unlink($destination);
        $db->rollBack();
        $json["message"]=" Echec lors de l'enregistrement. Veuillez ressayer!";
        $json["action"] = "";


    }catch(Exception $e){
        $db->rollBack();
        $json["message"]="Echec lors de l'enregistrement. Veuillez ressayer!";
        $json["action"] = "";

    }


echo json_encode($json);


?>


