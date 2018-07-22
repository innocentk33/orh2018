<?php
/**
 * Created by PhpStorm.
 * User: DEGNI
 * Date: 07/02/2018
 * Time: 13:17
 */

session_start();
include '../php/connexionBD.php';

try{
    $db->beginTransaction();

    if (!isset($_SESSION['ID_ENT'])) {
        header('Location: ../index.php');
    }

    //on recupere le nom du ficghier
    $req = $db->prepare("select PATH_OFFRE_ENT FROM offre_ent WHERE ID_OFFRE_ENT=:id_offre");
    $req->bindParam(":id_offre", $_POST['id_offre']);
    $req->execute();
    $nom = $req->fetch()['PATH_OFFRE_ENT'];

    // on supprime l'enregistrement de la bc
    $req = $db->prepare("DELETE FROM offre_ent WHERE ID_OFFRE_ENT=:id_offre");
    $req->bindParam(":id_offre", $_POST['id_offre']);
    $req->execute();
    print_r($req->errorInfo());
    //suppression du fichier
    unlink('./company/offre/'.$nom);

    $db->commit();

   header('location: ../orh_profil_entreprise');

}catch(PDOException $e){
    $db->rollBack();
    //echo $e->getMessage();

}catch(Exception $e){
    $db->rollBack();
    //echo $e->getMessage();
}

?>