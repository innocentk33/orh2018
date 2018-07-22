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
//ACTUALITEES

$req = $db->query("select * from actualite ORDER BY DATE_ECRIRE_ACT DESC");
$acts = $req->fetchAll();
$nbre_act = $req->rowCount();



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
                <div class="tab-content" id="sidebarContent">
                    <!-- ECRIRE ACTUALITE*****************************************-->
                    <div class="" id="actualite" role="tabpanel">
                        <div class="card my-4">
                            <h3 class="card-header bg-dark text-white"> Ecrire une Actualité
                            </h3>
                            <div class="card-body">
                                <form action="php/actualite.php" method="post" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label for="titreActu">Titre </label>
                                        <input type="text" class="form-control" id="titreActu" name="titre" required>
                                        <label for="img">Image de l'actualité </label>
                                        <input type="file" class="form-control" id="img" name="img" accept="image/*">
                                        <label for="act">Corps de l'actualité </label>
                                        <textarea class="form-control" name="desc" id="article" required></textarea>
                                        <div class="mt-3">
                                            <input type="submit" name="valide" class="btn btn-outline-primary">
                                            <input type="reset" class="btn btn-outline-danger">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <?php
                        if($nbre_act!=0){
                        ?>
                        <div class="card mt-5">
                            <h3 class="card-header bg-info text-white">ACTUALITEE(S)</h3>
                            <div class="card-body">

                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th scope="col"></th>
                                        <th scope="col">Titre</th>
                                        <th scope="col">Description</th>
                                        <th scope="col">Publié le</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php

                                    foreach($acts as $act){

                                        echo "
                                     <tr>
                                        <td scope='row'><img width='100px' height='70px' src='./php/actualite/".$act['PATH_IMG_ACT']."'/></td>
                                        <td>".$act['LIB_ACT']."</td>
                                        <td>".$act['DESC_ACT']."</td>
                                        <td>".$act['DATE_ECRIRE_ACT']."</td>
                                        <td>
                                            <button class='btn btn-outline-info' data-target='#modalModifierOffre'
                                                    data-toggle='modal'>Modifier
                                            </button>
                                            <form action='./php/supp_act.php' method='post'>
                                                <input type='hidden' name='id_act' value='".$act['ID_ACT']."'>
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

                        <?php
                        }
                        ?>

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
<script src="../js/bootstrap.min.js"></script>4
<script src="./js/admin.js"></script>

<script src="//cdn.ckeditor.com/4.8.0/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace('article');
</script>


</body>
</html>