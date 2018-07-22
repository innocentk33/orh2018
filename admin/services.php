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

//SERVICES
  //candidats
$req = $db->query("select * from service_cnd");
$servs_cnd = $req->fetchAll();


 //entreprise
$req = $db->query("select * from service_ent");
$servs_ent = $req->fetchAll();



?>
<div class="container-fluid">
    <div class="row">
        <?php
        include 'inc/sidebar.php';
        ?>

        <div class="col-md-10">
            <?php
            include 'inc/navbar.php'
            ?>

            <!--Dashboard***************************************-->
            <div class="container-fluid bg-white">
                <div class="" id="sidebarContent">
                    <!--SERVICE ET FORMATION**************************************************************-->
                    <div class="card" id="service" role="tabpanel">
                        <div class="row">
                            <h2 class="text-center col-md-12 mb-3 bg-light text-secondary"><strong>SERVICES ORH</strong><?php ///echo "(".($nbre_sc_cnd+$nbre_sc_ent).")" ?></h2>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card my-4">
                                    <h3 class="card-header bg-dark text-white"> Ajouter un service <b>entreprise</b>
                                    </h3>
                                    <div class="card-body">
                                        <form action="php/service_ent.php" method="post" enctype="multipart/form-data">
                                            <div class="form-group">
                                                <label for="titre_ent">Nom service </label>
                                                <input type="text" class="form-control" id="titre_ent"
                                                       name="titre_ent" required>
                                                <label for="desc_ent">Corps du service </label>
                                                <textarea class="form-control" name="desc_ent"
                                                          id="desc_ent"></textarea>
                                                <div class="mt-3">
                                                    <input type="submit" name="valide" class="btn btn-outline-primary">
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card my-4">
                                    <h3 class="card-header bg-primary text-white"> Ajouter un service <b>candidat</b>
                                    </h3>
                                    <div class="card-body">
                                        <form action="php/service_cnd.php" method="post" enctype="multipart/form-data">
                                            <div class="form-group">
                                                <label for="titre_cnd">Nom service </label>
                                                <input type="text" class="form-control" id="titre_cnd"
                                                       name="titre_cnd" required>
                                                <label for="desc_cnd">Corps du service </label>
                                                <textarea class="form-control" name="desc_cnd"
                                                          id="desc_cnd" required></textarea>
                                                <div class="mt-3">
                                                    <input type="submit" name="valider" class="btn btn-outline-primary">
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="card mt-5">
                            <h3 class="card-header">

                            </h3>
                            <div class="card-body">
                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="card mt-5">
                                            <h3 class="card-header bg-info text-white text-center">
                                                Entreprise <?php //echo "(".$nbre_sc_ent.")" ?>
                                            </h3>
                                            <div class="card-body">

                                                <table class="table table-striped ">
                                                    <thead>
                                                    <tr class="text-info">
                                                        <th scope="col">Titre</th>
                                                        <th scope="col">Description</th>
                                                        <th scope="col">Ecrire le</th>
                                                        <th scope="col"></th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>

                                                    <?php
                                                    foreach($servs_ent as $serv){

                                                        echo "
                                     <tr>
                                        <td scope='row'>".$serv['LIB_SERV_ENT']."</td>
                                        <td>".$serv['DESC_SERV_ENT']."</td>
                                        <td>".$serv['DATE_SERV_ENT']."</td>
                                        <td>
                                            <form action='./php/supp_service_ent.php' method='post'>
                                                <input type='hidden' name='id' value='".$serv['ID_SERV_ENT']."'>
                                                <button type='submit' class='btn btn-outline-danger'>Supprimer</button>
                                            </form>
                                         </td>
                                    </tr>";



                                                    }
                                                    ?>

                                                    </tbody>
                                                </table>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="card mt-5">
                                            <h3 class="card-header bg-info text-white text-center">
                                                Candidat <?php //echo "(".$nbre_sc_cnd.")" ?>
                                            </h3>
                                            <div class="card-body">

                                                <table class="table table-striped">
                                                    <thead>
                                                    <tr class="text-info">
                                                        <th scope="col">Titre</th>
                                                        <th scope="col">Description</th>
                                                        <th scope="col">Ecrire le</th>
                                                        <th scope="col"></th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php

                                                    foreach($servs_cnd as $serv){

                                                        echo "
                                     <tr>
                                        <td scope='row'>".$serv['LIB_SERV_CND']."</td>
                                        <td>".$serv['DESC_SERV_CND']."</td>
                                        <td>".$serv['DATE_SERV_CND']."</td>
                                        <td>
                                            <form action='./php/supp_service_cnd.php' method='post'>
                                                <input type='hidden' name='id' value='".$serv['ID_SERV_CND']."'>
                                                <button type='submit' class='btn btn-outline-danger'>Supprimer</button>
                                            </form>
                                         </td>
                                    </tr>";



                                                    }

                                                    ?>

                                                    </tbody>
                                                </table>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>


                    </div>


                </div>


            </div>
        </div>
    </div>
</div>
</div>


<!--***********************MODAL**********************-->
<?php
include 'inc/modal_parametre.php'
?>

<!--*************************************Script******************************-->
<script src="../js/jquery-3.2.1.min.js"></script>
<script src="../js/popper.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="./js/admin.js"></script>

<script src="//cdn.ckeditor.com/4.8.0/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace('desc_cnd');
</script>
<script>
    CKEDITOR.replace('desc_ent');
</script>
</body>
</html>