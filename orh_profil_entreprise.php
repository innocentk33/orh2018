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
    <link href="css/fileinput.css" media="all" rel="stylesheet" type="text/css"/>

    <link href="themes/explorer-fa/theme.css" media="all" rel="stylesheet" type="text/css"/>
    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/plugins/sortable.js" type="text/javascript"></script>
    <script src="themes/explorer-fa/theme.js" type="text/javascript"></script>
    <script src="themes/fa/theme.js" type="text/javascript"></script>
    <link rel="stylesheet" href="css/glyphicons-halflings.css">
    <link rel="stylesheet" href="css/glyphicons.css">
    <script src="themes/gly/theme.js"></script>
    <script src="js/fileinput.js" type="text/javascript"></script>
    <script src="js/locales/fr.js" type="text/javascript"></script>
    <script src="js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/style.css">
    <title>Orh 2018</title>
</head>

<body>
<!--Bar de connexion-->
<?php
session_start();

include 'php/connexionBD.php';
header("Content-Type: text/html ; charset=utf-8");
header("Cache-Control: no-cache , private");

if (!isset($_SESSION['ID_ENT'])) {
    header('Location: index.php');
}
include 'inc/barConnexionEntreprise.php';

$req = $db->prepare("select * from entreprise where ID_ENT = :id_ent");
$req->bindParam(":id_ent", $_SESSION['ID_ENT']);
$req->execute();
$entreprise = $req->fetch(); // informations de l'entreprise

$req = $db->prepare("SELECT * FROM opere where ID_ENT =:id_ent");
$req->bindParam(":id_ent", $_SESSION['ID_ENT']);
$req->execute();
$sect_act_ent = $req->fetchAll(); // Secteur d'activité de l'entreprise

$req = $db->prepare("SELECT * FROM localiser_ent where ID_ENT =:id_ent");
$req->bindParam(":id_ent", $_SESSION['ID_ENT']);
$req->execute();
$localiserEnt = $req->fetch(PDO::FETCH_ASSOC); //localisation de l'neteprise
//interlocuteur
$req = $db->prepare("select * from interlocuteur where ID_INTER = :id_inter");
$req->bindParam(":id_inter", $entreprise["ID_INTER"]);
$req->execute();
$interlocuteur = $req->fetch();

$genre = $db->query("SELECT * FROM genre ORDER BY LIB_GENRE")->fetchAll(PDO::FETCH_ASSOC);
$pays = $db->query("SELECT * FROM pays ORDER BY LIB_PAYS")->fetchAll(PDO::FETCH_ASSOC);
$ville = $db->query("SELECT * FROM ville ORDER BY LIB_VILLE")->fetchAll(PDO::FETCH_ASSOC);
$type_soc = $db->query("SELECT * FROM type_societe ORDER BY LIB_TYPE_SOC")->fetchAll(PDO::FETCH_ASSOC);
$form_jur = $db->query("SELECT * FROM forme_juridique ORDER BY LIB_FORM_JUR")->fetchAll(PDO::FETCH_ASSOC);
$sect_act = $db->query("SELECT * FROM secteur_act ORDER BY LIB_SECT")->fetchAll(PDO::FETCH_ASSOC);

//information sur offre deposer
$req = $db->prepare("SELECT * FROM offre_ent where ID_ENT =:id_ent ORDER BY DATE_OFFRE_ENT DESC");
$req->bindParam(":id_ent", $_SESSION['ID_ENT']);
$req->execute();
$offre = $req->fetchAll();
$nbreOffre = $req->rowCount();

// SERVICES ORH ET SOSCRIPTIONS De lentreprise
// liste des services auxquels lentr.. n'a pas encore souscrire
$req = $db->prepare("SELECT * FROM service_ent where ID_SERV_ENT NOT IN (SELECT ID_SERV_ENT FROM souscrire_ent WHERE ID_ENT=:id_ent)");
$req->bindParam(":id_ent", $_SESSION['ID_ENT']);
$req->execute();
$services = $req->fetchAll();
// services auxquels elle a souscrire
$req = $db->prepare("SELECT * FROM service_ent where ID_SERV_ENT IN (SELECT ID_SERV_ENT FROM souscrire_ent WHERE ID_ENT=:id_ent)");
$req->bindParam(":id_ent", $_SESSION['ID_ENT']);
$req->execute();
$servicesEnt = $req->fetchAll();
$nbre_services = $req->rowCount();

// statut
$req = $db->prepare("SELECT * FROM statut_ent where ID_STATUT_ENT = (SELECT ID_STATUT_ENT FROM entreprise WHERE ID_ENT=:id_ent)");
$req->bindParam(":id_ent", $_SESSION['ID_ENT']);
$req->execute();
$result= $req->fetch();
$statut = $result['LIB_STATUT_ENT'];
$descStatut = $result['DESC_STATUT_ENT'];


?>

<?php
include 'inc/barConnexionEntreprise.php';
?>
<div class="wrapper">
    <div class=" container-fluid bg-light mt-5">
        <header id="logoOrh" class="py-3">
            <a href="index.php">
                <img src="img/orh_logo.png" alt="orh_logo" height="120">
            </a>
        </header>
        <!--NavBAr-->
        <?php
        include 'inc/navbar.php'
        ?>

        <div class="corp">
            <!--******************************************************DEPOSER offre****************************-->
            <div class="row">
                <div class="col-md-4 col-sm-4 col-lg-4">
                    <div class="nav flex-column nav-pills my-3 bg-light" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                        <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true"><i class="fa fa-user-circle-o"></i> Informations Entreprise</a>
                        <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false"><i class="fa fa-file-pdf-o"></i> Déposer une offre <span class="badge badge-info"><?php echo $nbreOffre ?></span></a>
                        <a class="nav-link" id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-messages" role="tab" aria-controls="v-pills-messages" aria-selected="false"> <i class="fa fa-building-o"></i> Souscriptions <span class="badge badge-info"><?php echo $nbre_services ?></a>
                        <a class="nav-link" id="v-pills-settings-tab" data-toggle="pill" href="#v-pills-settings" role="tab" aria-controls="v-pills-settings" aria-selected="false"><i class="fa fa-gears"></i> Paramètres</a>
                    </div>
                    <div class="card border-primary mb-3">
                        <div class="card-header"><b>Statut</b></div>
                        <div class="card-body text-primary">
                            <p class="card-text"><?php echo $statut ?></p>
                        </div>
                    </div>

                    <div class="card my-3">
                        <h4 class="card-header">Votre Logo</h4>
                        <div class="card-body justify-content-center">
                            <img src=<?php echo "php/company/logo/".$entreprise['PATH_LOGO_ENT'] ?> class="card-img img-fluid" alt="photo" style="max-height: 15rem">
                        </div>
                        <div class="card-footer">
                            <form action="php/modifierLogo.php" id="formLogo"method="post" enctype="multipart/form-data">
                                <input type="file" name="logo" accept="image/*" class="btn btn-block" required>
                                <input type="submit" value="Modifier Logo" class="btn btn-block btn-outline-success">
                            </form>
                        </div>
                    </div>
                    <div class="card my-3">
                        <h4 class="card-header">La photot de l'interlocuteur</h4>
                        <div class="card-body justify-content-center">
                            <img src=<?php echo "php/company/photo_inter/".$interlocuteur['PATH_PHOTO_INTER'] ?> class="card-img img-fluid" alt="photo" style="max-height: 15rem">
                        </div>
                        <div class="card-footer">
                            <form action="php/modifierLogo.php" method="post" enctype="multipart/form-data">
                                <input type="file" name="photo" accept="image/*" class="btn btn-block" required>
                                <input type="submit" value="Modifier photo" class="btn btn-block btn-outline-success">
                            </form>
                        </div>
                    </div>

                </div>
                <div class="col-lg-8 col-md-8 col-sm-8">
                    <div class="tab-content" id="v-pills-tabContent">
                        <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab"><div class="container bg-light mb-5">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>INFORMATIONS SUR VOTRE ENTREPRISE</h4>
                                    </div>
                                    <div class="card-body">
                                        <form  method="post"  id="formEntreprise" accept-charset="UTF-8">
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="sigle">Sigle</label>
                                                    <input type="text" class="form-control form-control-sm" id="sigle" name="sigle"
                                                           placeholder="Sigle" value ='<?php echo $entreprise['SIGLE_ENT'] ?>' required>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="raison_sociale">Raison Sociale</label>
                                                    <input type="text" value='<?php echo $entreprise['RAISON_SOCIALE_ENT'] ?>' class="form-control form-control-sm" id="raison_sociale"
                                                           name="raison_sociale" placeholder="Raison Sociale" required>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="tel">Telephone</label>
                                                    <input type="tel" value='<?php echo $entreprise['TEL_ENT'] ?>' class="form-control form-control-sm" id="tel"
                                                           placeholder="Ex:+22507072020" required name="tel">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="fax">Fax</label>
                                                    <input type="text" value='<?php echo $entreprise['FAX_ENT'] ?>' class="form-control form-control-sm" id="fax"
                                                           placeholder="Votre Fax"  name="fax">
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="site">Site internet</label>
                                                    <input type="text" value='<?php echo $entreprise['SITE_ENT'] ?>' class="form-control form-control-sm" id="site"
                                                           placeholder="Ex:www.orh.com"  name="site">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="adresspos">Adresse postale</label>
                                                    <input type="text" value='<?php echo $entreprise['ADRESSE_POST_ENT'] ?>' class="form-control form-control-sm" id="adresspos"
                                                           placeholder="Votre adresse postale" required name="adresse_post">
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="commerce">Registre  De Commerce</label>
                                                    <input type="text" value=<?php echo $entreprise['REG_COM_ENT'] ?>
                                                    class="form-control form-control-sm" name="reg_com" id="commerce">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="contribuable">Compte Contribuable</label>
                                                    <input type="text" value=<?php echo $entreprise['COMPTE_CONTRIB_ENT'] ?>
                                                    class="form-control form-control-sm" name="compte_contrib" id="compte_contrib">
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="pays">Pays</label>
                                                    <select name="pays" class="form-control form-control-sm" id="pays" required>
                                                        <?php
                                                        foreach ($pays as $result) {
                                                            if ($result['ID_PAYS'] == $localiserEnt['ID_PAYS'])
                                                                echo "<option selected value='" . $result['ID_PAYS'] . "'>" . $result['LIB_PAYS'] . "</option>";
                                                            else
                                                                echo "<option  value='" . $result['ID_PAYS'] . "'>" . $result['LIB_PAYS'] . "</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="pays">Ville</label>
                                                    <select name="ville" class="form-control form-control-sm" id="ville" required>
                                                        <?php
                                                        foreach ($ville as $result){

                                                            if ($result['ID_VILLE'] == $localiserEnt['ID_VILLE'])
                                                                echo "<option selected value='" . $result['ID_VILLE'] . "'>" . $result['LIB_VILLE'] . "</option>";
                                                            else
                                                                echo "<option  value='" . $result['ID_VILLE'] . "'>" . $result['LIB_VILLE'] . "</option>";

                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="societe">Type de Societe</label>
                                                    <select name="type_soc" class="form-control form-control-sm" id="societe"
                                                            required>
                                                        <?php
                                                        foreach ($type_soc as $result){
                                                            if($result['ID_TYPE_SOC'] == $entreprise['ID_TYPE_SOC'])
                                                                echo "<option selected value='".$result['ID_TYPE_SOC']."'>".$result['LIB_TYPE_SOC']."</option>";
                                                            else
                                                                echo "<option  value='".$result['ID_TYPE_SOC']."'>".$result['LIB_TYPE_SOC']."</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="juridique">Forme Juridique</label>
                                                    <select name="form_jur" class="form-control form-control-sm" id="juridique" required>
                                                        <?php
                                                        foreach ($form_jur as $result){
                                                            if($result['ID_FORM_JUR'] == $entreprise['ID_FORM_JUR'])
                                                                echo "<option selected value='".$result['ID_FORM_JUR']."'>".$result['LIB_FORM_JUR']."</option>";
                                                            else
                                                                echo "<option value='".$result['ID_FORM_JUR']."'>".$result['LIB_FORM_JUR']."</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-12">
                                                    <label for="secteur">Secteurs d'Activités(Maintenez Ctrl pour une sélection multiple)</label>
                                                    <select multiple name="sect_act[]" class="form-control form-control-sm" id="secteur"
                                                            required>
                                                        <?php
                                                        $trouve = false;
                                                        foreach ($sect_act as $result){
                                                            foreach ($sect_act_ent as $result2){
                                                                if($result['ID_SECT'] == $result2['ID_SECT'] ){
                                                                    echo "<option selected value='".$result['ID_SECT']."'>".$result['LIB_SECT']."</option>";
                                                                    $trouve = true ;
                                                                }

                                                            }
                                                            if(!$trouve) echo "<option value='".$result['ID_SECT']."'>".$result['LIB_SECT']."</option>";
                                                            $trouve = false;
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="card-header">
                                                <h4>Informations interlocuteur</h4>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="nom">Nom</label>
                                                    <input type="text" value=<?php echo strtoupper($interlocuteur['NOM_INTER']) ?>
                                                    class="form-control form-control-sm" id="nom" name="nom" placeholder="Nom" >
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="prenom">Prenom</label>
                                                    <input type="text" value=<?php echo strtolower($interlocuteur['PRENOM_INTER']) ?>
                                                    class="form-control form-control-sm" id="prenom" name="prenom" placeholder="Prenom" >
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="genre">Genre</label>
                                                    <select name="genre" class="form-control form-control-sm" id="genre" >
                                                        <?php
                                                        foreach ($genre as $result){
                                                            if($result['ID_GENRE'] == $interlocuteur['ID_GENRE'])
                                                                echo "<option selected value='".$result['ID_GENRE']."'>".$result['LIB_GENRE']."</option>";
                                                            else
                                                                echo "<option value='".$result['ID_GENRE']."'>".$result['LIB_GENRE']."</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="fonction">Fonction</label>
                                                    <input type="text" value=<?php echo $interlocuteur['FONCTION_INTER']?>
                                                    class="form-control form-control-sm" placeholder="Votre fonction dans l'entreprise" id="fonction"   name="fonction" >
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="emailinter">Email</label>
                                                    <input type="email" value=<?php echo $interlocuteur['EMAIL_INTER']?>
                                                    name="email_inter" class="form-control form-control-sm" id="email_inter"  placeholder="email" >
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="tel_inter">Mobile</label>
                                                    <input type="tel" value=<?php echo $interlocuteur['TEL_INTER']?>
                                                    name="tel_inter" class="form-control form-control-sm" id="tel_inter" placeholder="mobile">
                                                </div>
                                            </div>

                                            <input type="submit" class="btn btn-outline-primary " id="send">


                                        </form>
                                    </div>
                                    <div class="card-footer">
                                        <div class="row">
                                            <div class="col-md-12">
                                                ORH Outils et Solutions dédiés GRH
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="progress progress-striped active">
                                                    <div id="progressionFormEntreprise" class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
                                                        0%
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                            <form action="php/deposerOffre.php" method="post" enctype="multipart/form-data" class="form-group">
                                <label class="control-label">Sélectionnez Fichier</label>
                                <div class="file-loading">
                                    <input id="input-fa" name="offre" type="file" required accept="application/pdf">
                                </div>
                                <input type="submit" class="btn btn-outline-success my-3" value="Envoyer l'offre" name="envoyerOffre" id="envoyerOffre">
                            </form>
                            <?php
                            echo"<b>".$descStatut."</b>"
                            ?>
                            <div class="card mt-5">
                                <h3 class="card-header">
                                    </i> Liste de vos Offres
                                </h3>
                                <?php
                                if (empty($offre)){
                                    echo "<div class=\"card-body\">
                                <ul class=\"list-group\">
                                    <li class=\"list-group-item d-flex justify-content-between\">
                                        Aucune offre déposée.
                                    </li>
                                </ul>
                            </div>";
                                }else{
                                    foreach($offre as $result)
                                        echo "<div class='card-body'>
                                <ul class='list-group'>
                                    <li class='list-group-item d-flex justify-content-between'>
                                        <a href=./php/company/offre/".$result['PATH_OFFRE_ENT']." target='_blank'>offre du ".$result['DATE_OFFRE_ENT']. "></a>
                                            <form action='php/supp_offre_ent.php' method='post'>
                                            <input type='hidden' value='" .$result['ID_OFFRE_ENT']."' name='id_offre'>
                                                <button class='btn btn-outline-danger'>Supprimer</button>
                                            </form>
                                    </li>
                                </ul>
                                </div>";
                                }

                                ?>

                            </div>

                        </div>
                        <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab"> Les souscriptions
                            <div class="card mt-5">
                                <h3 class="card-header">
                                    <strong>Liste de nos services</strong>
                                </h3>

                                <?php
                                foreach ($services as $result){
                                    echo"<div class='card-body'>
                                <ul class='list-group'>
                                    <li class='list-group-item d-flex justify-content-between'><h6 class='d-inline'>
                                    ".$result['LIB_SERV_ENT']."</h6><br>
                                    <p class='d-inline'>".$result['DESC_SERV_ENT']."</p>
                                        <div class='justify-content-end'>
                                            <form action='php/souscriptionEntreprise.php' method='post'>
                                                <input type='hidden' value=".$result['ID_SERV_ENT']." name='id_service'>
                                                <input class='btn btn-outline-success' type='submit' value='souscrire'>
                                            </form>

                                        </div>
                                    </li>

                                </ul>
                            </div>";
                                }
                                ?>
                            </div>
                            <div class="card mt-5">
                                <h3 class="card-header">
                                    <strong>Services auxquels vous avez souscris</strong>
                                </h3>
                                <?php
                                foreach ($servicesEnt as $result){
                                    echo"<div class='card-body'>
                                <ul class='list-group'>
                                    <li class='list-group-item d-flex justify-content-between'><h6 class='d-inline'>
                                    ".$result['LIB_SERV_ENT']."</h6><br>
                                    <p class='d-inline'>".$result['DESC_SERV_ENT']."</p>
                                        <div class='justify-content-end'>
                                            <form action='php/deSouscriptionEntreprise.php' method='post'>
                                                <input type='hidden' value=".$result['ID_SERV_ENT']." name='id_service'>
                                                <input class='btn btn-outline-danger' type='submit' value='Desouscrire'>
                                            </form>

                                        </div>
                                    </li>

                                </ul>
                            </div>";
                                }
                                ?>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Modifier mes paramètres</h4>
                                </div>
                                <div class="card-body">

                                    <form action="php/modifierMdpEntreprise.php" id="modifMdpEntreprise" method="post"  class="my-3">
                                        <div class="form-row">
                                            <div class="form-group col-md-4">
                                                <label for="mdp">Ancien mot de passe </label>
                                                <input type="password" class="form-control form-control-sm" id="mdp"
                                                       placeholder="Mot de passe"  name="mdp" required>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="mdpNew">Nouveau Mot de Passe</label>
                                                <input type="password" class="form-control form-control-sm" id="mdpNew"
                                                       placeholder="Mot de passe" required name="mdpNew">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="mdpverif">Confirmer mot de passe</label>
                                                <input type="password" class="form-control form-control-sm" id="mdpverif"
                                                       placeholder="Confirmer le mot de passe" required name="mdpVerif">
                                            </div>
                                        </div>
                                        <input type="submit" value="Modifier Mot de passe" class="btn btn-outline-success">
                                        <input type="reset" class="btn btn-outline-danger " id="resetMdp">
                                    </form>

                                </div>

                            </div>
                            <div class="card-footer">
                                ORH Outils et Solutions dédiés GRH
                            </div>
                        </div>


                    </div>
                </div>



            </div>
        </div>

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
<?php
include './modalORHInformation.html';
?>

<!---***********Script*****************-->


<script>
    $("#input-fa").fileinput({
        theme: "fa",
        language: "fr",
        allowedFileExtensions: ["pdf", "doc", "docx"]
    });


</script>

<script src="js/orh_profil_entreprise.js"></script>
</body>

</html>
