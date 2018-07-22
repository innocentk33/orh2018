<!doctype html>
<html lang="fr">
<!---@ Innocent Kacou-->

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
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
        <!--BarConnexion-->
        <?php
        /**
         * Created by PhpStorm.
         * User: inno-kirito
         * Date: 13/01/2018
         * Time: 19:04
         */
        session_start();
        if ( isset($_SESSION['ID_CND']) ){
            include "inc/barConnexionCandidat.php";
        }elseif ( isset($_SESSION['ID_ENT']) ){
            include "inc/barConnexionEntreprise.php";
        }else{
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
                <div class="col-md-12">
                    <div class="card border-light mb-3">
                        <div class="card-header"><h4>Nous contacter ...?</h4></div>
                        <div class="card-body text-dark">
                            <form method="post" enctype="multipart/form-data" action="php/contact.php">
                                <div class="form-group">
                                    <label for="email">Votre email</label>
                                    <input type="email" class="form-control" id="email" name="email"
                                           placeholder="Entrer email entreprise" required>
                                </div>
                                <div class="form-group">
                                    <label for="tel">Votre contact</label>
                                    <input type="tel" class="form-control" id="tel" name="tel"
                                           placeholder="002253685">
                                </div>
                                <div class="form-group">
                                    <label for="mdpConnexionE">Votre messsage</label>
                                    <textarea id="message" class="form-control"></textarea>
                                </div>
                                <input type="submit" class="btn btn-outline-primary">
                            </form>
                        </div>
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
                                <p>Où trouver le bureau de la ORH</p>
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




<!---***********Script*****************-->
<script src="js/jquery-3.2.1.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/connexion.js"></script>
</body>

</html>
