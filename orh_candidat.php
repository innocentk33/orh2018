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
include 'php/connexionBD.php';

header("Content-Type: text/html ; charset=utf-8");
header("Cache-Control: no-cache , private");

if (isset($_SESSION['ID_CND'])) {
    header('Location: orh_profil_candidat.php');
} elseif (isset($_SESSION['ID_ENT'])) {
    include 'inc/barConnexionEntreprise.php';

} else {
    include 'inc/barConnexion.php';
}

$genre = $db->query("SELECT * FROM genre ORDER BY LIB_GENRE")->fetchAll(PDO::FETCH_ASSOC);
$nat = $db->query("SELECT * FROM nationnalite ORDER BY LIB_NAT")->fetchAll(PDO::FETCH_ASSOC);
$pays = $db->query("SELECT * FROM pays ORDER BY LIB_PAYS")->fetchAll(PDO::FETCH_ASSOC);
$ville = $db->query("SELECT * FROM ville ORDER BY LIB_VILLE")->fetchAll(PDO::FETCH_ASSOC);
$sit_mat = $db->query("SELECT * FROM sit_matrimoniale ORDER BY LIB_SIT_MAT")->fetchAll(PDO::FETCH_ASSOC);
$sit_prof = $db->query("SELECT * FROM sit_professionnelle ORDER BY LIB_SIT_PROF")->fetchAll(PDO::FETCH_ASSOC);
$dom_comp = $db->query("SELECT * FROM domaine_comp ORDER BY LIB_DOM")->fetchAll(PDO::FETCH_ASSOC);
$niv_etude = $db->query("SELECT * FROM niveau_etude ORDER BY LIB_NIVEAU")->fetchAll(PDO::FETCH_ASSOC);
$lang = $db->query("SELECT * FROM langue ORDER BY LIB_LANG")->fetchAll(PDO::FETCH_ASSOC);
$contrat = $db->query("SELECT * FROM contrat ORDER BY LIB_CONTRAT")->fetchAll(PDO::FETCH_ASSOC);
?>


<div class="wrapper">
    <div class=" container-fluid bg-light mt-5">
        <header id="logoOrh" class="py-3">
            <a href="index.php">
                <img src="img/orh_logo.png" class="img-fluid mobile" alt="orh_logo">
                <img src="img/orh_logo.png" class="desktop" alt="orh_logo" height="120">
            </a>
        </header>

        <!--Carousel-->
        <div class="row">
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>

                </ol>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img class="d-block w-100" src="img/cr_candidat.jpg" alt="First slide">
                        <div class="carousel-caption d-md-block bgCarousel">
                            <h5 class="text-white">Espace Candidat</h5>
                            <p class="text-white"> Pour profiter pleinement des outils mis à votre disposition par ORH
                                dans le cadre de votre recherche d'emploi, Il est important que vous ayez un compte
                                candidat.</p>
                            <a href="#compteCandidat" class="btn btn-primary">Creer mon compte</a>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100" src="img/cr_blackman.jpg" alt="Second slide">
                        <div class="carousel-caption d-md-block bgCarousel">
                            <h5 class="text-white">Vous etes a la recherche d'emploi</h5>
                            <p class="text-white">Vous pourrez postuler à nos offres en ligne et actualiser votre CV à
                                tout moment.</p>
                            <a href="" class="btn btn-primary">En savoir plus ...</a>
                        </div>
                    </div>

                </div>
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
        <!--NavBAr-->
        <?php
        include 'inc/navbar.php'
        ?>

        <div class="corp">

            <br>

            <!--Formulaire Inscription-->
            <div class="row">
                <div class="col-lg-4">

                    <!--Connexion Candidat-->

                    <div class="card mb-3 bg-white connexionCompteCandidiat">
                        <div class="card-header bg-primary"><h5 class="text-white"><strong>Candidat </strong>Vous avez
                                deja un compte?
                                connectez-vous !</h5></div>
                        <div class="card-body text-dark">
                            <h5 class="card-title">Informations du Compte <strong class="text-primary">Candidat</strong>
                            </h5>
                            <p class="card-text">Pour acceder a toutes les fonctionalités de notre site trouver des
                                offres</p>
                            <b class="card-text">Renseignez vos information</b>
                            <form method="post" enctype="multipart/form-data" id="connexionCandidat">
                                <div class="form-group">
                                    <label for="emailConnexionCnd">Email de connexion Candidat</label>
                                    <input type="email" class="form-control" id="emailConnexionCnd" name="email"
                                           placeholder="Entrer email Candidat">
                                </div>
                                <div class="form-group">
                                    <label for="mdpConnexionCnd">Mot de Passe</label>
                                    <input type="password" class="form-control" id="mdpConnexionCnd"
                                           placeholder="Mot de Passe" name="mdp">
                                </div>
                                <button type="submit" id="validerConnexionCnd" name="validerConnexionCnd"
                                        class="btn btn-primary btn-block text-white">Connexion
                                </button>
                            </form>
                        </div>
                    </div>
                    <div class="desktop">
                        <?php
                        /*<!--page facebook-->*/
                        include "inc/facebook.php";
                        include "inc/formation.php";
                        include "inc/offres_emploi.php";
                        ?>
                    </div>


                </div>
                <div class="col-lg-8 col-md-12 col-12">
                    <div class="card border-0 creerCompteCandidat box-shadow">
                        <div class="container bg-white">
                            <h3 class="py-2">Créer mon Compte Candidat</h3>
                            <hr>
                            <div class="card mb-3 border-0">
                                <h5>Pourquoi créer un compte candidat ?</h5>
                                <p class="card-text box-shadow ">
                                    Pour profiter pleinement des outils mis à votre disposition par <strong>ORH</strong>
                                    dans le cadre de votre recherche d'emploi, <strong>Il est important que vous ayez un
                                        compte candidat et que vous renseigniez votre CV.</strong>
                                    Vous pourrez ainsi postuler à nos offres en ligne et actualiser votre CV à tout
                                    moment.
                                </p>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <h4>Informations personnelles</h4>
                                </div>
                                <div class="card-body">
                                    <form method="post" id="formCandidat">

                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="nom">Nom</label>
                                                <input type="text" class="form-control form-control-sm" id="nom"
                                                       name="nom" placeholder="Nom" required>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="prenom">Prenom</label>
                                                <input type="text" class="form-control form-control-sm" id="prenom"
                                                       name="prenom" placeholder="Prenom" required>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="datenaiss">Date de naissance</label>
                                                <input type="date" class="form-control form-control-sm" id="datenaiss"
                                                       name="date_naiss" placeholder="date" required>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="nationalite">Nationalité</label>
                                                <select name="nat" class="form-control form-control-sm" id="nationalite"
                                                        required>
                                                    <option value="" selected disabled>Choisissez votre nationnalité
                                                    </option>
                                                    <?php
                                                    foreach ($nat as $result) {
                                                        echo "<option value='" . $result['ID_NAT'] . "'>" . $result['LIB_NAT'] . "</option>";
                                                    }

                                                    ?>
                                                </select>
                                            </div>
                                        </div>


                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="civilite">Genre</label>
                                                <select name="genre" class="form-control form-control-sm" id="civilite"
                                                        required>
                                                    <option value="" selected disabled>Choisissez votre genre</option>
                                                    <?php
                                                    foreach ($genre as $result) {
                                                        echo "<option value='" . $result['ID_GENRE'] . "'>" . $result['LIB_GENRE'] . "</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="tel">Numero de Telephone</label>
                                                <input type="tel" class="form-control form-control-sm" id="tel"
                                                       name="tel" placeholder="07080910" required>
                                            </div>

                                        </div>


                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="pays">Pays de Résidence</label>
                                                <select name="pays" class="form-control form-control-sm" id="pays"
                                                        required>
                                                    <option value="" selected disabled>Choisissez votre pays de
                                                        résidence
                                                    </option>
                                                    <?php
                                                    foreach ($pays as $result) {
                                                        echo "<option value='" . $result['ID_PAYS'] . "'>" . $result['LIB_PAYS'] . "</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="ville">Ville de Résidence</label>
                                                <select name="ville" class="form-control form-control-sm" id="ville"
                                                        required>
                                                    <option value="" selected disabled>Choisissez votre ville de
                                                        résidence
                                                    </option>
                                                    <?php
                                                    foreach ($ville as $result) {
                                                        echo "<option value='" . $result['ID_VILLE'] . "'>" . $result['LIB_VILLE'] . "</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>


                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="sit_mat">Situation matrimoniale</label>
                                                <select name="sit_mat" class="form-control form-control-sm" id="sit_mat"
                                                        required>
                                                    <option value="" selected disabled>Choisissez votre situation
                                                        matrimoniale
                                                    </option>
                                                    <?php
                                                    foreach ($sit_mat as $result) {
                                                        echo "<option value='" . $result['ID_SIT_MAT'] . "'>" . $result['LIB_SIT_MAT'] . "</option>";
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
                                                        echo "<option value='" . $result['ID_SIT_PROF'] . "'>" . $result['LIB_SIT_PROF'] . "</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="exp">Année d'expérience</label>
                                                <input name="anexp" class="form-control form-control-sm" id="exp"
                                                       type="number" max="50" min="0" value="0" required/>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="contrat">Contrat Souhaité </label>
                                                <select name="contrat" class="form-control form-control-sm" id="contrat"
                                                        required>
                                                    <option value="" selected disabled>Choisissez votre contrat
                                                        souhaité
                                                    </option>
                                                    <?php
                                                    foreach ($contrat as $result) {
                                                        echo "<option value='" . $result['ID_CONTRAT'] . "'>" . $result['LIB_CONTRAT'] . "</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="niveau">Niveau d'étude </label>
                                                <select name="niveau" class="form-control form-control-sm" id="niveau"
                                                        required>
                                                    <option value="" selected disabled>Choisissez votre niveau d'étude
                                                    </option>
                                                    <?php
                                                    foreach ($niv_etude as $result) {
                                                        echo "<option value='" . $result['ID_NIVEAU'] . "'>" . $result['LIB_NIVEAU'] . "</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="competence">Domaine de compétence </label>
                                                <select multiple name="dom_comp[]" class="form-control form-control-sm"
                                                        id="competence" required>
                                                    <option value="" selected disabled>Maintenez Ctrl pour une sélection
                                                        multiple
                                                    </option>
                                                    <?php
                                                    foreach ($dom_comp as $result) {
                                                        echo "<option value='" . $result['ID_DOM'] . "'>" . $result['LIB_DOM'] . "</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="langue">Langue(s) parlée(s) </label>
                                                <select multiple name="langue[]"
                                                        class="form-control form-control-sm selectpicker" id="langue"
                                                        required>
                                                    <option value="" selected disabled>Maintenez Ctrl pour une sélection
                                                        multiple
                                                    </option>
                                                    <?php
                                                    foreach ($lang as $result) {
                                                        echo "<option value='" . $result['ID_LANG'] . "'>" . $result['LIB_LANG'] . "</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>


                                        <div class="card-header">
                                            <h4>Informations du compte</h4>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-12">
                                                <label for="email">Email</label>
                                                <input type="email" class="form-control form-control-sm" id="email"
                                                       placeholder="Email" required name="email">
                                            </div>

                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="mdp">Mot de Passe</label>
                                                <input type="password" class="form-control form-control-sm" id="mdp"
                                                       placeholder="Mot de passe" required name="mdp">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="mdpverif">Confirmation du mot de passe</label>
                                                <input type="password" class="form-control form-control-sm"
                                                       id="mdpverif" placeholder="Confirmer le mot de passe" required
                                                       name="mdpverif">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-12">
                                                <label for="photo">photo de profil</label>
                                                <input type="file" accept="image/*" class="form-control form-control-sm"
                                                       id="photo" name="photo">
                                            </div>
                                        </div>

                                        <input type="submit" class="btn btn-outline-primary " id="send">
                                        <input type="reset" class="btn btn-outline-danger " id="reset">


                                    </form>
                                </div>
                                <div class="card-footer">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="progress progress-striped active">
                                                <div id="progression" class="progress-bar" role="progressbar"
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
                <!-- affichage mobile-->
                <div class="mobile">
                    <?php
                    /*<!--page facebook-->*/
                    include "inc/formation.php";
                    include "inc/offres_emploi.php";
                    ?>
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


<!--Reponse du serveur lors de linscription-->

<?php
include './modalORHInformation.html';

?>


<!---***********Script*****************-->
<script src="js/jquery-3.2.1.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/inscriptionCandidat.js"></script>
<script src="js/connexion.js"></script>
</body>

</html>
