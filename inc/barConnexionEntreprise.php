<?php
/**
 * Created by PhpStorm.
 * User: inno-kirito
 * Date: 17/01/2018
 * Time: 22:31
 */?>

<?php
/**
 * Created by PhpStorm.
 * User: inno-kirito
 * Date: 15/01/2018
 * Time: 14:28
 */
?>

<!-- barConnexion modal-->
<nav id="barConnexion" class="py-1 bg-dark fixed-top">
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <span class="mx-2" id="pays">CÔTE D'IVOIRE </span><i class="flag-icon flag-icon-ci"></i><i class="flag-icon flag-icon-fr mx-2"></i>
                <a href="../orh2018/orh_profil_entreprise.php" class="ml-auto mx-2 text-white">
                    <i class="fa fa-user-o"></i> <?php echo htmlspecialchars($_SESSION['EMAIL_ENT'])?></a>
                </a>
                <a href="php/deconnexionEnt.php" class=" text-danger mx-2">
                    <i class="fa fa-sign-out"></i> Deconnexion</a>
            </div>
        </div>
    </div>

</nav>

