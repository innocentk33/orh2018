<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Orh</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/windows10_icon.css">
    <link rel="stylesheet" href="css/styleA.css">

</head>
<body class="bg-light">
<?php
/**
 * Created by PhpStorm.
 * User: inno-kirito
 * Date: 17/01/2018
 * Time: 21:59
 */
session_start();
session_cache_limiter('no-cahe');

if(!isset($_SESSION['ID_ADMIN'])){
    header('Location: index.php');
}

include '../php/connexionBD.php';

//anciens
if(!empty($_POST)){
    if(!empty($_POST['id'])){
        $req = $db->prepare("select * from entreprise WHERE ACTIF_ENT='1' and ID_ENT =:id_ent");
        $req->bindParam(":id_ent", $_POST['id']);

    } else{
        $req = $db->prepare("select * from entreprise WHERE ACTIF_ENT='1' and SIGLE_ENT regexp(:rech) and ID_STATUT_ENT regexp(:statut)");
        $_POST['rech'] = (!empty($_POST['rech']))?$_POST['rech']:'.';
        $_POST['statut'] = (!empty($_POST['statut']))?$_POST['statut']:'.';
        $req->bindParam(":rech", $_POST['rech']);
        $req->bindParam(":statut", $_POST['statut']);
    }

}else{
    $req = $db->prepare("select * from entreprise WHERE ACTIF_ENT='1' and ID_ENT in (select ID_ENT from voir_ent )");
}


$req->execute();
$entreprises = $req->fetchAll();
$nbre_ent = $req->rowCount();

// statut entreprise /validé-- non validé
$req = $db->prepare("select * from statut_ent");
$req->execute();
$statuts = $req->fetchAll();
?>
<div class="container-fluid">
    <div class="row">
        <?php
        include 'inc/sidebar.php';
        //historisation insertation dans la table des entreprises vues

        foreach ($newEntreprises as $ent){
            $req=$db->prepare("insert into voir_ent(ID_ADMIN, ID_ENT) values(:id_admin, :id_ent)");
            $req->bindParam(":id_admin", $_SESSION['ID_ADMIN']);
            $req->bindParam(":id_ent", $ent['ID_ENT']);
            $req->execute();
        }
        ?>

        <div class="col-md-10">
            <?php
            include 'inc/navbar.php'
            ?>

            <!--Dashboard***************************************-->
            <div class="container-fluid bg-white">
                <div class="" id="sidebarContent">
                    <!--LISTE DES ENTREPRISES-->
                    <div class="" id="entreprise" role="tabpanel">

                        <?php
                        if($nbre_NewEnt!=0){
                        ?>

                        <div class="card mt-5">
                            <h3 class="card-header bg-success text-white text-center">
                                <i class="fa fa-building-o"></i> ENTREPRISE(S) RECEMMENT(S) INSCRITE(S)</h3>
                            <div class="card-body">

                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th scope="col">Sigle</th>
                                        <th scope="col">Nom inter.</th>
                                        <th scope="col">Genre inter.</th>
                                        <th scope="col">Contact inter.</th>
                                        <th scope="col">Email inter.</th>

                                    </tr>
                                    </thead>
                                    <?php
                                    foreach ($newEntreprises as $ent){
                                        //info interlocuteur
                                        $req=$db->prepare("SELECT * FROM interlocuteur WHERE ID_INTER=:id_inter ");
                                        $req->bindParam(":id_inter", $ent['ID_INTER']);
                                        $req->execute();
                                        $inter = $req->fetch();
                                        // genre
                                        $req=$db->prepare("SELECT LIB_GENRE FROM genre WHERE ID_GENRE=:id_genre ");
                                        $req->bindParam(":id_genre", $inter['ID_GENRE']);
                                        $req->execute();
                                        $genre_inter = $req->fetch()['LIB_GENRE'];




                                        echo "<tr>
                                        
                                        <td scope='row'>".htmlspecialchars($ent['SIGLE_ENT'])."</td>
                                        <td>".htmlspecialchars(strtoupper($inter['NOM_INTER']))."</td>
                                        <td>".$genre_inter."</td>
                                        <td>".htmlspecialchars($inter['TEL_INTER'])."</td>
                                        <td>".htmlspecialchars($inter['EMAIL_INTER'])."</td>
                                        <td>
                                        <button class='btn btn-outline-info ml-auto mx-2'  data-target='#".$ent['ID_ENT']."' data-toggle='modal' >+ d'info</button>
                                        <button  class='btn btn-outline-success ml-auto mx-2'  >Valider</button>
                                     </td>
                                    </tr>";

                                    }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <?php
                        }
                        ?>



                            <div class="card">
                                <div class="card-body">
                                    <form method="post" action="entreprise.php?ent">

                                        <div class="form-row">
                                            <div class="form-group col-md-3">

                                                <label for="rech" class="text-info"><strong>Sigle</strong></label>
                                                <input placeholder="Indice dans le sigle" name="rech" class="form-control form-control-sm" type="search" />
                                            </div>

                                            <div class="form-group col-md-3">
                                                <label for="statut" class="text-info"><strong>Statut</strong></label>
                                                <select name="statut" class="form-control form-control-sm" id="statut" >
                                                    <option value="" selected disabled>Peu importe</option>
                                                    <?php
                                                    foreach ($statuts as $result){
                                                        echo "<option value='".$result['ID_STATUT_ENT']."'>".$result['LIB_STATUT_ENT']."</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </div>

                                        </div>


                                        <input type="hidden" name="ent">

                                        <input type="submit" class="btn btn-outline-primary " id="send" value="Rechercher">


                                    </form>
                                </div>

                            </div>


                        <div class="card mt-5">

                            <h3 class="card-header bg-info text-white text-center">
                                <i class="fa fa-building-o"></i> ENTREPRISE(S)</h3>
                            <div class="card-body">

                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th scope="col">Sigle</th>
                                        <th scope="col">Nom inter.</th>
                                        <th scope="col">Genre inter.</th>
                                        <th scope="col">Contact inter.</th>
                                        <th scope="col">Email inter.</th>

                                    </tr>
                                    </thead>

                                    <?php
                                    foreach ($entreprises as $ent){
                                        // offre
                                        $req=$db->prepare("SELECT OFFRE_STATUT_ENT FROM statut_ent WHERE ID_STATUT_ENT=:id_statut ");
                                        $req->bindParam(":id_statut", $ent['ID_STATUT_ENT']);
                                        $req->execute();
                                        $statut = $req->fetch()['OFFRE_STATUT_ENT'];

                                        //info interlocuteur
                                        $req=$db->prepare("SELECT * FROM interlocuteur WHERE ID_INTER=:id_inter ");
                                        $req->bindParam(":id_inter", $ent['ID_INTER']);
                                        $req->execute();
                                        $inter = $req->fetch();
                                        // genre
                                        $req=$db->prepare("SELECT LIB_GENRE FROM genre WHERE ID_GENRE=:id_genre ");
                                        $req->bindParam(":id_genre", $inter['ID_GENRE']);
                                        $req->execute();
                                        $genre_inter = $req->fetch()['LIB_GENRE'];


                                        echo "<tr>
                                        
                                        <td scope='row'>".htmlspecialchars($ent['SIGLE_ENT'])."</td>
                                        <td>".htmlspecialchars(strtoupper($inter['NOM_INTER']))."</td>
                                        <td>".$genre_inter."</td>
                                        <td>".htmlspecialchars($inter['TEL_INTER'])."</td>
                                        <td>".htmlspecialchars($inter['EMAIL_INTER'])."</td>
                                        <td>
                                        <button class='btn btn-outline-info ml-auto mx-2'  data-target='#".$ent['ID_ENT']."' data-toggle='modal' >+ d'info</button>";
                                        if($statut==0)//entreprise non validee
                                        echo "<form method='post' action='./php/validerEntreprise.php'>
                                                <input type='hidden' name='id_ent' value='".$ent['ID_ENT']."'>
                                                <button  type='submit' class='btn btn-outline-success ml-auto mx-2' >Valider</button>
                                                  </form>";
                                        else //sinon
                                            echo "<form method='post' action='./php/invaliderEntreprise.php'>
                                                <input type='hidden' name='id_ent' value='".$ent['ID_ENT']."'>
                                                <button  type='submit' class='btn btn-outline-danger ml-auto mx-2' >Invalider</button>
                                                  </form>";
                                        echo "
                                     </td>
                                    </tr>";

                                    }
                                    ?>
                                    </tbody>
                                </table>
                            </div>

                        </div>




                    </div>


                    <div class="tab-pane fade" id="admin" role="tabpanel">admin</div>


                </div>


            </div>
        </div>
    </div>
</div>
</div>


<!--***********************MODAL**********************-->
<?php
include 'inc/modal_ent.php';
include 'inc/modal_parametre.php'
?>


<!--*************************************Script******************************-->
<script src="../js/jquery-3.2.1.min.js"></script>
<script src="../js/popper.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="./js/admin.js"></script>

</body>
</html>