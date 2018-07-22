<?php
/**
 * Created by PhpStorm.
 * User: DEGNI
 * Date: 08/03/2018
 * Time: 22:16
 */

session_start();
include '../../php/connexionBD.php';

$json['message'] = "";

try{
$req = $db->prepare("select * from admin where ID_ADMIN =:id_admin AND MDP_ADMIN=:mdp");
    $mdp = sha1($_POST['mdp']);
    $req->bindParam(":id_admin", $_SESSION['ID_ADMIN']);
    $req->bindParam(":mdp", $mdp);
    $req->execute();
    if(!$req->fetch() ){ // verification du mot de passe
        $json['message'] = "<div class='text-danger'>Mot de passe incorrète</div>";
        throw new Exception();
    }
    $pseudo = !empty($_POST['pseudo'])?$_POST['pseudo']:$_SESSION['PSEUDO_ADMIN'];
    $email = !empty($_POST['email'])?$_POST['email']:$_SESSION['EMAIL_ADMIN'];

    if( !empty($_POST['mdpNew']) && !empty($_POST['mdpConfirm']) ){  // si les mots de passes NE SONT pas vide

        if($_POST['mdpNew'] != $_POST['mdpConfirm']){
            $json['message'] = "<div class='text-danger'>Mots de passe différents.</div>";
            throw new Exception();
        }


        $req = $db->prepare("update admin set PSEUDO_ADMIN =:pseudo, MDP_ADMIN=:mdp, EMAIL_ADMIN=:email where ID_ADMIN=:id_admin");
        $mdp = sha1($_POST['mdpNew']);
        $req->bindParam(":pseudo", $pseudo);
        $req->bindParam(":mdp", $mdp);
        $req->bindParam(":email", $email);
        $req->bindParam(":id_admin", $_SESSION['ID_ADMIN']);

    }if( !empty($_POST['mdpNew']) && !empty($_POST['mdpConfirm']) ){  // si les mots de passes SONT pas vide

        $req = $db->prepare("update admin set PSEUDO_ADMIN =:pseudo, EMAIL_ADMIN=:email where ID_ADMIN=:id_admin");
        $req->bindParam(":pseudo", $pseudo);
        $req->bindParam(":email", $email);
        $req->bindParam(":id_admin", $_SESSION['ID_ADMIN']);

    }else{ // si l'un des 2 est vide

        $json['message'] = "<div class='text-danger'>Mots de passe différents.</div>";
        throw new Exception();
    }


    $json['message'] = "<div class='text-danger'>Modification éffectuées avec succès!</div>";

}catch(PDOException $e){
    echo $e->getMessage();

}catch(Exception $e){
    echo $e->getMessage();
}
json_encode($json);

?>