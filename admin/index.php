<?php
/**
 * Created by PhpStorm.
 * User: inno-kirito
 * Date: 17/01/2018
 * Time: 21:59
 */
?>

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
    <link rel="stylesheet" href="css/styleA.css">

</head>
<body class="bg-light">


<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-md-6 mx-auto">
                <header id="logoOrh" class="py-3 mt-2">
                    <a href="index.php">
                        <img src="../img/logo_ORH.png" alt="logo_Orh"class="img-fluid">
                    </a>
                </header>
            </div>

        </div>
        <div class="row">
            <div class="col-md-6 mx-auto">
                <div class="card mt-5 my-5">
                    <div class="card-header">
                        <h4>Connexion Administrateur</h4>
                    </div>
                    <div class="card-body">
                        <form action="php/connexionAdmin.php" method="post" ">
                            <div class="form-group">
                                <label for="pseudo">Pseudonyme : </label>
                                <input type="text" class="form-control" name="pseudo" id="pseudo" placeholder="pseudo"  required>
                                <label for="mdp">Mot de passe : </label>
                                <input type="password" class="form-control" name="mdp" id="mdp" placeholder="********" required>
                            </div>
                            <input type="submit" class="btn btn-primary btn-block">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--*************************************Script******************************-->
<script src="../js/jquery-3.2.1.min.js"></script>
<script src="../js/popper.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
</body>
</html>
