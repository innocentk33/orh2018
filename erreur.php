<?php
/**
 * Created by PhpStorm.
 * User: inno-kirito
 * Date: 30/01/2018
 * Time: 19:40
 */?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Erreur</title>
    <!--Bootstrap Css-->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/windows10_icon.css">
    <link rel="stylesheet" href="css/style.css">
    <!---***********Script*****************-->
    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</head>
<body>


<?php
include 'inc/barConnexion.php'
?>

<div class=" container bg-light mt-5">
    <header id="logoOrh" class="py-3">
        <a href="index.php">
            <img src="img/logo_ORH2018.png" alt="logo_Orh" class="img-fluid" height="120">
        </a>
    </header>
    <?php
    include 'inc/navbar.php'
    ?>
    <h1 class="text-center display-1" style="color: #2baae0">Erreur</h1>
    <p class="text-center display-4" style="color: #1f75bb">Impossible de se connecter a la base de donnée</p>


    <div class="row">
        <?php
        include 'inc/footer.php'
        ?>
    </div>
</div>

</body>
</html>
