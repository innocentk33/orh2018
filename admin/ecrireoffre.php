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
        ?>

        <div class="col-md-10">
            <?php
            include 'inc/navbar.php'
            ?>

            <!--Dashboard***************************************-->
            <div class="container-fluid bg-white">
                <div class="" id="sidebarContent">
                    <!--ECRIRE UNE OFFRE-->
                    <div class="" id="ecrireOffres" role="tabpanel">
                        <div class="card bg-transparent my-4">
                            <h3 class="card-header bg-dark text-white"> Ecrire une offre
                            </h3>
                            <div class="card-body">
                                <form action="php/offres.php" method="post" >
                                    <div class="form-group">
                                        <label for="offre">Corps de l'offre</label>
                                        <textarea class="form-control" name="offre" id="offre"></textarea>
                                        <label for="date_exp">Date d'expiration</label>
                                        <input type="date" class="form-control" id="date_exp" name="date_exp" required>
                                        <input type="hidden" name="update"><!--si ce champ est defini il s'agira d'une modif/ ceci est fait coté js a lappui du bouton modifier-->
                                        <div class="mt-3">
                                            <input type="submit" value="Valider" class="btn btn-outline-primary">
                                            <input type="reset" class="btn btn-outline-danger">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <?php
                        if($nbre_offre_exp !=0){
                        ?>
                        <div class="card mt-5">
                            <h3 class="card-header bg-danger text-white">Offre(s) expirée(s)</h3>
                            <div class="card-body">

                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th scope="col">Offre</th>
                                        <th scope="col">Expire le</th>
                                        <th scope="col"></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php

                                    foreach($offres_exp as $offre){


                                        echo "
                                     <tr>
                                        <td scope='row'>".$offre['OFFRE_SITE']."</td>
                                        <td>".$offre['DATE_EXPIRATION']."</td>
                                        <td>
                                            <button class='btn btn-outline-success' data-target='#modalModifierOffre'
                                                    data-toggle='modal'>Modifier
                                            </button>
                                            <form action='./php/supp_offre_site.php' method='post'>
                                                <input type='hidden' name='id_offre' value='".$offre['ID_OFFRE_SITE']."'>
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

                        <?php
                        if($nbre_offre_site !=0){
                        ?>
                        <div class="card mt-5">
                            <h3 class="card-header bg-info text-white">Offre(s) non expirée(s)</h3>
                            <div class="card-body">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th scope="col">Offre</th>
                                        <th scope="col">Expire le</th>
                                        <th scope="col"></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php

                                    foreach($offres as $offre){


                                        echo "<tr>
                                        <td scope='row'>".$offre['OFFRE_SITE']."</td>
                                        <td>".$offre['DATE_EXPIRATION']."</td>
                                        <td>
                                            <button class='btn btn-outline-success' data-target='#modalModifierOffre'vdata-toggle='modal'>Modifi</button>
                                            <form action='./php/supp_offre_site.php' method='post'>
                                                <input type='hidden' name='id_offre' value='".$offre['ID_OFFRE_SITE']."'>
                                                <button type='submit' 
                                                class='btn btn-outline-danger'
                                                data-toggle='confirmation'
                                                data-btn-ok-label='confirmer' data-btn-ok-icon='glyphicon glyphicon-share-alt'
                                                data-btn-ok-class='btn-success'
                                                data-btn-cancel-label='Annuler' 
                                                data-btn-cancel-icon='glyphicon glyphicon-ban-circle'
                                                data-btn-cancel-class='btn-danger'
                                                data-title='Supprimer ?' 
                                                data-content='Vous allez supprimer une offre' >
                                                Supprimer
                                                </button>
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


<!--***********************MODAL**********************-->
<?php
include 'inc/modal_parametre.php'
?>


<!--*************************************Script******************************-->
<script src="../js/jquery-3.2.1.min.js"></script>
<script src="../js/popper.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/bootstrap-confirmation.js"></script>
<script src="./js/admin.js"></script>

<script src="//cdn.ckeditor.com/4.8.0/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace('offre');
</script>

</body>
</html>