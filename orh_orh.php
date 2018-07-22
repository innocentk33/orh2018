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

<div class="wrapper">
    <div class=" container-fluid bg-light mt-5">
        <header id="logoOrh" class="py-3">
            <a href="index.php">
                <img src="img/orh_logo.png" alt="orh_logo" height="120">
            </a>
        </header>
        <!--Bar Connexion-->


        <?php
        /**
         * Created by PhpStorm.
         * User: inno-kirito
         * Date: 13/01/2018
         * Time: 19:04
         *

         */
        session_start();
        if (isset($_SESSION['ID_CND'])) {
            include "inc/barConnexionCandidat.php";
        } elseif (isset($_SESSION['ID_ENT'])) {
            include "inc/barConnexionEntreprise.php";
        } else {
            include "inc/barConnexion.php";
        }
        ?>

        <!--Carousel-->
        <div class="row">
            <?php
            include 'inc/carrousel.php';
            ?>
        </div>
        <!--NavBAr-->
        <?php
        include 'inc/navbar.php'
        ?>

        <div class="corp">
            <div class="row">
                <div class="container">
                    <h5 style="color: #2baae0;">ORH : Organisation Ressources Humaines</h5><br>
                    <h6>Présentation, </h6>
                    <p>Depuis quelques années de paysage professionnel de notre pays est jalonné par plusieurs entreprises
                        exerçant dans le domaine des Ressources Humaines.
                        <b>ORH</b>: à l’instar des autres entreprises est un cabinet d’assistance et de conseil en stratégie
                        RH, elle regroupe en son sein plusieurs experts du domaine des RH.
                        Désireuse d’offrir à ses partenaires des produits et des services ; des solutions digitales
                        flexibles adaptées aux exigences du marché de la concurrence <b>ORH</b> met à votre disposition une
                        longue expérience pluridimensionnelle afin de vous aider à relever chacun de vos défis.
                    </p>
                    <h5 class="text-uppercase mx-3" style="text-decoration: underline; color: #2baae0;">NOS DOMAINES
                        D’ACTIVITE</h5>
                    <div class="row">

                        <br>
                        <div class="col-md-8">
                            <ul class="mx-3">
                                <li>Banque</li>
                                <li>Assurance</li>
                                <li>Négoce</li>
                                <li>Télécommunication</li>
                                <li>Administration (Publique et Privée)</li>
                                <li>Energie</li>
                                <li>Industrie</li>
                                <li>Pétrolier</li>
                                <li>BTP</li>
                                <li>Sociétés civile</li>
                                <li>Organisations internationales</li>
                                <li>Particulier</li>
                                <li>Santé</li>
                                <li>Agro-industrie et biens de consommation</li>
                                <li>Transport et Logistique</li>
                                <li>Pharmacie</li>
                                <li>Clinique</li>
                                <li>Hôtellerie</li>

                            </ul>

                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <h5 class="card-header">Telecharger le document de presentation ORH</h5>
                                <div class="card-body">
                                    <a href="presentationORH.pdf" class="btn btn-block btn-outline-danger">
                                        <div class="py-4">
                                            <i class="fa fa-file-pdf-o fa-5x"></i>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <br>
                        <p class="mx-5">Nos offres couvrent un grand nombre de compétences : coaching, organisation,
                            management, ressources humaines, stratégie, recrutement, bilan comportemental professionnel,
                            développement personnel et ingénierie de projet.</p>
                    </div>

                </div>
            </div>
            <div class="row bande_bleu justify-content-center my-2">
                <h4 class=" text-white">LES PRODUITS ORH</h4>
            </div>
            <div class="row">
                <section class=" sec_produiOrh py-4">
                    <div class="row">
                        <div class="col-lg-2 col-sm-6">
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
                        <div class="col-lg-2 col-sm-6">
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
                        <div class="col-lg-2 col-sm-6">
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
                        <div class="col-lg-2 col-sm-6">
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
                        <div class="col-lg-2 col-sm-6">
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
                        <div class="col-lg-2 col-sm-6">
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
                <h4 class=" text-white"> Tous les services ORH</h4>
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



<!---***********Script*****************-->
<script src="js/jquery-3.2.1.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/connexion.js"></script>
</body>

</html>
