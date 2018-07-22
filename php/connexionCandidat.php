<?php
/**
 * Created by PhpStorm.
 * User: DEGNI
 * Date: 20/01/2018
 * Time: 19:25
 */
$json['message']="";
$json['lien']="";

session_start();


include 'connexionBD.php';

$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// initialisation de l'objet json (la reponse)
$json['message']="Erreur serveur";
$json['lien']="";


// verification
  try{
      if(isset($_SESSION['ID_CND'])){
          $json['message']="<div class='text-danger'>Vous êtes déja connecté à un compte candidat! Veuillez d'abord vous déconnecter</div>";
          throw new Exception("decancun");
      }

      $email = filter_input(INPUT_POST,'email',FILTER_VALIDATE_EMAIL);
      if ($email===FALSE){ // email non valide
          $json["message"] = "<div class='text-danger'>EMAIL NON VALIDE!</div>";
          throw new Exception("decancun");
      }
      $req=$db->prepare("select * from candidat where EMAIL_CND =:email and ACTIF_CND='1'");
      $req->bindParam(":email", $_POST['email']);
      $req->execute();
      $donnees;
      if(!($donnees = $req->fetch())){ // voir si lemail nexiste pas
          $json["message"] = "<div class='text-danger'>Email ou mot de passe incorrect</div>!";
          throw new Exception("decancun");
      }else{ // lemail existe

          // verification du mot de passe. pour ce faire :
          // cherche l'id du compte
          $id_cnd = $donnees['ID_CND'];
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
              $json["message"] = "<div class='text-danger'>Email ou mot de passe incorrect</div>";
              throw new Exception("decancun");
          }
          //historisation de la connexion
          $req=$db->prepare("INSERT INTO connexion_cnd(ID_COMPTE_CND, ID_CND) VALUES(:id_compte_cnd, :id_cnd) ");
          $req->bindParam(":id_compte_cnd", $id_compte_cnd);
          $req->bindParam(":id_cnd", $donnees['ID_CND']);
          $req->execute();
          //recuperation des donnees de l'utilisateur
          $_SESSION['ID_CND'] = $donnees['ID_CND'] ;
          $_SESSION['NOM_CND'] = $donnees['NOM_CND'];
          $_SESSION['PRENOM_CND'] = $donnees['PRENOM_CND'];
          $_SESSION['EMAIL_CND'] = $donnees['EMAIL_CND'];




          $json["message"] = "<div class='text-success'>Candidat correctement identifié !!!</div>";
          $json['lien'] = "./orh_profil_candidat.php";

      }



  }catch(PDOException $e){
   //echo $e->getMessage();
  }catch(Exception $e){
    // echo  $e->getMessage();
  }
  echo json_encode($json);

?>