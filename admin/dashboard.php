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
//entreprises
$req = $db->query("select * from entreprise WHERE ACTIF_ENT='1'");
$entreprises = $req->fetchAll();
$nbre_ent = $req->rowCount();
//non validees

//validees

//candidats
$req = $db->query("select * from candidat WHERE ACTIF_CND='1'");
$candidats = $req->fetchAll();
$nbre_cnd = $req->rowCount();
//nouveaux candidats

//anciens candidats

//cv
$req = $db->query("select * from cv");
$cvs = $req->fetchAll();
$nbre_cv = $req->rowCount();
//anciens cv

//nouveaux cv

//offre
$req = $db->query("select * from offre_ent");
$offres = $req->fetchAll();
$nbre_offre = $req->rowCount();
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
                <div class="tab-content" id="sidebarContent">

                    <!--TABLEAU DE BORD***************************************************-->
                    <div class="tab-pane fade show active" id="tableauDeBord" role="tabpanel">
                        <div id="boxInfo" class=" card border-primary bg-transparent p-1 my-2">
                            <div class="row justify-content-center">
                                <div class=" card col-md-3 border-white">
                                    <div class=" text-center text-success mb-3">
                                            <div class="card-body">
                                                <h1 class="display-4">
                                                    <i class="icons8-group"></i>
                                                </h1>
                                                <h6 class="card-text text-dark"><span class="badge badge-info">
                                                        <?php echo $nbre_cnd ?></span> <a href="candidat.php?cnd">Candidat(s)</a>
                                                </h6>
                                            </div>
                                    </div>
                                </div>
                                <div class=" card col-md-3 border-white">
                                    <div class=" text-center text-primary mb-3">
                                        <div class="card-body">
                                            <h1 class="display-4">
                                                <i class="icons8-document"></i>
                                            </h1>
                                            <h6 class="card-text text-dark"><span class="badge badge-info">
                                                    <?php echo $nbre_cv ?></span> <a href="gestioncv.php?cv">Curiculum(s) Vitae(s)</a>
                                            </h6>
                                        </div>
                                    </div>
                                </div>
                                <div class=" card col-md-3 border-white">
                                    <div class=" text-center text-danger mb-3">
                                        <div class="card-body">
                                            <h1 class="display-4">
                                                <i class="fa fa-building-o"></i>
                                            </h1>
                                            <h6 class="card-text text-dark"><span class="badge badge-info">
                                                    <?php echo $nbre_ent ?></span>
                                                <a href="entreprise.php?ent">Entreprise(s)</a>
                                            </h6>
                                        </div>

                                    </div>
                                </div>
                                <div class=" card col-md-3 border-white">
                                    <div class=" text-center text-warning mb-3">

                                        <div class="card-body">
                                            <h1 class="display-4">
                                                <i class="fa fa-folder-open-o"></i>
                                            </h1>
                                            <h6 class="card-text text-dark"><span class="badge badge-info">
                                                    <?php echo $nbre_offre ?><a href="offre_emploi.php?offre_emploi"></span> Ofrre(s) d'emploi</a>
                                            </h6>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--GESTION DES CV*************-->
                    <!--OFRES EMPLOI-->
                    <div class="tab-pane fade" id="offres" role="tabpanel">

                        <div class="card my-3">
                            <h3 class="card-header">Offres D'emploi</h3>
                            <div class="card-body">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th scope="col">Nom Entreprise</th>
                                        <th scope="col">Secteur Activité</th>
                                        <th scope="col">Contact</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Contenu de l'offre</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <th scope="row">Entreprise 1</th>
                                        <td>Informatiques</td>
                                        <td>012323232</td>
                                        <td>mail@mail.com</td>
                                        <td><a class="btn btn-primary" href="#danslabdd">Consulter les Details</a></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>


                    </div>
                    <div class="tab-pane fade" id="souscription" role="tabpanel">

                        <div class="row">
                            <h2 class="text-center col-md-10 mb-3">Liste des souscriptions</h2>
                        </div>
                        <div class="row">

                            <div class="col-md-5">
                                <h4>Entreprise</h4>
                                <ul class="list-group">
                                    <li class="list-group-item">
                                        Nom : <strong>#Dans la bd</strong> <br>
                                        Service : <strong>#service dans la bd</strong><br>
                                        Contact : <strong>#numero</strong> <br>
                                        Email: <a href="mailto:#danslabd"></a><strong>#email</strong>

                                    </li>
                                </ul>

                            </div>

                            <div class="col-md-5">
                                <h4 class="">Candidat</h4>
                                <ul class="list-group">
                                    <li class="list-group-item">
                                        Nom : <strong>#Dans la bd</strong> <br> <!--BDDDDDDDDDDDDDDDD-->
                                        Service : <strong>#service dans la bd</strong><br> <!--BDDDDDDDDDDDDDDDD-->
                                        Contact : <strong>#numero</strong> <br> <!--BDDDDDDDDDDDDDDDD-->
                                        Email: <a href="mailto:#danslabd"></a><strong>#email</strong>
                                        <!--BDDDDDDDDDDDDDDDD-->

                                    </li>
                                </ul>
                            </div>
                        </div>


                    </div>
                    <!--SERVICE ET FORMATION**************************************************************-->
                    <div class="tab-pane fade" id="service" role="tabpanel">
                        <div class="row">
                            <div class="col-md-5">
                                <div class="card my-4">
                                    <h3 class="card-header bg-dark text-white"> Ajouter un service <b>entreprise</b>
                                    </h3>
                                    <div class="card-body">
                                        <form action="php/services.php" method="post" enctype="multipart/form-data">
                                            <div class="form-group">
                                                <label for="serviceTitre">Nom service </label>
                                                <input type="text" class="form-control" id="serviceTitre"
                                                       name="serviceTitre" required>
                                                <label for="serviceCorps">Corps du service </label>
                                                <input type="text" class="form-control" name="serviceCorps"
                                                       id="serviceCorps">
                                                <div class="mt-3">
                                                    <input type="submit" name="valide" class="btn btn-outline-primary">
                                                    <input type="reset" class="btn btn-outline-danger">
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="card my-4">
                                    <h3 class="card-header bg-primary text-white"> Ajouter un service <b>Candidat</b>
                                    </h3>
                                    <div class="card-body">
                                        <form action="php/services.php" method="post" enctype="multipart/form-data">
                                            <div class="form-group">
                                                <label for="serviceCndTitre">Nom service </label>
                                                <input type="text" class="form-control" id="serviceCndTitre"
                                                       name="serviceCndTitre" required>
                                                <label for="serviceCndCorps">Corps du service </label>
                                                <input type="text" class="form-control" name="serviceCndCorps"
                                                       id="serviceCndCorps">
                                                <div class="mt-3">
                                                    <input type="submit" name="valide" class="btn btn-outline-primary">
                                                    <input type="reset" class="btn btn-outline-danger">
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="card mt-5">
                            <h3 class="card-header">
                                Liste de nos services/formations
                            </h3>
                            <div class="card-body">
                                <ul class="list-group">
                                    <li class="list-group-item d-flex justify-content-between">offre de ...
                                        <div class="justify-content-end">
                                            <button class="btn btn-outline-success" data-target="#modalModifierSercice"
                                                    data-toggle="modal">Modifier
                                            </button>
                                            <button class="btn btn-outline-danger">Supprimer</button>
                                        </div>
                                    </li>
                                    <li class="list-group-item d-flex ">offre de..</li>
                                </ul>
                            </div>
                        </div>


                    </div>

                    <!--ECRIRE UNE OFFRE-->
                    <div class="tab-pane fade" id="ecrireOffres" role="tabpanel">
                        <div class="card my-4">
                            <h3 class="card-header bg-dark text-white"> Ecrire une offre
                            </h3>
                            <div class="card-body">
                                <form action="php/offres.php" method="post" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label for="titreOffre">Titre </label>
                                        <input type="text" class="form-control" id="titreOffre" name="titreOffre">
                                        <label for="offreCoprs">Corps de l'offre </label>
                                        <textarea class="form-control" name="offreCorps" id="offreCoprs"></textarea>
                                        <div class="mt-3">
                                            <input type="submit" name="valide" class="btn btn-outline-primary">
                                            <input type="reset" class="btn btn-outline-danger">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>


                        <div class="card mt-5">
                            <h3 class="card-header">
                                </i> Liste de nos offres
                            </h3>
                            <div class="card-body">
                                <ul class="list-group">
                                    <li class="list-group-item d-flex justify-content-between">offre de ...
                                        <div class="justify-content-end">
                                            <button class="btn btn-outline-success" data-target="#modalModifierOffre"
                                                    data-toggle="modal">Modifier
                                            </button>
                                            <button class="btn btn-outline-danger">Supprimer</button>
                                        </div>
                                    </li>
                                    <li class="list-group-item d-flex ">offre de..</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- ECRIRE ACTUALITE*****************************************-->
                    <div class="tab-pane fade" id="actualite" role="tabpanel">
                        <div class="card my-4">
                            <h3 class="card-header bg-dark text-white"> Ecrire une Actualité
                            </h3>
                            <div class="card-body">
                                <form action="php/article.php" method="post" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label for="titreActu">Titre </label>
                                        <input type="text" class="form-control" id="titreActu" name="titreActu">
                                        <label for="img">Image de l'actualité </label>
                                        <input type="file" class="form-control" id="img" name="img">
                                        <label for="article">Corps de l'actualité </label>
                                        <textarea class="form-control" name="article" id="article"></textarea>
                                        <div class="mt-3">
                                            <input type="submit" name="valide" class="btn btn-outline-primary">
                                            <input type="reset" class="btn btn-outline-danger">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="card mt-5">
                            <h3 class="card-header">
                                </i> Liste des actualités
                            </h3>
                            <div class="card-body">
                                <ul class="list-group">
                                    <li class="list-group-item d-flex justify-content-between">Actu 1
                                        <div class="justify-content-end">
                                            <button class="btn btn-outline-success" data-target="#modalModifierActu"
                                                    data-toggle="modal">Modifier
                                            </button>
                                            <button class="btn btn-outline-danger">Supprimer</button>
                                        </div>
                                    </li>
                                    <li class="list-group-item d-flex ">Actu 2</li>
                                </ul>
                            </div>
                        </div>

                    </div>
                    <!--CANDIDAT-->
                    <div class="tab-pane fade" id="candidat" role="tabpanel">

                        <form action="php/rechercheCandidat.php" method="post" enctype="multipart/form-data"
                              id="formRecherch" class="mt-2">
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <label for="competence">Competence</label>
                                    <select name="competence" class="form-control form-control-sm" id="competence">
                                        <option value="" selected disabled>Aucune competence selectionner</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="genre">Genre</label>
                                    <select name="genre" class="form-control form-control-sm" id="genre">
                                        <option value="" selected disabled>Aucun genre selectionner</option>
                                    </select>
                                </div>

                                <div class="form-group col-md-3">
                                    <label for="localite">Localité</label>
                                    <select name="localite" class="form-control form-control-sm" id="localite" required>
                                        <option value="" selected disabled>Aucun critere selectionner</option>
                                    </select>
                                </div>

                                <div class="form-group col-md-3">
                                    <label for="etude">Niveau Etude</label>
                                    <select name="etude" class="form-control form-control-sm" id="etude" required>
                                        <option value="" selected disabled>Aucun critere selectionner</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <label for="contrat">Type de contrat</label>
                                    <select name="contrat" class="form-control form-control-sm" id="contrat" required>
                                        <option value="" selected disabled>Aucun critere selectionner</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="mat">Situation Matrimoniale</label>
                                    <select name="mat" class="form-control form-control-sm" id="mat" required>
                                        <option value="" selected disabled>Aucun critere selectionner</option>
                                    </select>
                                </div>

                                <div class="form-group col-md-3">
                                    <label for="langue">Langue Parlé</label>
                                    <select name="langue" class="form-control form-control-sm" id="langue" required>
                                        <option value="" selected disabled>Aucun critere selectionner</option>
                                    </select>
                                </div>
                            </div>
                        </form>
                        <div class="row">
                            <div class="col-6">
                                <ul class="list-unstyled">
                                    <li class="media my-3 ">
                                        <img class="mr-3" src="img/avatar.png"
                                             style="max-height: 128px;max-width: 128px">
                                        <div class="media-body ">
                                            <h5 class="mt-0 mb-1">Nom candidat dans la bdd</h5>
                                            <p class="text-justify">
                                                <b>Prenom : </b> bdd <br>

                                                <b>Email : </b> bdd <br>
                                                <b>Contact : </b> bd <br>
                                                <b>Competence : </b> bdddddd
                                            </p>
                                            <div class="row">
                                                <a href="#video" class=" mx-2 btn btn-outline-success">Voir le CV
                                                    Video</a>
                                                <a href="#pdf" class="  mx-2 btn btn-outline-primary">Voir le CV PDF</a>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="media my-3 ">
                                        <img class="mr-3" src="img/avatar.png"
                                             style="max-height: 128px;max-width: 128px">
                                        <div class="media-body ">
                                            <h5 class="mt-0 mb-1">Nom candidat dans la bdd</h5>
                                            <p class="text-justify">
                                                <b>Prenom : </b> bdd <br>

                                                <b>Email : </b> bdd <br>
                                                <b>Contact : </b> bd <br>
                                                <b>Competence : </b> bdddddd
                                            </p>
                                            <div class="row">
                                                <a href="#video" class=" mx-2 btn btn-outline-success">Voir le CV
                                                    Video</a>
                                                <a href="#pdf" class="  mx-2 btn btn-outline-primary">Voir le CV PDF</a>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="media my-3 ">
                                        <img class="mr-3" src="img/avatar.png"
                                             style="max-height: 128px;max-width: 128px">
                                        <div class="media-body ">
                                            <h5 class="mt-0 mb-1">Nom candidat dans la bdd</h5>
                                            <p class="text-justify">
                                                <b>Prenom : </b> bdd <br>

                                                <b>Email : </b> bdd <br>
                                                <b>Contact : </b> bd <br>
                                                <b>Competence : </b> bdddddd
                                            </p>
                                            <div class="row">
                                                <a href="#video" class=" mx-2 btn btn-outline-success">Voir le CV
                                                    Video</a>
                                                <a href="#pdf" class="  mx-2 btn btn-outline-primary">Voir le CV PDF</a>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>


                    <div class="tab-pane fade" id="entreprise" role="tabpanel">
                        <div class="card mt-5">
                            <h3 class="card-header">Liste des entreprises non validées</h3>
                            <div class="card-body">
                                <ul class="list-group">
                                    <li class="list-group-item d-flex justify-content-between">
                                        Entreprise
                                        <div class="justify-content-end">
                                            <form action="php/validerEntreprise.php" method="post"
                                                  enctype="multipart/form-data" class="d-inline mx-2">
                                                <input type="submit" class="btn btn-outline-success">
                                            </form>
                                            <button class="btn btn-outline-primary" data-target="#modalEntreprise"
                                                    data-toggle="modal">Voir l'entreprise
                                            </button>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>


                        <div class="card mt-5">
                            <h3 class="card-header">
                                Liste des entreprises validées
                            </h3>
                            <div class="card-body">
                                <ul class="list-group">
                                    <li class="list-group-item d-flex justify-content-between">Entreprise
                                        <div class="justify-content-end">
                                            <button class="btn btn-outline-primary" data-target="#modalEntreprise"
                                                    data-toggle="modal">Voir l'entreprise
                                            </button>
                                        </div>
                                    </li>
                                </ul>
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
include 'inc/modal_parametre.php'
?>


<!--*************************************Script******************************-->
<script src="../js/jquery-3.2.1.min.js"></script>
<script src="../js/popper.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="./js/admin.js"></script>

</body>
</html>