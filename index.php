<!doctype html>
<html lang="fr">
<!---@ Innocent Kacou-->

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, maximum-scale=3.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!--Bootstrap Css-->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/windows10_icon.css">
    <link rel="stylesheet" href="css/style.css">
    <!-- Flag Icon CSS -->
    <link rel="stylesheet" type="text/css"
          href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/2.4.0/css/flag-icon.min.css">
    <!-- Normalize CSS -->
    <link rel="stylesheet" type="text/css"
          href="https://cdnjs.cloudflare.com/ajax/libs/normalize/4.2.0/normalize.min.css">
    <title>Acceuil ORH</title>
    <!--Script-->

</head>

<body>

<!--*****Bar Connexion****************-->
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
    include "inc/barConnexionCandidat.php";
} elseif (isset($_SESSION['ID_ENT'])) {
    include "inc/barConnexionEntreprise.php";
} else {

    include "inc/barConnexion.php";
}
?>
<!--Debut du site-->
<div class="wrapper">
    <div class="container-fluid bg-light mt-5">
        <header id="logoOrh" class="py-3">
            <div class="row">
                <div class="col-sm-12">
                    <a href="index.php">
                        <img src="img/orh_logo.png" class="img-fluid mobile" alt="orh_logo">
                        <img src="img/orh_logo.png" class="desktop" alt="orh_logo" height="120">
                    </a>
                </div>
            </div>

        </header>
    </div>
    <!--Carousel-->
    <!--Baniere-->
     <img src="img/banniereA.png" class="img-fluid banniere-background mobile" alt="Banniere">
    <div class="banniere desktop">
       <!-- <img src="img/banniereA.png" class="img-fluid banniere-background" alt="Banniere">-->
        <div class="cadre text-center desktop">
            <a href="orh_candidat.php" class=" btn btn-cv mr-2 ml-3"> <img class="img-fluid" src="img/btn_cv.png" alt=""></a>
            <a href="orh_entreprise.php" class="btn btn-offre ml-1"> <img class="img-fluid" src="img/btn_offre.png" alt=""></a>
        </div>
    </div>
<!--
    <section class="banniere">


    </section>-->

    <!--Baniere-->
    <!--NavBAr-->
    <?php
    include 'inc/navbar.php'
    ?>
    <div class="container-fluid bg-light">
        <div class=" corp bg-light">
            <h2 class="text-center" id=heading_body>Actualité</h2>
            <nav class="navbar navbar-expand">

                <ul class="nav navbar-nav justify-content-center" id="navActu">
                    <li>
                        <a href="index.php" class="text-muted">L'actualité </a>
                    </li>
                    <li>|</li>
                    <li>
                        <a href="index.php" class="text-muted">Formation </a>
                    </li>
                    <li>|</li>
                    <li>
                        <a href="index.php" class="text-muted">Conseil RH </a>
                    </li>
                    <li>|</li>
                    <li>
                        <a href="index.php" class="text-muted">Solutions Digitals </a>
                    </li>
                    <li>|</li>
                    <li>
                        <a href="index.php" class="text-muted">Coaching </a>
                    </li>
                </ul>

            </nav>
            <div class="row">
                <h4 class=" col col-lg-8 " id="heading_mine">ORH CONSEIL EN STRATEGIE RH</h4>
            </div>
            <!--Recherche et actu-->
            <div class="row">
                <div class="col-12 col-md-4 col-sm-12">
                    <?php
                    include 'inc/offres_emploi.php';
                    ?>
                </div>
                <!--Actualite-->
                <div class="col-12 col-md-4 col-sm-12">
                    <div class="card bg-light border-0 actualite">
                        <div class=" card-header">
                            <span class="actualiteTitre"><h6 class="text-center "> Actualite <i
                                            class="fa fa-newspaper-o"></i></h6></span>
                        </div>
                        <div class="card-body">
                        <?php
                        $acts = $db->query("SELECT * FROM actualite  ORDER BY DATE_ECRIRE_ACT")->fetchAll(PDO::FETCH_ASSOC);
                        
                        foreach ($acts as $act) {
       
                        ?>
                        <div class="card">
                                <img src="./admin/php/actualite/<?php echo $act['PATH_IMG_ACT']?>" alt="card image" class="card-img-top">
                                <div class="card-body">
                                    <h6 class="card-title"><b><?php echo $act['LIB_ACT']?></b></h6>
                                    <p class="card-text"> <?php echo $act['DESC_ACT']?> </p>
                                </div>
                        </div>
                            
                        <?php
                            }
                        ?>
                            
                            
                        </div>
                    </div>
                </div>
                <!-- Les etapes a suivre orh-->
                <div class="col-12 col-md-4 col-sm-12">
                    <div class="etapes">
                        <h5>Les etapes a suivre ...</h5>
                        <ul>
                            <li>
                                <a href="orh_candidat.php" class="details mx-2"><h6>Inscrivez vous sur ORH</h6>
                                    <img src="icons/login2.png" alt="">
                                </a>
                            </li>
                            <li>
                                <a href="orh_candidat.php" class="details mx-2"><h6>Rediger votre dossier</h6>
                                    <img src="icons/dossier.png" alt="dossier">
                                </a>
                            </li>
                            <li>
                                <a href="orh_candidat.php" class="details mx-2"><h6>Deposer votre Cv</h6>
                                    <img src="icons/cv.png" alt="cv">
                                </a>
                            </li>
                            <li>
                                <a href="orh_candidat.php" class="details mx-2"><h6>Profitez de tout nos services et
                                        avantages !!!</h6>
                                    <img src="icons/ok.png" alt="ok">
                                </a
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!--ORH VOUS PROPOSE-->

        <div class="row bande_bleu justify-content-center my-2">
            <h4 class=" text-white">LES PRODUITS DE ORH</h4>
        </div>
        <div class="row">
            <section class=" sec_produiOrh py-4">
                <div class="row">
                    <div class="col-lg-2 col-md-4 col-6">
                        <div class="textbtn text-center">
                            <a href="#">
                                <button class="btn btn-info btn-lg btn-lg-info">
                                    <span class="icons8-group icons8_body"></span>
                                </button>
                            </a>
                            <br>
                            <a class="text-center lien" href="#">Strategie RH</a>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-4 col-6">
                        <div class="textbtn text-center">
                            <a href="#">
                                <button class="btn btn-info btn-lg btn-lg-info">
                                    <span class="icons8-support icons8_body"></span>
                                </button>
                            </a>
                            <br>
                            <a class="text-center lien" href="#">Outils de gestion des RH</a>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-4 col-6">
                        <div class="textbtn text-center">
                            <a href="#">
                                <button class="btn btn-info btn-lg btn-lg-info">
                                    <span class="icons8-organization icons8_body"></span>
                                </button>
                            </a>
                            <br>
                            <a class="text-center lien" href="#">Audit Social</a>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-4 col-6">
                        <div class="textbtn text-center">
                            <a href="#">
                                <button class="btn btn-info btn-lg btn-lg-info">
                                    <span class="icons8-briefcase icons8_body"></span>
                                </button>
                            </a>
                            <br>
                            <a class="text-center lien" href="#">Recrutement</a>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-4 col-6">
                        <div class="textbtn text-center">
                            <a href="#">
                                <button class="btn btn-info btn-lg btn-lg-info">
                                    <span class="icons8-opened-folder icons8_body"></span>
                                </button>
                            </a>
                            <br>
                            <a class="text-center lien" href="#">Dossier de Candidature</a>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-4 col-6">
                        <div class="textbtn text-center">
                            <a href="#">
                                <button class="btn btn-info btn-lg btn-lg-info">
                                    <span class="icons8-student icons8_body"></span>
                                </button>
                            </a>
                            <br>
                            <a class="text-center lien" href="#">Formation</a>
                        </div>
                    </div>
                </div>
            </section>

        </div>
        <br>
        <div class="row bande_bleu justify-content-center my-2">
            <h4 class=" text-white"> LE GUIDE ORH</h4>
        </div>
        <br>
        <!--Card-->
        <div class="row guide_orh text-center py-3">
            <div class="mt-4 col-12 col-md-4">
                <div class="card">
                    <img class="card-img-top" src="img/help_hand.png">
                    <div class="card-body">
                        <h4 class="card-title text-center">ORH a vos coté</h4>
                        <div class="card-text">
                            Pour tous vos avis et informations, ORH est à votre écoute.
                        </div>
                    </div>
                    <div class="card-footer text-center">
                        <a href="#" class="btn btn-warning btn-block">
                            <span>Connecter vous</span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="mt-4 col-12 col-md-4">
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
            <!--***formation*****-->
            <div class="mt-4 col-12 col-md-4">
                <?php
                include 'inc/formation.php'
                ?>
            </div>

        </div>
        <!-----bande et service pieds de page---->
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

        <!---footer*********************-->
        <div class="row">

            <?php
            include 'inc/footer.php'
            ?>
        </div>
        <!--************body-***************fin-->
    </div>

</div>


<!---***********Script*****************-->
<script src="js/jquery-3.2.1.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/connexion.js"></script>
</body>

</html>
