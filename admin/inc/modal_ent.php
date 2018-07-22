<?php
/**
 * Created by PhpStorm.
 * User: DEGNI
 * Date: 20/02/2018
 * Time: 09:57
 */

$req = $db->query("select * from entreprise WHERE ACTIF_ENT='1'");
$entreprises = $req->fetchAll();

foreach($entreprises as $ent){


    $req = $db->prepare("SELECT LIB_PAYS FROM pays where ID_PAYS = (select ID_PAYS from localiser_ent where ID_ENT=:id_ent) ");
    $req->bindParam(":id_ent", $ent['ID_ENT']);
    $req->execute();
    $pays = $req->fetch()['LIB_PAYS'];

    $req = $db->prepare("SELECT LIB_VILLE FROM ville where ID_VILLE = (select ID_VILLE from localiser_ent where ID_ENT=:id_ent)");
    $req->bindParam(":id_ent", $ent['ID_ENT']);
    $req->execute();
    $ville = $req->fetch()['LIB_VILLE'];

    $req = $db->prepare("SELECT LIB_TYPE_SOC FROM type_societe where ID_TYPE_SOC =:id_type_soc");
    $req->bindParam(":id_type_soc", $ent['ID_TYPE_SOC']);
    $req->execute();
    $type_soc = $req->fetch()['LIB_TYPE_SOC'];

    $req = $db->prepare("SELECT LIB_FORM_JUR FROM forme_juridique where ID_FORM_JUR =:id_form_jur");
    $req->bindParam(":id_form_jur", $ent['ID_FORM_JUR']);
    $req->execute();
    $form_jur = $req->fetch()['LIB_FORM_JUR'];

    $req = $db->prepare("SELECT LIB_SECT FROM secteur_act where ID_SECT in (select ID_SECT from opere where ID_ENT=:id_ent)");
    $req->bindParam(":id_ent", $ent['ID_ENT']);
    $req->execute();
    $secteurs = $req->fetchAll();


    //date et heure de la derniere connexion
    $req = $db->prepare("SELECT DATE_CONN_ENT FROM connexion_ent where ID_ENT =:id_ent order by DATE_CONN_ENT desc ");
    $req->bindParam(":id_ent", $ent['ID_ENT']);
    $req->execute();
    $derniere_connexion = $req->fetch()['DATE_CONN_ENT'];


    //service auxquels il a souscri
    $req = $db->prepare("SELECT LIB_SERV_ENT FROM service_ent where ID_SERV_ENT IN (SELECT ID_SERV_ENT FROM souscrire_ent WHERE ID_ENT=:id_ent)");
    $req->bindParam(":id_ent", $ent['ID_ENT']);
    $req->execute();
    $services = $req->fetchAll();
    $nbre_services = $req->rowCount();


    // interlocuteur
    $req = $db->prepare("SELECT * FROM interlocuteur where ID_INTER=:id_inter ");
    $req->bindParam(":id_inter", $ent['ID_INTER']);
    $req->execute();
    $inter = $req->fetch();
    $req = $db->prepare("SELECT LIB_GENRE FROM genre where ID_GENRE=:id_genre");
    $req->bindParam(":id_genre", $inter['ID_GENRE']);
    $req->execute();
    $genre = $req->fetch()['LIB_GENRE'];


?>


    <div class="modal fade" id='<?php echo $ent['ID_ENT'] ?>' tabindex="-1" role="dialog" aria-labelledby="modalEntreprise"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header text-info">
                    <h5 class="modal-title " id="modalEntrepriseLabel">
                        <i class="fa fa-user"></i>

                    </h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="card">
                        <img src='../php/company/logo/<?php echo $ent['PATH_LOGO_ENT'] ?>' alt="logo" style="max-height: 20rem; width: 100%"
                             class="img-fluid">

                        <form  method="post"  id="formEntreprise" accept-charset="UTF-8">

                            <div class="card-header text-info">
                                <h4>INFORMATIONS DE L'ENTREPRISE</h4>
                            </div>
                            <div class="card-body">
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="sigle"><strong>Sigle : </strong></label><br>
                                        <label class="text-secondary"><?php echo $ent['SIGLE_ENT'] ?></label>
                                    </div>
                                     <div class="form-group col-md-6">
                                        <label for="raison_sociale"><strong>Raison Sociale : </strong></label><br>
                                        <label class="text-secondary"><?php echo $ent['RAISON_SOCIALE_ENT'] ?></label>
                                    </div>
                                </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="tel"><strong>Téléphone : </strong></label><br>
                                    <label class="text-secondary"><?php echo $ent['TEL_ENT'] ?></label>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="fax"><strong>Fax : </strong></label><br>
                                    <label class="text-secondary"><?php echo $ent['FAX_ENT'] ?></label>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="site"><strong>Site Internet : </strong></label><br>
                                    <label class="text-secondary"><?php echo "<a href='http://".$ent['SITE_ENT']."' target='_blank'>".$ent['SITE_ENT']."</a>" ?></label>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="adresspos"><strong>Adresse Postale : </strong></label><br>
                                    <label class="text-secondary"><?php echo $ent['ADRESSE_POST_ENT'] ?></label>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="commerce"><strong>Registre De Commerce : </strong></label><br>
                                    <label class="text-secondary"><?php echo $ent['REG_COM_ENT'] ?></label>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="contribuable"><strong>Compte Contribuable : </strong></label><br>
                                    <label class="text-secondary"><?php echo $ent['COMPTE_CONTRIB_ENT'] ?></label>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="pays"><strong>Pays : </strong></label><br>
                                    <label class="text-secondary"><?php echo $pays ?></label>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="pays"><strong>Ville : </strong></label><br>
                                    <label class="text-secondary"><?php echo $ville ?></label>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="societe"><strong>Type De Société : </strong></label><br>
                                    <label class="text-secondary"><?php echo $type_soc ?></label>

                                </div>
                                <div class="form-group col-md-6">
                                    <label for="juridique"><strong>Forme Juridique : </strong></label><br>
                                    <label class="text-secondary"><?php echo $form_jur ?></label>

                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="secteur"><strong>Secteur(s) d'Activité(s) : </strong></label>
                                    <select multiple class="form-control form-control-sm" id="secteur" required>
                                        <?php

                                        foreach ($secteurs as $result){
                                            echo "<option class='text-secondary' >".$result['LIB_SECT']."</option>";

                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                                <div class="card-header text-info">
                                    <h4>SOUSCRIPTION(S)</h4>
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="langue"><strong>service(s) ORH </strong></label>
                                    <select multiple  class="form-control form-control-sm selectpicker" id="langue" >
                                        <?php

                                        foreach ($services as $result){
                                            echo "<option >".$result['LIB_SERV_ENT']."</option>";
                                        }

                                        ?>
                                    </select>
                                </div>

                            <div class="card-header text-info">
                                <h4>INFORMATIONS DU COMPTE</h4>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label ><strong>Email : </strong></label><br>
                                    <label class="text-secondary"><?php echo $ent['EMAIL_ENT'] ?></label>
                                </div>
                                <div class="form-group col-md-6">
                                    <label ><strong>Dernière connexion : </strong></label><br>
                                    <label class="text-secondary"><?php echo $derniere_connexion ?></label>
                                </div>
                            </div>

                            <div class="card-header">
                                <h4 class="text-info">INFORMATIONS INTERLOCUTEUR</h4>
                            </div>
                                <img src='../php/company/photo_inter/<?php echo $inter['PATH_PHOTO_INTER'] ?>' alt="logo" style="max-height: 20rem; width: 100%"
                                     class="img-fluid">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label ><strong>Nom : </strong></label><br>
                                    <label class="text-secondary"><?php echo $inter['NOM_INTER'] ?></label>
                                </div>
                                <div class="form-group col-md-6">
                                    <label ><strong>Prenom : </strong></label><br>
                                    <label class="text-secondary"><?php echo $inter['PRENOM_INTER'] ?></label>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label ><strong>Genre : </strong></label><br>
                                    <label class="text-secondary"><?php echo $genre ?></label>
                                </div>
                                <div class="form-group col-md-6">
                                    <label ><strong>Fonction : </strong></label><br>
                                    <label class="text-secondary"><?php echo $inter['FONCTION_INTER'] ?></label>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label ><strong>Email : </strong></label><br>
                                    <label class="text-secondary"><?php echo $inter['EMAIL_INTER'] ?></label>
                                </div>
                                <div class="form-group col-md-6">
                                    <label ><strong>Mobile : </strong></label><br>
                                    <label class="text-secondary"><?php echo $inter['TEL_INTER'] ?></label>
                                </div>
                            </div>


                        </form>


                        </form>
                    </div>

                </div>

            </div>
        </div>
    </div>
    </div>


    <?php
}
?>
