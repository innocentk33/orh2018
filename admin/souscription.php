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
//SOUSCRIPTIONS
  //candidat
$req = $db->query("select * from souscrire_cnd");
$scs_cnd = $req->fetchAll();
$nbre_sc_cnd = $req->rowCount();
  // entreprise
$req = $db->query("select * from souscrire_ent");
$scs_ent = $req->fetchAll();
$nbre_sc_ent = $req->rowCount();
//offres  lues

// offres non lues

//anciennes


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
                    <div class="card my-3 border-white" id="souscription" role="tabpanel">

                        <div class="row">
                            <h2 class="text-center col-md-12 mb-3 bg-light text-secondary">SOUSCRIPTIONS AUX SERVICES ORH <?php echo "(".($nbre_sc_cnd+$nbre_sc_ent).")" ?></h2>
                        </div>
                        <div class="row">

                            <div class="col-md-6">
                                <div class="card mt-5">
                                    <h3 class="card-header bg-info text-white text-center">
                                         Entreprise <?php echo "(".$nbre_sc_ent.")" ?>
                                    </h3>
                                    <div class="card-body">

                                        <table class="table table-striped ">
                                            <thead>
                                            <tr class="text-info">
                                                <th scope="col">SIGLE</th>
                                                <th scope="col">Service</th>
                                                <th scope="col">Souscrie le</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php

                                            foreach($scs_ent as $sc){
                                                // logo et sigle de l'entreprise
                                                $req = $db->prepare("SELECT * FROM entreprise WHERE ID_ENT=:id_ent");
                                                $req->bindParam(":id_ent", $sc['ID_ENT']);
                                                $req->execute();
                                                $ent = $req->fetch();
                                                // titre su service
                                                $req = $db->prepare("SELECT LIB_SERV_ENT FROM service_ent WHERE ID_SERV_ENT=:id_serv_ent");
                                                $req->bindParam(":id_serv_ent", $sc['ID_SERV_ENT']);
                                                $req->execute();
                                                $service = $req->fetch()['LIB_SERV_ENT'];

                                                echo "
                                     <tr>
                                     <td>
                                         <form action='entreprise.php' method='post'><button type='submit' class='btn btn-outline-info ml-auto mx-2'>"
                                                    .htmlspecialchars($ent['SIGLE_ENT']).
                                                    "</button><input type='hidden' name='id' value='".$ent['ID_ENT']."'><input type='hidden' name='ent'>
                                          </form> 
                                     </td>
                                        <td>".$service."</td>
                                        <td>".$sc['DATE_SOUSCRIRE_ENT']."</td>
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
                                         Candidat <?php echo "(".$nbre_sc_cnd.")" ?>
                                    </h3>
                                    <div class="card-body">

                                        <table class="table table-striped">
                                            <thead>
                                            <tr class="text-info">
                                                <th scope="col">Candidat</th>
                                                <th scope="col">Service</th>
                                                <th scope="col">Souscri le</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php

                                            foreach($scs_cnd as $sc){
                                                // logo , nom et prenom du candidat
                                                $req = $db->prepare("SELECT * FROM candidat WHERE ID_CND=:id_cnd");
                                                $req->bindParam(":id_cnd", $sc['ID_CND']);
                                                $req->execute();
                                                $cnd = $req->fetch();

                                                // titre su service
                                                $req = $db->prepare("SELECT LIB_SERV_CND FROM service_cnd WHERE ID_SERV_CND=:id_serv_cnd");
                                                $req->bindParam(":id_serv_cnd", $sc['ID_SERV_CND']);
                                                $req->execute();
                                                $service = $req->fetch()['LIB_SERV_CND'];

                                                echo "
                                     <tr>
                                     <td>
                                          <form action='candidat.php' method='post'><button type='submit' class='btn btn-outline-info ml-auto mx-2'>"
                                                        .htmlspecialchars($cnd['PRENOM_CND'])." ".htmlspecialchars(strtoupper($cnd['NOM_CND'])).
                                                        "</button><input type='hidden' name='id_cnd' value='".$cnd['ID_CND']."'><input type='hidden' name='cnd'>
                                          </form>
                                      </td>
                                       
                                        <td>".$service."</td>
                                        <td>".$sc['DATE_SOUSCRIRE_CND']."</td>
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


<!--***********************MODAL**********************-->
<?php
include 'inc/modal_parametre.php'
?>


<!--*************************************Script******************************-->
<script src="../js/jquery-3.2.1.min.js"></script>
<script src="../js/popper.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="./js/admin.js"></script>

</body>
</html>