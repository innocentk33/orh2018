<?php

/**
 * Created by PhpStorm.
 * User: DEGNI
 * Date: 20/01/2018
 * Time: 19:25
 */
session_start();
include 'connexionBD.php';

$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// initialisation de l'objet json (la reponse)
$json['message']="Erreur serveur";
$json['lien']="";
// verification
  try{
      if(isset($_SESSION['ID_ENT'])){
          $json['message']="<div class='text-danger'>Vous êtes déja connecté à un compte entreprise! Veuillez d'abord vous déconnecter</div>";
          throw new Exception("decancun");
      }
      $email = filter_input(INPUT_POST,'email',FILTER_VALIDATE_EMAIL);
      if ($email===FALSE){ // email non valide
          $json["message"] = "<div class='text-danger'>EMAIL NON VALIDE!</div>";
          throw new Exception("decancun");
      }
      $req=$db->prepare("select * from entreprise where EMAIL_ENT =:email and ACTIF_ENT='1'");
      $req->bindParam(":email", $_POST['email']);
      $req->execute();
      $donnees;
      if(!($donnees = $req->fetch())){ // voir si lemail nexiste pas
          $json["message"] = "<div class='text-danger'>Email ou mot de passe incorrect</div>";
          throw new Exception("decancun");
      }else{ // lemail existe

          // verification du mot de passe. pour ce faire :
          // cherche l'id du compte
          $id_ent = $donnees['ID_ENT'];
          $req=$db->prepare("select ID_COMPTE_ENT from creer_compte_ent where ID_ENT=:id_ent");
          $req->bindParam(":id_ent", $id_ent);
          $req->execute();

          $id_compte_ent = $req->fetch()["ID_COMPTE_ENT"];
          //comparaison du mot de passe avec celui dans le compte
          $req=$db->prepare("select MDP_COMPTE_ENT from compte_ent where ID_COMPTE_ENT=:id_compte_ent");
          $req->bindParam(":id_compte_ent", $id_compte_ent);
          $req->execute();
          $mdp = $req->fetch()["MDP_COMPTE_ENT"];

          if( $mdp != sha1($_POST['mdp']) ){
              $json["message"] = "<div class='text-danger'>Email ou mot de passe incorrect</div>";
              throw new Exception("decancun");
          }
          //historisation de la connexion
          $req=$db->prepare("INSERT INTO connexion_ent(ID_COMPTE_ENT, ID_ENT) VALUES(:id_compte_ent, :id_ent) ");
          $req->bindParam(":id_compte_ent", $id_compte_ent);
          $req->bindParam(":id_ent", $donnees['ID_ENT']);
          $req->execute();

          $_SESSION['ID_ENT'] = $donnees['ID_ENT'] ;
          $_SESSION['SIGLE_ENT'] = $donnees['SIGLE_ENT'];
          $_SESSION['EMAIL_ENT'] = $donnees['EMAIL_ENT'];
          $_SESSION['ID_INTER'] = $donnees['ID_INTER'];
          $_SESSION['ID_STATUT_ENT'] = $donnees['ID_STATUT_ENT'];
          $json["message"] = "<div class='text-success'>Entreprise correctement identifiée!</div>";
          $json['lien'] = "./orh_profil_entreprise.php";

      }



  }catch(PDOException $e){
      $e->getMessage();
  }catch(Exception $e){
      $e->getMessage();
  }
  echo json_encode($json);


?>