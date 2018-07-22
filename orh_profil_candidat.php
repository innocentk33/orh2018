<!doctype html>
<html lang="fr">
<!---@ Innocent Kacou-->

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!--Bootstrap Css-->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/windows10_icon.css">
    <link href="css/fileinput.css" media="all" rel="stylesheet" type="text/css"/>
    <link href="themes/explorer-fa/theme.css" media="all" rel="stylesheet" type="text/css"/>
    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/plugins/sortable.js" type="text/javascript"></script>
    <script src="themes/explorer-fa/theme.js" type="text/javascript"></script>
    <script src="themes/fa/theme.js" type="text/javascript"></script>
    <link rel="stylesheet" href="css/glyphicons-halflings.css">
    <link rel="stylesheet" href="css/glyphicons.css">
    <script src="themes/gly/theme.js"></script>
    <script src="js/fileinput.js" type="text/javascript"></script>
    <script src="js/locales/fr.js" type="text/javascript"></script>
    <script src="js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/style.css">
    <title>Orh 2018</title>
</head>

<body>
<!--Bar de connexion-->
<?php
/**
 * Created by PhpStorm.
 * User: inno-kirito
 * Date: 13/01/2018
 * Time: 19:04
 */

session_start();
session_cache_limiter("nocache");

header('Content-Type: text/html; charset=utf-8');
include 'php/connexionBD.php';

if (!isset($_SESSION['ID_CND'])) {
    header('Location: index.php');
}

include 'inc/barConnexionCandidat.php';

// recuperation des donnees genre/domaines de competence etc...;

$req = $db->prepare("select * from candidat where ID_CND = :id_cnd");
$req->bindParam(":id_cnd", $_SESSION['ID_CND']);
$req->execute();

$candidat = $req->fetch(); // informations du candidat
// requetes sans parametres
$genre = $db->query("SELECT * FROM genre ORDER BY LIB_GENRE")->fetchAll();
$nat = $db->query("SELECT * FROM nationnalite ORDER BY LIB_NAT")->fetchAll();
$pays = $db->query("SELECT * FROM pays ORDER BY LIB_PAYS")->fetchAll();
$ville = $db->query("SELECT * FROM ville ORDER BY LIB_VILLE")->fetchAll(PDO::FETCH_ASSOC);
$sit_mat = $db->query("SELECT * FROM sit_matrimoniale ORDER BY LIB_SIT_MAT")->fetchAll(PDO::FETCH_ASSOC);
$sit_prof = $db->query("SELECT * FROM sit_professionnelle ORDER BY LIB_SIT_PROF")->fetchAll(PDO::FETCH_ASSOC);
$dom_comp = $db->query("SELECT * FROM domaine_comp ORDER BY LIB_DOM")->fetchAll(PDO::FETCH_ASSOC);
$niv_etude = $db->query("SELECT * FROM niveau_etude ORDER BY LIB_NIVEAU")->fetchAll(PDO::FETCH_ASSOC);
$lang = $db->query("SELECT * FROM langue ORDER BY LIB_LANG")->fetchAll(PDO::FETCH_ASSOC);
$contrat = $db->query("SELECT * FROM contrat ORDER BY LIB_CONTRAT")->fetchAll(PDO::FETCH_ASSOC);
// requetes avec parametres
$req = $db->prepare("SELECT * FROM avoir_dom where ID_CND =:id_cnd");
$req->bindParam(":id_cnd", $_SESSION['ID_CND']);
$req->execute();
$domCnd = $req->fetchAll(); // domaines de competence du candidat

$req = $db->prepare("SELECT * FROM parler where ID_CND =:id_cnd");
$req->bindParam(":id_cnd", $_SESSION['ID_CND']);
$req->execute();
$langCnd = $req->fetchAll(PDO::FETCH_ASSOC); //langues parlees par le candidat

$req = $db->prepare("SELECT * FROM localiser_cnd where ID_CND =:id_cnd");
$req->bindParam(":id_cnd", $_SESSION['ID_CND']);
$req->execute();
$localiserCnd = $req->fetch(PDO::FETCH_ASSOC); //localisation du candidat

// information CV
$req = $db->prepare("SELECT * FROM cv where ID_CND =:id_cnd");
$req->bindParam(":id_cnd", $_SESSION['ID_CND']);
$req->execute();
$libCV = "";
if ($donnees = $req->fetch())
    $libCV = $donnees['LIB_CV'];

// SERVICES ORH ET SOSCRIPTIONS DU CANDIDAT
// liste des services auquelles le candidat n'a pas encore souscrire
$req = $db->prepare("SELECT * FROM service_cnd where ID_SERV_CND NOT IN (SELECT ID_SERV_CND FROM souscrire_cnd WHERE ID_CND=:id_cnd)");
$req->bindParam(":id_cnd", $_SESSION['ID_CND']);
$req->execute();
$services = $req->fetchAll();
// services auquelles il a souscrire
$req = $db->prepare("SELECT * FROM service_cnd where ID_SERV_CND IN (SELECT ID_SERV_CND FROM souscrire_cnd WHERE ID_CND=:id_cnd)");
$req->bindParam(":id_cnd", $_SESSION['ID_CND']);
$req->execute();
$servicesCnd = $req->fetchAll();
$nbre_services = $req->rowCount();


?>


<div class="wrapper">
    <div class=" container-fluid bg-light mt-5">
        <header id="logoOrh" class="py-3">
            <a href="index.php">
                <img src="img/orh_logo.png" alt="orh_logo" height="120">
            </a>
        </header>
        <!--NavBAr-->
        <?php
        include 'inc/navbar.php'
        ?>

        <div class="corp">
            <!--******************************************************DEPOSER VOTRE CV****************************-->
            <div class="row">
                <div class="col-md-4">
                    <div class="nav flex-column nav-pills my-3 bg-light" id="v-pills-tab" role="tablist"
                         aria-orientation="vertical">
                        <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home"
                           role="tab"
                           aria-controls="v-pills-home" aria-selected="true"><i class="fa fa-user-circle-o"></i> Mes
                            Infos</a>
                        <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile"
                           role="tab"
                           aria-controls="v-pills-profile" aria-selected="false"><i class="fa fa-file-pdf-o"></i>
                            Envoyer
                            Mon <strong>CV</strong></a>
                        <a class="nav-link" id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-messages"
                           role="tab"
                           aria-controls="v-pills-messages" aria-selected="false"> <i class="fa fa-building-o"></i>
                            Souscriptions <span class="badge badge-info"><?php echo $nbre_services ?></span></a>
                        <a class="nav-link" id="v-pills-settings-tab" data-toggle="pill" href="#v-pills-settings"
                           role="tab"
                           aria-controls="v-pills-settings" aria-selected="false"><i class="fa fa-gears"></i> Parametres</a>
                    </div>
                    <div class="card">
                        <h4 class="card-header">Votre photo</h4>
                        <div class="card-body justify-content-center">
                            <img style="max-height: 15.6rem"
                                 src=<?php echo "php/user/photo_profil/" . $candidat['PATH_PHOTO_CND'] ?> class="card-img
                                 img-fluid" alt="photo">
                        </div>
                        <div class="card-footer">
                            <form action="php/modifierPhotoCandidat.php" id="formPhotoCandidat"
                                  enctype="multipart/form-data" method="post">
                                <input type="file" name="photo" class="btn btn-block" accept="image/*" required>
                                <input type="submit" class="btn btn-block btn-outline-success" value="Modifier Photo">
                            </form>
                            <div class="progress progress-striped active">
                                <div id="progressionFormPhotoCandidat" class="progress-bar" role="progressbar"
                                     aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%">

                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="desktop">
                        <?php
                        /*<!--page facebook-->*/
                        include "inc/facebook.php";
                        include "inc/formation.php";
                        ?>
                    </div>

                </div>
                <div class="col-lg-8 col-md-12">
                    <div class="tab-content" id="v-pills-tabContent">
                        <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel"
                             aria-labelledby="v-pills-home-tab">
                            <div class="container bg-light mb-5">

                                <div class="card">
                                    <div class="card-header">
                                        <h4>Informations du Compte</h4>
                                    </div>
                                    <div class="card-body">
                                        <form method="post" id="formCandidat" accept-charset="UTF-8">

                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="nom">Nom</label>
                                                    <input type="text"
                                                           value=<?php echo strtoupper($candidat['NOM_CND']) ?> class="form-control
                                                           form-control-sm" id="nom" name="nom" required>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="prenom">Prenom</label>
                                                    <input type="text"
                                                           value='<?php echo strtolower($candidat['PRENOM_CND']) ?>'
                                                           class="form-control form-control-sm" id="prenom"
                                                           name="prenom" required>

                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="datenaiss">Date de naissance</label>
                                                    <input type="date"
                                                           value=<?php echo strtolower($candidat['DATE_NAISS_CND']) ?> class="form-control
                                                           form-control-sm" id="datenaiss" name="date_naiss" required>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="nationalite">Nationalité</label>
                                                    <select name="nat" class="form-control form-control-sm"
                                                            id="nationalite" required>
                                                        <option value="" selected disabled>Choisissez votre
                                                            nationnalité
                                                        </option>
                                                        <?php
                                                        foreach ($nat as $result) {
                                                            if ($result['ID_NAT'] == $candidat['ID_NAT'])
                                                                echo "<option selected value='" . $result['ID_NAT'] . "'>" . $result['LIB_NAT'] . "</option>";
                                                            else
                                                                echo "<option  value='" . $result['ID_NAT'] . "'>" . $result['LIB_NAT'] . "</option>";

                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>


                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="civilite">Genre</label>
                                                    <select name="genre" class="form-control form-control-sm"
                                                            id="civilite" required>
                                                        <option value="" selected disabled>Choisissez votre genre
                                                        </option>
                                                        <?php
                                                        foreach ($genre as $result) {
                                                            if ($result['ID_GENRE'] == $candidat['ID_GENRE'])
                                                                echo "<option selected value='" . $result['ID_GENRE'] . "'>" . $result['LIB_GENRE'] . "</option>";
                                                            else
                                                                echo "<option  value='" . $result['ID_GENRE'] . "'>" . $result['LIB_GENRE'] . "</option>";

                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="tel">Numero de Telephone</label>
                                                    <input type="tel"
                                                           value=<?php echo strtolower($candidat['CONTACT_CND']) ?> class="form-control
                                                           form-control-sm" id="tel" name="tel" placeholder="telephone"
                                                    required>
                                                </div>

                                            </div>


                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="pays">Pays de Résidence</label>
                                                    <select name="pays" class="form-control form-control-sm" id="pays"
                                                            required>
                                                        <?php
                                                        foreach ($pays as $result) {
                                                            if ($result['ID_PAYS'] == $localiserCnd['ID_PAYS'])
                                                                echo "<option selected value='" . $result['ID_PAYS'] . "'>" . $result['LIB_PAYS'] . "</option>";
                                                            else
                                                                echo "<option  value='" . $result['ID_PAYS'] . "'>" . $result['LIB_PAYS'] . "</option>";

                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="ville">Ville de Résidence</label>
                                                    <select name="ville" class="form-control form-control-sm" id="ville"
                                                            required>
                                                        <?php
                                                        foreach ($ville as $result) {

                                                            if ($result['ID_VILLE'] == $localiserCnd['ID_VILLE'])
                                                                echo "<option selected value='" . $result['ID_VILLE'] . "'>" . $result['LIB_VILLE'] . "</option>";
                                                            else
                                                                echo "<option  value='" . $result['ID_VILLE'] . "'>" . $result['LIB_VILLE'] . "</option>";

                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>


                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="sit_mat">Situation matrimoniale</label>
                                                    <select name="sit_mat" class="form-control form-control-sm"
                                                            id="sit_mat" required>
                                                        <?php
                                                        foreach ($sit_mat as $result) {
                                                            if ($result['ID_SIT_MAT'] == $candidat['ID_SIT_MAT'])
                                                                echo "<option selected value='" . $result['ID_SIT_MAT'] . "'>" . $result['LIB_SIT_MAT'] . "</option>";
                                                            else
                                                                echo "<option  value='" . $result['ID_SIT_MAT'] . "'>" . $result['LIB_SIT_MAT'] . "</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>


                                            <div class="card-header">
                                                <h4>Informations professionnelles</h4>
                                            </div>

                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="sit_prof">Situation Professionnelle </label>
                                                    <select name="sit_prof" class="form-control form-control-sm"
                                                            id="sitprofe">
                                                        <option value="" selected disabled>Choisissez votre situation
                                                            professionnelle
                                                        </option>
                                                        <?php
                                                        foreach ($sit_prof as $result) {
                                                            if ($result['ID_SIT_PROF'] == $candidat['ID_SIT_PROF'])
                                                                echo "<option selected value='" . $result['ID_SIT_PROF'] . "'>" . $result['LIB_SIT_PROF'] . "</option>";
                                                            else
                                                                echo "<option value='" . $result['ID_SIT_PROF'] . "'>" . $result['LIB_SIT_PROF'] . "</option>";

                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="exp">Année d'expérience</label>
                                                    <input value=<?php echo $candidat['ANNEE_EXP_CND'] ?> name="anexp"
                                                           class="form-control form-control-sm" id="exp" type="number"
                                                           max="50" min="0" required/>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="contrat">Contrat Souhaité </label>
                                                    <select name="contrat" class="form-control form-control-sm"
                                                            id="contrat" required>
                                                        <option value="" selected disabled>Choisissez votre contrat
                                                            souhaité
                                                        </option>
                                                        <?php
                                                        foreach ($contrat as $result) {
                                                            if ($result['ID_CONTRAT'] == $candidat['ID_CONTRAT'])
                                                                echo "<option selected value='" . $result['ID_CONTRAT'] . "'>" . $result['LIB_CONTRAT'] . "</option>";
                                                            else
                                                                echo "<option value='" . $result['ID_CONTRAT'] . "'>" . $result['LIB_CONTRAT'] . "</option>";

                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="niveau">Niveau d'étude </label>
                                                    <select name="niveau" class="form-control form-control-sm"
                                                            id="niveau" required>
                                                        <option value="" selected disabled>Choisissez votre niveau
                                                            d'étude
                                                        </option>
                                                        <?php
                                                        foreach ($niv_etude as $result) {
                                                            if ($result['ID_NIVEAU'] == $candidat['ID_NIVEAU'])
                                                                echo "<option selected value='" . $result['ID_NIVEAU'] . "'>" . $result['LIB_NIVEAU'] . "</option>";
                                                            else
                                                                echo "<option value='" . $result['ID_NIVEAU'] . "'>" . $result['LIB_NIVEAU'] . "</option>";

                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="competence">Domaine de compétence(Maintenez Ctrl pour
                                                        une sélection multiple) </label>
                                                    <select multiple name="dom_comp[]"
                                                            class="form-control form-control-sm" id="competence"
                                                            required>
                                                        <?php
                                                        $trouve = false;
                                                        foreach ($dom_comp as $result) {
                                                            foreach ($domCnd as $result2) {
                                                                if ($result['ID_DOM'] == $result2['ID_DOM']) {
                                                                    echo "<option selected value='" . $result['ID_DOM'] . "'>" . $result['LIB_DOM'] . "</option>";
                                                                    $trouve = true;
                                                                }

                                                            }
                                                            if (!$trouve) echo "<option value='" . $result['ID_DOM'] . "'>" . $result['LIB_DOM'] . "</option>";
                                                            $trouve = false;

                                                        }
                                                        ?>
                                                    </select>

                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="langue">Langue(s) parlée(s) (Maintenez Ctrl pour une
                                                        sélection multiple) </label>
                                                    <select multiple name="langue[]"
                                                            class="form-control form-control-sm selectpicker"
                                                            id="langue" required>
                                                        <?php
                                                        foreach ($lang as $result) {
                                                            foreach ($langCnd as $result2) {
                                                                if ($result['ID_LANG'] == $result2['ID_LANG']) {
                                                                    echo "<option selected value='" . $result['ID_LANG'] . "'>" . $result['LIB_LANG'] . "</option>";
                                                                    $trouve = true;
                                                                }

                                                            }
                                                            if (!$trouve) echo "<option value='" . $result['ID_LANG'] . "'>" . $result['LIB_LANG'] . "</option>";
                                                            $trouve = false;
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>


                                            <input type="submit" class="btn btn-outline-primary " id="send">


                                        </form>
                                    </div>
                                    <div class="card-footer">
                                        <div class="row">
                                            <div class="col-md-12">
                                                ORH Outils et Solutions dédiés GRH
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="progress progress-striped active">
                                                    <div id="progressionFormCandidat" class="progress-bar"
                                                         role="progressbar" aria-valuenow="0" aria-valuemin="0"
                                                         aria-valuemax="100" style="width: 0%">

                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="v-pills-profile" role="tabpanel"
                             aria-labelledby="v-pills-profile-tab">
                            <form id="formEnvoyerCV" enctype="multipart/form-data">
                                <div class="form-group">
                                    <?php
                                    if ($libCV == "") echo "<div class='row'> Aucun CV n'a encore été envoyé</div>";
                                    else {
                                        echo "<div class='row'>
                                    <div class='card'>
                                        <h5 class='card-header'>Votre  CV Actuel</h5>
                                        <div class='card-body'>
                                            <a href='php/user/cv/" . $libCV . "' class='btn btn-block btn-outline-danger' target='_blank'>
                                                <div class='py-4'>
                                                    <i class='fa fa-file-pdf-o fa-5x'></i>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>";
                                    }
                                    ?>
                                    <div class="form-row">
                                        <label class="control-label" for="pdf">Joindre votre CV (format PDF)</label>
                                        <input type="file" accept="application/pdf" class="form-control" required
                                               id="pdf" name="cv">
                                        <input type="submit" value="Envoyer CV PDF"
                                               class="btn btn-outline-success my-3">
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="progress progress-striped active">
                                                <div id="progressionEnvoyerCV" class="progress-bar" role="progressbar"
                                                     aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"
                                                     style="width: 0%">

                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </form>

                        </div>
                        <div class="tab-pane fade" id="v-pills-messages" role="tabpanel"
                             aria-labelledby="v-pills-messages-tab">
                            <div class="card mt-5">
                                <h3 class="card-header">
                                    <strong>Listes de nos services.</strong>
                                </h3>
                                <?php
                                foreach ($services as $result) {
                                    echo "<div class='card-body'>
                                <ul class='list-group'>
                                    <li class='list-group-item d-flex justify-content-between'><h6 class='d-inline'>
                                    " . $result['LIB_SERV_CND'] . "</h6><br>
                                    <p class='d-inline'>" . $result['DESC_SERV_CND'] . "</p>
                                        <div class='justify-content-end'>
                                            <form action='php/souscriptionCandidat.php' method='post'>
                                                <input type='hidden' value=" . $result['ID_SERV_CND'] . " name='id_service'>
                                                <input class='btn btn-outline-success' type='submit' value='souscrire'>
                                            </form>

                                        </div>
                                    </li>

                                </ul>
                            </div>";
                                }
                                ?>
                            </div>
                            <div class="card mt-5">
                                <h3 class="card-header">
                                    <strong>Services auxquels vous avez souscris.</strong>
                                </h3>
                                <?php
                                foreach ($servicesCnd as $result) {
                                    echo "<div class='card-body'>
                                <ul class='list-group'>
                                    <li class='list-group-item d-flex justify-content-between'><h6 class='d-inline'>
                                    " . $result['LIB_SERV_CND'] . "</h6><br>
                                    <p class='d-inline'>" . $result['DESC_SERV_CND'] . "</p>
                                        <div class='justify-content-end'>
                                            <form action='php/deSouscriptionCandidat.php' method='post'>
                                                <input type='hidden' value=" . $result['ID_SERV_CND'] . " name='id_service'>
                                                <input class='btn btn-outline-danger' type='submit' value='Desouscrire'>
                                            </form>

                                        </div>
                                    </li>

                                </ul>
                            </div>";
                                }
                                ?>

                            </div>
                        </div>
                        <div class="tab-pane fade" id="v-pills-settings" role="tabpanel"
                             aria-labelledby="v-pills-settings-tab">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Modifier mes parametres</h4>
                                </div>
                                <div class="card-body">
                                    <form action="php/MdpCandidat.php.php" method="post" id="modifMDPcandidat">
                                        <div class="form-row">
                                            <div class="form-group col-md-12">
                                                <label for="mdp">Ancien Mot de Passe</label>
                                                <input type="password" class="form-control form-control-sm" id="mdp"
                                                       placeholder="Ancien Mot de passe" required name="mdp">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="mdpNew">Nouveau Mot de Passe</label>
                                                <input type="password" class="form-control form-control-sm" id="mdpNew"
                                                       placeholder="Nouveau Mot de passe" required name="mdpNew">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="mdpverif">Confirmation du mot de passe</label>
                                                <input type="password" class="form-control form-control-sm"
                                                       id="mdpVerif"
                                                       placeholder="Confirmer le mot de passe" required name="mdpVerif">
                                            </div>
                                        </div>
                                        <input type="submit" class="btn btn-outline-primary ">
                                        <input type="reset" class="btn btn-outline-danger " id="resetMdp">

                                    </form>
                                </div>
                                <div class="card-footer">
                                    <div class="row">
                                        <div class="col-md-12">
                                            ORH Outils et Solutioins dédiés GRH
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="progress progress-striped active">
                                                <div id="progressionParametres" class="progress-bar" role="progressbar"
                                                     aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"
                                                     style="width: 0%">

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

            <div class="row bande_bleu justify-content-center my-2">
                <h4 class=" text-white"> LE GUIDE ORH</h4>
            </div>
            <br>

            <!--Card-->
            <div class="row guide_orh text-center py-3">
                <div class="col-sm-6 col-md-4 col-lg-4 mt-4 col-12">
                    <div class="card">
                        <img class="card-img-top" src="img/help_hand.png">
                        <div class="card-body">
                            <h4 class="card-title text-center">ORH a vos coté</h4>
                            <div class="card-text">
                                Pour tous vos avis et informations, ORH est à votre écoute.
                            </div>
                        </div>
                        <div class="card-footer text-center">
                            <a href="#" class="btn btn-warning">
                                <span>Connecter vous</span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-4 mt-4 col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title text-center">Aide en ligne</h4>
                            <div class="card-text">
                                <p>Que faut-il dire ou ne pas dire lors d'un entretien téléphonique ?</p>
                                <p>Où trouver le bureau de ORH</p>
                            </div>
                        </div>
                        <div class="card-footer text-center">

                        </div>
                        <img class="card-img-top" src="img/support.png">
                    </div>
                </div>
                <!----formation----->
                <div class="col-sm-12 col-md-4 col-lg-4 mt-4 col-12">
                    <?php
                    include 'inc/formation.php'
                    ?>
                </div>

            </div>


            <!-----bande et service pieds de page----->
            <br>
            <div class="row bande_bleu justify-content-center my-2">
                <h4 class=" text-white"> Tout les services ORH</h4>
            </div>
            <!--------------------------Services Orh-------------------->
            <div class="row">
                <?php
                include 'inc/services_orh.php'
                ?>
            </div>
            <div class="row bande_bleu justify-content-center my-2">
                <h4 class=" text-white"> encore plus de orh...</h4>
            </div>

            <!-----------------------footer------------------------------->
            <div class="row">
                <?php
                include 'inc/footer.php'
                ?>
            </div>
            <!--------------------body-----------------fin---------->
        </div>
    </div>
</div>

<?php
include './modalORHInformation.html';
?>
<!---***********Script*****************-->
<script src="js/orh_profil_candidat.js"></script>
</body>

</html>
