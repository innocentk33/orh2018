<?php
/**
 * Created by PhpStorm.
 * User: DEGNI
 * Date: 08/03/2018
 * Time: 21:25
 */
?>
<div class="modal fade" id="modalParametre" tabindex="-1" role="dialog" aria-labelledby="modalParametre"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-info fa fa-gear" id="modalParametreLabel"> PARAMETRES DE CONNEXION</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" id="formParametreAdmin">
                    <div class="form-group">
                        <label for="pseudo">Pseudonyme </label>
                        <input type="text" class="form-control" id="pseudo" name="pseudo">
                        <label for="email">Email </label>
                        <input type="email" class="form-control" id="email" name="email">
                        <strong class="text-danger">*</strong><label for="mdp">Mot de passe</label>
                        <input class="form-control" type="password" name="mdp" id="mdpAncien" required>
                        <label for="mdpNew">Nouveau mot de passe</label>
                        <input class="form-control" type="password" name="mdpNew" id="mdpNew" >
                        <label for="mdpNew">Confirmer nouveau mot de passe</label>
                        <input class="form-control" type="password" name="mdpNew" id="mdpConfirm" >
                        <label id="infoParametre"></label>
                        <div class="mt-3">
                            <input type="submit" name="valide" class="btn btn-outline-primary">
                            <input type="reset" class="btn btn-outline-danger">
                        </div>
                        <div class="progress progress-striped active">
                            <div id="progressionFormPhotoCandidat" class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
                            </div>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>