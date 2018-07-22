
<?php
$req = $db->query("select * from candidat WHERE ACTIF_CND='1'");
$candidats = $req->fetchAll();

foreach ($candidats as $cnd){
    // informatio perso et proffessionnelles du candidat

    $req = $db->prepare("SELECT LIB_GENRE FROM genre  where  ID_GENRE=:id_genre");
    $req->bindParam(":id_genre", $cnd['ID_GENRE']);
    $req->execute();
    $genre = $req->fetch()['LIB_GENRE'];

    $req = $db->prepare("SELECT LIB_NAT FROM nationnalite where ID_NAT=:id_nat");
    $req->bindParam(":id_nat", $cnd['ID_NAT']);
    $req->execute();
    $nat = $req->fetch()['LIB_NAT'];

    $req = $db->prepare("SELECT LIB_PAYS FROM pays where ID_PAYS in (select ID_PAYS from localiser_cnd where ID_CND=:id_cnd) ");
    $req->bindParam(":id_cnd", $cnd['ID_CND']);
    $req->execute();
    $pays = $req->fetch()['LIB_PAYS'];

    $req = $db->prepare("SELECT LIB_VILLE FROM ville where ID_VILLE in (select ID_VILLE from localiser_cnd where ID_CND=:id_cnd)");
    $req->bindParam(":id_cnd", $cnd['ID_CND']);
    $req->execute();
    $ville = $req->fetch()['LIB_VILLE'];

    $req = $db->prepare("SELECT LIB_SIT_MAT FROM sit_matrimoniale where ID_SIT_MAT=:id_sit_mat");
    $req->bindParam(":id_sit_mat", $cnd['ID_SIT_MAT']);
    $req->execute();
    $sit_mat = $req->fetch()['LIB_SIT_MAT'];

    $req = $db->prepare("SELECT LIB_SIT_PROF FROM sit_professionnelle where ID_SIT_PROF=:id_sit_prof");
    $req->bindParam(":id_sit_prof", $cnd['ID_SIT_PROF']);
    $req->execute();
    $sit_prof = $req->fetch()['LIB_SIT_PROF'];

    $req = $db->prepare("SELECT LIB_NIVEAU FROM niveau_etude where ID_NIVEAU=:id_niveau");
    $req->bindParam(":id_niveau", $cnd['ID_NIVEAU']);
    $req->execute();
    $niveau = $req->fetch()['LIB_NIVEAU'];

    $req = $db->prepare("SELECT LIB_CONTRAT FROM contrat where ID_CONTRAT=:id_contrat");
    $req->bindParam(":id_contrat", $cnd['ID_CONTRAT']);
    $req->execute();
    $contrat = $req->fetch()['LIB_CONTRAT'];



    $req = $db->prepare("SELECT LIB_DOM FROM domaine_comp where ID_DOM in (select ID_DOM from avoir_dom where ID_CND=:id_cnd)");
    $req->bindParam(":id_cnd", $cnd['ID_CND']);
    $req->execute();
    $domaines = $req->fetchAll();


    $req = $db->prepare("SELECT LIB_LANG FROM langue where ID_LANG  in (select ID_LANG from parler where ID_CND=:id_cnd)");
    $req->bindParam(":id_cnd", $cnd['ID_CND']);
    $req->execute();
    $langues = $req->fetchAll();

    //service auxquels il a souscri
    $req = $db->prepare("SELECT LIB_SERV_CND FROM service_cnd where ID_SERV_CND IN (SELECT ID_SERV_CND FROM souscrire_cnd WHERE ID_CND=:id_cnd)");
    $req->bindParam(":id_cnd", $cnd['ID_CND']);
    $req->execute();
    $services = $req->fetchAll();
    $nbre_services = $req->rowCount();
    //date et heure de la derniere connexion
    $req = $db->prepare("SELECT DATE_CONN_CND FROM connexion_cnd where ID_CND =:id_cnd order by DATE_CONN_CND desc ");
    $req->bindParam(":id_cnd", $cnd['ID_CND']);
    $req->execute();
    $derniere_connexion = $req->fetch()['DATE_CONN_CND'];

    ?>

    <div class="modal fade" id='<?php echo $cnd['ID_CND'] ?>' tabindex="-1" role="dialog" aria-labelledby="modalCandidat"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header text-info">
                    <h5 class="modal-title " id="modalCandidatLabel">
                        <i class="fa fa-user"></i>

                    </h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="card">
                        <img src='../php/user/photo_profil/<?php echo $cnd['PATH_PHOTO_CND'] ?>' alt="photo de profil" style="max-height: 20rem; width: 100%"
                             class="img-fluid">
                        <form method="post" id="formCandidat">

                        <div class="card-header text-info">
                            <h4>INFORMATIONS PERSONNELLES</h4>
                        </div>
                        <div class="card-body">

                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="nom"><strong>Nom : </strong></label><br>
                                        <label class="text-secondary"><?php echo htmlspecialchars(strtoupper($cnd['NOM_CND'])) ?></label>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="prenom"><strong>Prenom : </strong></label><br>
                                        <label class="text-secondary"><?php echo htmlspecialchars($cnd['PRENOM_CND']) ?></label>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="datenaiss"><strong>Date de naissance : </strong></label><br>
                                        <label class="text-secondary"><?php echo $cnd['DATE_NAISS_CND'] ?></label>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="nationalite"><strong>Nationnalité : </strong></label><br>
                                        <label class="text-secondary"><?php echo $nat ?></label>
                                    </div>
                                </div>


                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="civilite"><strong>Genre : </strong></label><br>
                                        <label class="text-secondary"><?php echo $genre ?></label>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="tel"><strong>Téléphone : </strong></label><br>
                                        <label class="text-secondary"><?php echo $cnd['CONTACT_CND'] ?></label>
                                    </div>

                                </div>


                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="pays"><strong>Pays de residence : </strong></label><br>
                                        <label class="text-secondary"><?php echo $pays ?></label>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="ville"><strong>Ville de residence : </strong></label><br>
                                        <label class="text-secondary" ><?php echo $ville ?></label>
                                    </div>
                                </div>


                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="sit_mat"><strong>Situation matrimoniale : </strong></label><br>
                                        <label class="text-secondary" ><?php echo $sit_mat ?></label>
                                    </div>
                                </div>


                                <div class="card-header text-info">
                                    <h4>INFORMATIONS PROFESSIONNELLES</h4>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="sit_prof"><strong>Situation professionnelle : </strong> </label><br>
                                        <label class="text-secondary" ><?php echo $sit_prof ?></label>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="exp"><strong>Année d'expérience : </strong></label><br>
                                        <label class="text-secondary" ><?php echo $cnd['ANNEE_EXP_CND'] ?></label>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="contrat"><strong>Contrat souhaité : </strong> </label><br>
                                        <label class="text-secondary" ><?php echo $contrat ?></label>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="niveau"><strong>Niveau d'etude :</strong></label><br>
                                        <label class="text-secondary" ><?php echo $niveau ?></label>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label for="competence"><strong>Domaine de compétence : </strong></label>
                                        <select multiple name="dom_comp[]" class="form-control form-control-sm" >
                                            <?php

                                            foreach ($domaines as $result){
                                                echo "<option class='text-secondary' >".$result['LIB_DOM']."</option>";
                                            }

                                            ?>
                                        </select>
                                    </div>

                                </div>

                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="langue"><strong>Langue(s) parlée(s) : </strong></label>
                                    <select multiple name="langue[]" class="form-control form-control-sm selectpicker">
                                        <?php

                                        foreach ($langues as $result){
                                            echo "<option class='text-secondary'>".$result['LIB_LANG']."</option>";
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
                                            echo "<option >".$result['LIB_SERV_CND']."</option>";
                                        }

                                        ?>
                                    </select>
                                </div>

                                <div class="card-header text-info">
                                    <h4>INFORMATIONS DU COMPTE</h4>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-7">
                                        <label for="email"><strong>Email :  </strong></label><br>
                                        <label class="text-secondary" ><?php echo $cnd['EMAIL_CND'] ?></label>
                                    </div>
                                    <div class="form-group col-md-5">
                                        <label ><strong>Dernière connexion :  </strong></label><br>
                                        <label class="text-secondary" ><?php echo $derniere_connexion ?></label>
                                    </div>

                                </div>


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