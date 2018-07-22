<?php
/**
 * Created by PhpStorm.
 * User: inno-kirito
 * Date: 15/01/2018
 * Time: 14:28
 */
?>

<!-- barConnexion modal-->
<nav id="barConnexion " class="py-1 bg-dark fixed-top desktop">
    <div class="wrapper desktop">
        <div class="container-fluid">
            <div class="row">
                <span class="mx-2" id="pays">CÔTE D'IVOIRE </span><i class="flag-icon flag-icon-ci"></i><i
                        class="flag-icon flag-icon-fr mx-2"></i>


                <!-- dropdown creer compte-->
                <div class="dropdown ml-auto">
                    <a href="#" class="dropdown-toggle  text-white" role="button" id="dropConnexion"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img src="icons/login.png" alt="login_icon" class="img-fluid"> Créer un compte</a>
                    </a>
                    <div class="dropdown-menu border-primary" aria-labelledby="dropConnexion">
                        <a href="../orh2018/orh_candidat.php" class="  dropdown-item ">
                            <i class="fa fa-user-o"></i> Candidat</a>
                        <a href="../orh2018/orh_entreprise.php" class=" dropdown-item  ">
                            <i class="fa fa-building-o"></i> Entreprise</a>
                    </div>
                </div>
                <!-- dropdown connexion-->

                <div class="dropdown  mx-2">
                    <a href="#" class="dropdown-toggle  text-white" role="button" id="dropConnexion"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img src="icons/register.png" alt="login_icon" class="img-fluid"> Connexion</a>
                    </a>
                    <div class="dropdown-menu border-primary" aria-labelledby="dropConnexion">
                        <button class="btn btn-primary dropdown-item " data-target="#cnd" data-toggle="modal">
                            <i class="fa fa-user-o"></i> Candidat
                        </button>
                        <button type="button" class="btn btn-primary dropdown-item  " data-target="#ent"
                                data-toggle="modal">
                            <i class="fa fa-building-o"></i> Entreprise
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </div>

</nav>

<!--Modal Connexion entreprise-->
<div class="modal fade" id="ent" tabindex="-1" role="dialog" aria-labelledby="ent" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header py-3">

                <img src="../orh2018/img/logo_ORH_fb.png" height="30"/>
                <h5 class="modal-title ml-auto" id="connexion">ENTREPRISE</h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body bg-light text-dark">
                <form method="post" id="FormConnexionEntreprise">
                    <div class="form-group">
                        <label for="emaila" class="form-control-label">Email :</label>
                        <input type="email" class="form-control" id="emaila" name="email" required
                               placeholder="exemple@mail.com">
                    </div>
                    <div class="form-group">
                        <label for="mdpb" class="form-control-label">Mot de passe :</label>
                        <input type="password" class="form-control" id="mdpb" name="mdp" required
                               placeholder="********">
                    </div>
                    <div class="modal-footer">
                        <p class="my-1 mr-auto" id="reponseConEnt"></p>
                        <input type="submit" class="btn btn-outline-primary " name="connexion" value="Connexion">
                        <button type="button" class="btn btn-outline-danger " data-dismiss="modal">Fermer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--Modal Connexion candidat-->


<div class="modal fade" id="cnd" tabindex="-1" role="dialog" aria-labelledby="cnd" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header py-3">

                <img src="../orh2018/img/logo_ORH_fb.png" height="30"/>
                <h5 class="modal-title ml-auto" id="connexion"> CANDIDAT</h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body bg-light text-dark">
                <form method="post" id="FormConnexionCandidat">
                    <div class="form-group">
                        <label for="emailb" class="form-control-label">Email :</label>
                        <input type="email" class="form-control" id="emailb" name="email" required
                               placeholder="exemple@mail.com">
                    </div>
                    <div class="form-group">
                        <label for="mdpa" class="form-control-label">Mot de passe :</label>
                        <input type="password" class="form-control" id="mdpa" name="mdp" required
                               placeholder="********">
                    </div>
                    <div class="modal-footer">
                        <p class="my-1 mr-auto" id="reponseConCnd"></p>
                        <input type="submit" class="btn btn-outline-primary " name="connexion" value="Connexion">
                        <button type="button" class="btn btn-outline-danger " data-dismiss="modal">Fermer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>