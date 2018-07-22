<?php
/**
 * Created by PhpStorm.
 * User: inno-kirito
 * Date: 26/01/2018
 * Time: 02:47
 */

session_start();


include 'connexionBD.php';

  try{
      if (!isset($_SESSION['ID_CND'])) {
          header('Location: index.php');
      }
          $req=$db->prepare("INSERT INTO souscrire_cnd(ID_SERV_CND, ID_CND) VALUES(:id_serv_cnd, :id_cnd) ");
          $req->bindParam(":id_serv_cnd", $_POST['id_service']);
          $req->bindParam(":id_cnd", $_SESSION['ID_CND']);
          $req->execute();
      header('location: ../orh_profil_candidat.php');

  }catch(PDOException $e){
      echo $e->getMessage();
  }catch(Exception $e){
      echo  $e->getMessage();
  }

?>