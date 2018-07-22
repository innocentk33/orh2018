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
    <link rel="stylesheet" href="../css/windows10_icon.css">
    <link rel="stylesheet" href="css/styleA.css">

</head>
<body class="bg-light">
<?php
/**
 * Created by PhpStorm.
 * User: inno-kirito
 * Date: 17/01/2018
 * Time: 21:59
 */
session_start();
session_cache_limiter('no-cahe');

if(!isset($_SESSION['ID_ADMIN'])){
    header('Location: index.php');
}

include '../php/connexionBD.php';




//CANDIDATS
//  LES CRITERES DE RECHERCHES
$genre = $db->query("SELECT * FROM genre ORDER BY LIB_GENRE")->fetchAll(PDO::FETCH_ASSOC);
$sit_mat = $db->query("SELECT * FROM sit_matrimoniale ORDER BY LIB_SIT_MAT")->fetchAll(PDO::FETCH_ASSOC);
$sit_prof = $db->query("SELECT * FROM sit_professionnelle ORDER BY LIB_SIT_PROF")->fetchAll(PDO::FETCH_ASSOC);
$dom_comp = $db->query("SELECT * FROM domaine_comp ORDER BY LIB_DOM")->fetchAll(PDO::FETCH_ASSOC);
$niv_etude = $db->query("SELECT * FROM niveau_etude ORDER BY LIB_NIVEAU")->fetchAll(PDO::FETCH_ASSOC);
$contrat = $db->query("SELECT * FROM contrat ORDER BY LIB_CONTRAT")->fetchAll(PDO::FETCH_ASSOC);
$langue = $db->query("SELECT * FROM langue ORDER BY LIB_LANG")->fetchAll(PDO::FETCH_ASSOC);

//candidatsvus
if (!empty($_POST)){
    if(!empty($_POST['id_cnd'])){
        $req=$db->prepare("select * from candidat where ID_CND=:id_cnd");
        $req->bindParam(":id_cnd", $_POST['id_cnd']);
        $req->execute();
    }else{
        $legenre = (!empty($_POST['genre']))?$_POST['genre']:'.';
        $ledom = (!empty($_POST['dom_comp']))?$_POST['dom_comp']:'.';
        $leniveau = (!empty($_POST['niveau']))?$_POST['niveau']:'.';
        $lannee = (!empty($_POST['anexp']))?$_POST['anexp']:0;
        $lecontrat = (!empty($_POST['contrat']))?$_POST['contrat']:'.';
        $lasit_prof = (!empty($_POST['sit_prof']))?$_POST['sit_prof']:'.';
        $lasit_mat = (!empty($_POST['sit_mat']))?$_POST['sit_mat']:'.';
        $lalang = (!empty($_POST['lang']))?$_POST['lang']:'.';

        $rech = (!empty($_POST['rech']))?$_POST['rech']:'.';


        $req=$db->prepare("select * from candidat where 
         ( NOM_CND regexp(:rech) or PRENOM_CND regexp(:rech) ) and
         ID_GENRE regexp(:genre) and
         ID_NIVEAU regexp(:niveau) and
         ANNEE_EXP_CND >=:annee AND 
         ID_CONTRAT regexp(:contrat) AND 
         ID_SIT_PROF regexp(:sit_prof) and
         ID_SIT_MAT regexp(:sit_mat) AND 
         ID_CND in (select ID_CND from avoir_dom where ID_DOM regexp(:dom)) AND 
         ID_CND in (select ID_CND from parler where ID_LANG regexp(:lang) ) 
         
         ");
        $req->bindParam(":rech", $rech);
        $req->bindParam(":genre", $legenre);
        $req->bindParam(":niveau", $leniveau);
        $req->bindParam(":contrat", $lecontrat);
        $req->bindParam(":sit_prof", $lasit_prof);
        $req->bindParam(":sit_mat", $lasit_mat);
        $req->bindParam(":annee", $lannee);
        $req->bindParam(":dom", $ledom);
        $req->bindParam(":lang", $lalang);
        $req->execute();
    }


} else{
    $req = $db->query("select * from candidat WHERE ACTIF_CND='1' and ID_CND in (select ID_CND from voir_cnd) ORDER BY NOM_CND  ");
}
  $candidats = $req->fetchAll();
    $nbre_cnd = $req->rowCount();


?>
<div class="container-fluid">
    <div class="row">
        <?php
        include 'inc/sidebar.php'; // si variable introuvable veillez read dans sidebar
        //historisation cad mettre dans les candidats vus
        foreach ($NewCandidats as $cnd){
            $req=$db->prepare("insert into voir_cnd(ID_ADMIN, ID_CND) values(:id_admin, :id_cnd)");
            $req->bindParam(":id_admin", $_SESSION['ID_ADMIN']);
            $req->bindParam(":id_cnd", $cnd['ID_CND']);
            $req->execute();
        }
        ?>

        <div class="col-md-10">
            <?php
            include 'inc/navbar.php'
            ?>

            <!--Dashboard***************************************-->
            <div class="container-fluid bg-white">
                <?php
                if($nbreNewCnd!=0){
                ?>

                <div class="card mt-3">
                    <h3 class="card-header bg-success text-white text-center">
                        <i class="fa fa-users"></i> CANDIDAT(S) RECEMMENT INSCRIT(S)
                    </h3>
                    <div class='card-body'>

                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th scope="col">Nom</th>
                                <th scope="col">Prenom</th>
                                <th scope="col">Email</th>
                                <th scope="col">Téléphone</th>
                                <th scope="col"></th>

                            </tr>
                            </thead>
                            <?php
                            foreach ($NewCandidats as $cnd){
                                //recuperer le cv
                                $req=$db->prepare("SELECT * FROM cv WHERE ID_CND=:id_cnd ");
                                $req->bindParam(":id_cnd", $cnd['ID_CND']);
                                $req->execute();
                                $cv = $req->fetch();




                                echo "<tr>
                                        
                                        <td scope='row'>".htmlspecialchars(strtoupper($cnd['NOM_CND']))."</td>
                                        <td>".htmlspecialchars($cnd['PRENOM_CND'])."</td>
                                        <td>".htmlspecialchars($cnd['EMAIL_CND'])."</td>
                                        <td>".htmlspecialchars($cnd['CONTACT_CND'])."</td>
                                        <td>
                                        <button class='btn btn-outline-info ml-auto mx-2'  data-target='#".$cnd['ID_CND']."' data-toggle='modal' >+ d'info</button>";

                                if($cv) echo  "<a href='../php/user/cv/".$cv['LIB_CV']."' class='btn btn-outline-success ml-auto mx-2' target='_blank' >CV pdf</a>
                                        <a href='../php/user/cv/".$cv['LIB_CV']."' class='btn btn-outline-primary' download='".$cnd['NOM_CND'].".pdf'>Telecharger CV pdf</a>
                                     </td>
                                    </tr>";

                            }

                            ?>
                            </tbody>
                        </table>
                    </div>

                </div>

                <?php
                }
                ?>

                <div class="card">
                    <div class="card-header text-center text-secondary">
                        <h4><strong>CRITERES DE RECHERCHE</strong></h4>
                    </div>
                    <div class="card-body">
                        <form method="post" id="formCandidat">


                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <label for="civilite" class="text-info"><strong>Genre</strong></label>
                                    <select name="genre" class="form-control form-control-sm" id="civilite" >
                                        <option value="" selected disabled>Peu importe</option>
                                        <?php
                                        foreach ($genre as $result){
                                            echo "<option value='".$result['ID_GENRE']."'>".$result['LIB_GENRE']."</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="competence" class="text-info"><strong>Domaine de compétence</strong></label>
                                    <select name="dom_comp" class="form-control form-control-sm" id="competence" >
                                        <option value="" selected disabled>Peu importe</option>
                                        <?php
                                        foreach ($dom_comp as $result){
                                            echo "<option value='".$result['ID_DOM']."'>".$result['LIB_DOM']."</option>";
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="form-group col-md-3">
                                    <label for="niveau" class="text-info"><strong>Niveau d'étude</strong></label>
                                    <select name="niveau" class="form-control form-control-sm" id="niveau" >
                                        <option value="" selected disabled>Peu importe</option>
                                        <?php
                                        foreach ($niv_etude as $result){
                                            echo "<option value='".$result['ID_NIVEAU']."'>".$result['LIB_NIVEAU']."</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="exp" class="text-info"><strong>Année d'expérience (Au moins)</strong></label>
                                    <input name="anexp" class="form-control form-control-sm" id="exp" type="number" max="50" min="0" value="0" />
                                </div>
                            </div>


                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <label for="lang" class="text-info"><strong>Langue parlée</strong></label>
                                    <select name="lang" class="form-control form-control-sm" id="lang" >
                                        <option value="" selected disabled>Peu importe</option>
                                        <?php
                                        foreach ($langue as $result){
                                            echo "<option value='".$result['ID_LANG']."'>".$result['LIB_LANG']."</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="contrat" class="text-info"><strong>Contrat Souhaité</strong></label>
                                    <select name="contrat" class="form-control form-control-sm" id="contrat" >
                                        <option value="" selected disabled>Peu importe</option>
                                        <?php
                                        foreach ($contrat as $result){
                                            echo "<option value='".$result['ID_CONTRAT']."'>".$result['LIB_CONTRAT']."</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="sit_prof" class="text-info"><strong>Situation Professionnelle</strong></label>
                                    <select name="sit_prof" class="form-control form-control-sm" id="sitprofe" >
                                        <option value="" selected disabled>Peu importe</option>
                                        <?php
                                        foreach ($sit_prof as $result){
                                            echo "<option value='".$result['ID_SIT_PROF']."'>".$result['LIB_SIT_PROF']."</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="sit_mat" class="text-info"><strong>Situation matrimoniale</strong></label>
                                    <select name="sit_mat" class="form-control form-control-sm" id="sit_mat" >
                                        <option value="" selected disabled>Peu importe</option>
                                        <?php
                                        foreach ($sit_mat as $result){
                                            echo "<option value='".$result['ID_SIT_MAT']."'>".$result['LIB_SIT_MAT']."</option>";
                                        }
                                        ?>
                                    </select>
                                </div>

                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <input name="rech" class="form-control form-control-sm" type="search" placeholder="indice dans le nom ou le prenom" />
                                </div>

                            </div>


                            <input type="hidden" name="cnd">

                            <input type="submit" class="btn btn-outline-primary " id="send" value="Rechercher">
                            <input type="reset" class="btn btn-outline-danger " id="reset">


                        </form>
                    </div>

                </div>




            </div>

            <div class="card mt-3">
                <h3 class="card-header bg-info text-white text-center">
                    <i class="fa fa-users"></i> CANDIDAT(S)
                </h3>
                <div class='card-body'>


                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th scope="col">Nom</th>
                            <th scope="col">Prenom</th>
                            <th scope="col">Email</th>
                            <th scope="col">Téléphone</th>
                            <th scope="col"></th>

                        </tr>
                        </thead>
                        <?php
                        foreach ($candidats as $cnd){
                            //recuperer le cv
                            $req=$db->prepare("SELECT * FROM cv WHERE ID_CND=:id_cnd ");
                            $req->bindParam(":id_cnd", $cnd['ID_CND']);
                            $req->execute();
                            $cv = $req->fetch();




                            echo "<tr>
                                        
                                        <td scope='row'>".htmlspecialchars(strtoupper($cnd['NOM_CND']))."</td>
                                        <td>".htmlspecialchars($cnd['PRENOM_CND'])."</td>
                                        <td>".htmlspecialchars($cnd['EMAIL_CND'])."</td>
                                        <td>".htmlspecialchars($cnd['CONTACT_CND'])."</td>
                                        <td>
                                        <button class='btn btn-outline-info ml-auto mx-2'  data-target='#".$cnd['ID_CND']."' data-toggle='modal' >+ d'info</button>";

                            if($cv) echo  "<a href='../php/user/cv/".$cv['LIB_CV']."' class='btn btn-outline-success ml-auto mx-2' target='_blank' >CV pdf</a>
                                        <a href='../php/user/cv/".$cv['LIB_CV']."' class='btn btn-outline-primary' download='".$cnd['NOM_CND'].".pdf'>Telecharger CV pdf</a>
                                     </td>
                                    </tr>";

                        }
                        ?>
                        </tbody>
                    </table>
                </div>

            </div>


    </div>
</div>
</div>


<!--***********************MODAL**********************-->
<?php
include 'inc/modal_cnd.php';
include 'inc/modal_parametre.php'
?>

<!--*************************************Script******************************-->
<script src="../js/jquery-3.2.1.min.js"></script>
<script src="../js/popper.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="./js/admin.js"></script>
</body>
</html>