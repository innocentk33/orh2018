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

if (!isset($_SESSION['ID_ADMIN'])) {
    header('Location: index.php');
}

include '../php/connexionBD.php';






?>
<div class="container-fluid">
    <div class="row">
        <?php
        include 'inc/sidebar.php';
        //historisation
        foreach ($newOffres as $new){
            $req=$db->prepare("insert into voir_offre_ent(ID_ADMIN, ID_OFFRE_ENT) values(:id_admin, :id_offre)");
            $req->bindParam(":id_admin", $_SESSION['ID_ADMIN']);
            $req->bindParam(":id_offre", $new['ID_OFFRE_ENT']);
            $req->execute();

        }
        ?>
        <div class="col-md-10">
            <?php
            include 'inc/navbar.php';

            ?>

            <!--Dashboard***************************************-->
            <div class="container-fluid bg-white">
                <div class="tab-content" id="sidebarContent">
                    <!--GESTION DES CV*************-->
                    <!--OFRES EMPLOI-->
                    <?php
                    if($nbre_offre_ent!=0){
                    ?>
                    <div id="offres">
                        <div class="card my-3">
                            <h3 class="card-header bg-success text-white">
                                <i class="fa fa-folder-open-o"></i> Offres D'emploi non vue(s)</h3>
                            <div class="card-body">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th scope="col">Entreprise</th>
                                        <th scope="col">Envoyé le</th>
                                        <th scope="col">Nom inter.</th>
                                        <th scope="col">Genre inter.</th>
                                        <th scope="col">Contact inter.</th>
                                        <th scope="col">Email inter.</th>
                                        <th scope="col">Contenu de l'offre</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php

                                    foreach($newOffres as $new){
                                        //informations sur l'entreprise
                                        $req = $db->prepare("select * from entreprise where ID_ENT=(select ID_ENT from offre_ent where ID_OFFRE_ENT=:id_offre)");
                                        $req->bindParam(":id_offre", $new['ID_OFFRE_ENT']);
                                        $req->execute();
                                        $ent = $req->fetch();
                                        //date d'envoi
                                        $date_envoi= $new['DATE_OFFRE_ENT'];
                                        // nom genre contact t mail de l'interlocuteur
                                        $req = $db->prepare("select * from interlocuteur where ID_INTER=:id_inter");
                                        $req->bindParam(":id_inter", $ent['ID_INTER']);
                                        $req->execute();
                                        $inter = $req->fetch();
                                        //genre
                                        $req = $db->prepare("select LIB_GENRE from genre where ID_GENRE=:id_genre");
                                        $req->bindParam(":id_genre", $inter['ID_GENRE']);
                                        $req->execute();
                                        $genre = $req->fetch()['LIB_GENRE'];

                                        echo "<tr>
                                        <td scope='row'>
                                       <form action='entreprise.php' method='post'><button type='submit' class='btn btn-outline-info ml-auto mx-2'>"
                                            .htmlspecialchars($ent['SIGLE_ENT']).
                                            "</button><input type='hidden' name='id' value='".$ent['ID_ENT']."'><input type='hidden' name='ent'></form>
                                       </td> 
                                        <td>".$date_envoi."</td>
                                        <td>".htmlspecialchars(strtoupper($inter['NOM_INTER']))."</td>
                                        <td>$genre</td>
                                        <td>".htmlspecialchars($inter['TEL_INTER'])."</td>
                                        <td>".htmlspecialchars($inter['EMAIL_INTER'])."</td>
                                        <td>
                                            <a href=../php/company/offre/".$new['PATH_OFFRE_ENT']." target='_blank' class='btn btn-outline-primary'>Voir</a>
                                            <a href=../php/company/offre/".$new['PATH_OFFRE_ENT']." download='".$ent['SIGLE_ENT']."_".$date_envoi.".pdf' class='btn btn-outline-success'>Télécharger</a>
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
                        <div class="card my-3">
                            <h3 class="card-header bg-info text-white">
                                <i class="fa fa-folder-open-o"></i> Offres D'emploi vue(s)</h3>
                            <div class="card-body">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th scope="col">Entreprise</th>
                                        <th scope="col">Envoyé le</th>
                                        <th scope="col">Nom inter.</th>
                                        <th scope="col">Genre inter.</th>
                                        <th scope="col">Contact inter.</th>
                                        <th scope="col">Email inter.</th>
                                        <th scope="col">Contenu de l'offre</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php

                                    foreach($OldOffres as $old){
                                        //informations sur l'entreprise
                                        $req = $db->prepare("select * from entreprise where ID_ENT=(select ID_ENT from offre_ent where ID_OFFRE_ENT=:id_offre)");
                                        $req->bindParam(":id_offre", $old['ID_OFFRE_ENT']);
                                        $req->execute();
                                        $ent = $req->fetch();
                                        //date d'envoi
                                        $date_envoi= $old['DATE_OFFRE_ENT'];
                                        // nom genre contact t mail de l'interlocuteur
                                        $req = $db->prepare("select * from interlocuteur where ID_INTER=:id_inter");
                                        $req->bindParam(":id_inter", $ent['ID_INTER']);
                                        $req->execute();
                                        $inter = $req->fetch();
                                        //genre
                                        $req = $db->prepare("select LIB_GENRE from genre where ID_GENRE=:id_genre");
                                        $req->bindParam(":id_genre", $inter['ID_GENRE']);
                                        $req->execute();
                                        $genre = $req->fetch()['LIB_GENRE'];

                                        echo "<tr>
                                        <td scope='row'>
                                       <form action='entreprise.php' method='post'><button type='submit' class='btn btn-outline-info ml-auto mx-2'>"
                                            .htmlspecialchars($ent['SIGLE_ENT']).
                                            "</button><input type='hidden' name='id' value='".$ent['ID_ENT']."'><input type='hidden' name='ent'></form>
                                       </td>
                                       
                                        <td>".$date_envoi."</td>
                                        <td>".htmlspecialchars(strtoupper($inter['NOM_INTER']))."</td>
                                        <td>$genre</td>
                                        <td>".htmlspecialchars($inter['TEL_INTER'])."</td>
                                        <td>".htmlspecialchars($inter['EMAIL_INTER'])."</td>
                                        <td>
                                            <a href=../php/company/offre/".$old['PATH_OFFRE_ENT']." target='_blank' class='btn btn-outline-primary'>Voir</a>
                                            <a href=../php/company/offre/".$old['PATH_OFFRE_ENT']." download='".$ent['SIGLE_ENT']."_".$date_envoi.".pdf' class='btn btn-outline-success'>Télécharger</a>
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