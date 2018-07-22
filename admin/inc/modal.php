<!--Modal modifier services*********-->
<div class="modal fade" id="modalModifierSercice" tabindex="-1" role="dialog" aria-labelledby="modalModifierSercice"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalModifierSerciceLabel"> Modifier Sercice/Formation </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="php/services.php" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="serviceTitre">Nom service/formation </label>
                        <input type="text" class="form-control" id="serviceTitre" name="serviceTitre" required>
                        <label for="serviceCorps">Corps du service </label>
                        <input type="text" class="form-control" name="serviceCorps" id="serviceCorps">
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

<!--Modal modifier offre*********-->
<div class="modal fade" id="modalModifierOffre" tabindex="-1" role="dialog" aria-labelledby="modalModifierOffre"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalModifierOffreLabel"> Modifier Offre </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="php/offres.php" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="offreTitre">Titre </label>
                        <input type="text" class="form-control" id="offreTitre" name="offreTitre" required>
                        <label for="offreCorps">Libellé </label>
                        <input type="text" class="form-control" name="offreCorps" id="offreCorps">
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


<!--Modal modifier actualite*********-->

<div class="modal fade" id="modalModifierActu" tabindex="-1" role="dialog" aria-labelledby="modalModifierActu"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalModifierActuLabel"> Modifier Actualité </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
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
    </div>
</div>

<!--Modal modifier actualite*********-->

<div class="modal fade" id="modalParametre" tabindex="-1" role="dialog" aria-labelledby="modalParametre"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalParametreLabel"> Modifier Vos parametres de connexion </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="php/modifierAdmin.php" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="pseudo"> Modifier Pseudonyme </label>
                        <input type="text" class="form-control" id="pseudo" name="pseudo">
                        <label for="mdpAncien">Ancien mot de passe</label>
                        <input class="form-control" type="text" name="article" id="mdpAncien" required>
                        <label for="mdpNew">Nouveau mot de passe</label>
                        <input class="form-control" type="text" name="mdpNew" id="mdpNew" required>
                        <label for="mdpNew">Confirmer mot de passe</label>
                        <input class="form-control" type="text" name="mdpNew" id="mdpconfirm" required>
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


<!--*****************************************Modal entreprise*************************-->

<div class="modal fade" id="modalEntreprise" tabindex="-1" role="dialog" aria-labelledby="modalEntreprise"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEntrepriseLabel"> Nom entreprise </h5>
                <!--BDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDD-->

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <img src="img/preview.jpg" alt="logo_entreprise" style="max-height: 20rem; width: 100%"
                     class="img-fluid">

                <h6 class="my-2 d-inline">Sigle : </h6>
                <p class="d-inline"> bdd</p> <br>
                <h6 class="my-2 d-inline">Secteur Activité : </h6>
                <p class="d-inline"> bdd</p> <br>
                <h6 class="my-2 d-inline">Raison Sociale : </h6>
                <p class="d-inline"> bdd</p> <br>
                <h6 class="my-2 d-inline">Telephone: </h6>
                <p class="d-inline"> bdd</p> <br>
                <h6 class="my-2 d-inline">Fax : </h6>
                <p class="d-inline"> bdd</p> <br>
                <h6 class="my-2 d-inline">Site Internet : </h6>
                <p class="d-inline"> bdd</p> <br>
                <h6 class="my-2 d-inline">Adresse mail: </h6>
                <p class="d-inline"> bdd</p> <br>
                <h6 class="my-2 d-inline ">Localisation : </h6>
                <p class="d-inline"> bdd</p> <br>
                <h6 class="my-2 d-inline">Type de Societe : </h6>
                <p class="d-inline"> bdd</p> <br>
                <h6 class="my-2 d-inline">Forme Juridique : </h6>
                <p class="d-inline"> bdd</p> <br>
                <h6 class="my-2 d-inline">Registre De Commerce : </h6>
                <p class="d-inline"> bdd</p> <br>
                <h6 class="my-2 d-inline">Compte Contribuable : </h6>
                <p class="d-inline"> bdd</p> <br>
                <h5 class="my-2 d-inline text-primary">Information sur l'interlocuteur</h5>
                <div class="row my-2">
                    <div class="col-md-4">
                        <img src="img/avatar.png" alt="logo_entreprise" style="max-height: 20rem; width: 100%"
                             class="img-fluid">
                    </div>
                    <div class="col-md-8">
                        <h6 class="my-2 d-inline">Nom : </h6>
                        <p class="d-inline"> bdd</p> <br>
                        <h6 class="my-2 d-inline">Prenom : </h6>
                        <p class="d-inline"> bdd</p> <br>
                        <h6 class="my-2 d-inline">Genre : </h6>
                        <p class="d-inline"> bdd</p> <br>
                        <h6 class="my-2 d-inline">Telephone: </h6>
                        <p class="d-inline"> bdd</p> <br>
                        <h6 class="my-2 d-inline">Adresse mail: </h6>
                        <p class="d-inline"> bdd</p> <br>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
