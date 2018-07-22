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

?>
<div class="container-fluid">
    <div class="row">
        <?php
        include 'inc/sidebar.php';
        // certaines variables sont definie dans le sidebar qui est inclu dans ce fichier
        //historisation cad mettre dans les cv lus
        foreach ($NewCvs as $Newcv){  //newscv se trouve dans inc/sidebar
            $req=$db->prepare("insert into voir_cv(ID_ADMIN, ID_CV) values(:id_admin, :id_cv)");
            $req->bindParam(":id_admin", $_SESSION['ID_ADMIN']);
            $req->bindParam(":id_cv", $Newcv['ID_CV']);
            $req->execute();

        }
        ?>


        <div class="col-md-10">
            <?php
            include 'inc/navbar.php'
            ?>
            <!--Dashboard***************************************-->
            <div class="container-fluid bg-white">
                <div class=" card mt-2" id="gestionCv">
                    <?php
                    if($nbrecv!=0){
                    ?>
                    <div class="card my-4">
                        <h3 class="card-header bg-success text-white">
                            <i class="fa fa-file-pdf-o"></i> Curiculum Vitae non vu(s)
                        </h3>
                        <div class='card-body'>

                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th scope="col">Candidat</th>
                                    <th scope="col">Envoyé le</th>
                                    <th scope="col"></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php

                                foreach($NewCvs as $cv){
                                    $date = $cv['DATE_MODIF_CV'];
                                    //proprio
                                    $req = $db->prepare("SELECT * FROM candidat WHERE ID_CND=:id_cnd");
                                    $req->bindParam(":id_cnd", $cv['ID_CND']);
                                    $req->execute();
                                    $cnd = $req->fetch();
                                    $nom = $cnd['NOM_CND'];
                                    $prenom = $cnd['PRENOM_CND'];

                                    echo "<tr>
                                       <td scope='row'>
                                       <form action='candidat.php?' method='post'><button type='submit' class='btn btn-outline-info ml-auto mx-2'>"
                                        .htmlspecialchars($prenom)." ".htmlspecialchars(strtoupper($nom)).
                                        "</button><input type='hidden' name='id_cnd' value='".$cv['ID_CND']."'><input type='hidden' name='cnd'></form></td>
                                       
                                        <td>".$date."</td>
                                        <td>
                                        <a href='../php/user/cv/".$cv['LIB_CV']."' class='btn btn-outline-success ml-auto mx-2' target='_blank' >Voir CV</a>
                                        <a href='../php/user/cv/".$cv['LIB_CV']."' class='btn btn-outline-primary' download='".$nom.".pdf'>Telecharger CV</a>
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
                    <div class="card mt-3">
                        <h3 class="card-header bg-info text-white">
                            <i class="fa fa-file-pdf-o"></i> Curiculum Vitae vu(s)
                        </h3>
                        <div class='card-body'>

                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th scope="col">Candidat</th>
                                    <th scope="col">Envoyé le</th>
                                    <th scope="col"></th>
                                </tr>
                                </thead>
                        <?php
                        foreach ($cvs as $cv){
                            $date = $cv['DATE_MODIF_CV'];
                            //proprio
                            $req = $db->prepare("SELECT * FROM candidat WHERE ID_CND=:id_cnd");
                            $req->bindParam(":id_cnd", $cv['ID_CND']);
                            $req->execute();
                            $cnd = $req->fetch();
                            $nom = $cnd['NOM_CND'];
                            $prenom = $cnd['PRENOM_CND'];

                            echo "<tr>
                                       <td scope='row'>
                                       <form action='candidat.php?' method='post'><button type='submit' class='btn btn-outline-info ml-auto mx-2'>"
                                        .htmlspecialchars($prenom)." ".htmlspecialchars(strtoupper($nom)).
                                       "</button><input type='hidden' name='id_cnd' value='".$cv['ID_CND']."'><input type='hidden' name='cnd'></form></td>
                                       
                                        <td>".$date."</td>
                                        <td>
                                        <a href='../php/user/cv/".$cv['LIB_CV']."' class='btn btn-outline-success ml-auto mx-2' target='_blank' >Voir CV</a>
                                        <a href='../php/user/cv/".$cv['LIB_CV']."' class='btn btn-outline-primary' download='".$nom.".pdf'>Telecharger CV</a>
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
    CKEDITOR.replace('article');
</script>
<script>
    CKEDITOR.replace('description');
</script>
</body>
</html>