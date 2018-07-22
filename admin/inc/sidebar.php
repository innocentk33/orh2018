<?php

// gestion selection de la navbar en php
$class = array(
        "dashboard"=>"nav-link",
    "dashboard"=>"nav-link",
    "cv"=>"nav-link",
    "offre_emploi"=>"nav-link",
    "souscription"=>"nav-link",
    "service"=>"nav-link",
    "ecrire_offre"=>"nav-link",
    "actualite"=>"nav-link",
    "cnd"=>"nav-link",
    "ent"=>"nav-link"
);
;
$class['dashboard']="nav-link active"; //par defaut
if (!empty($_GET))
    foreach ($_GET as $item1=>$value1)
        foreach ($class as $item2=>$value2)
            if($item1==$item2)
                $class[$item2]="nav-link active";
            else $class[$item2]="nav-link";


if (!empty($_POST))
    foreach ($_POST as $item1=>$value1)
        foreach ($class as $item2=>$value2)
            if($item1==$item2)
                $class[$item2]="nav-link active";
            else $class[$item2]="nav-link";

// remplissage des badges du sidebar

//  CV
        //ancien  cv
        $req = $db->query("select * from cv WHERE ID_CV  in (select ID_CV from voir_cv) ORDER BY DATE_MODIF_CV DESC");
        $cvs = $req->fetchAll();

        //nouveaux cv
        $req = $db->query("select * from cv WHERE ID_CV not in (select ID_CV from voir_cv) ORDER BY DATE_MODIF_CV DESC");
        $NewCvs = $req->fetchAll();
        $nbrecv = $req->rowCount();

//OFFRES

        //anciens
        $req = $db->query("select * from offre_ent where ID_OFFRE_ENT in (select ID_OFFRE_ENT from voir_offre_ent) ORDER BY DATE_OFFRE_ENT DESC ");
        $OldOffres = $req->fetchAll();


        //nouveaux

        $req = $db->query("select * from offre_ent where ID_OFFRE_ENT not in (select ID_OFFRE_ENT from voir_offre_ent) ORDER BY DATE_OFFRE_ENT DESC ");
        $newOffres = $req->fetchAll();
        $nbre_offre_ent = $req->rowCount(); // nouvelles offres


//OFFRES S'AFFICHANT SUR LE SITE
        //offres non expirées
        $req = $db->query("select * from offre_site WHERE DATE_EXPIRATION>SYSDATE() ORDER BY DATE_EXPIRATION");
        $offres = $req->fetchAll();
        $nbre_offre_site = $req->rowCount();
        //offres expirées
        $req = $db->query("select * from offre_site WHERE DATE_EXPIRATION<SYSDATE() ORDER BY DATE_EXPIRATION");
        $offres_exp = $req->fetchAll();
        $nbre_offre_exp = $req->rowCount();


// CANDIDATS

        //nouveaux candidats //recemments inscrits

        $req = $db->query("select * from candidat WHERE ACTIF_CND='1' and ID_CND not in (select ID_CND from voir_cnd)  ORDER BY NOM_CND  ");
        $NewCandidats = $req->fetchAll();
        $nbreNewCnd = $req->rowCount();

//ENTREPRISES

        //recemment inscrites
        $req = $db->query("select * from entreprise WHERE ACTIF_ENT='1' and ID_ENT not in (select ID_ENT from voir_ent) ");
        $newEntreprises = $req->fetchAll();
        $nbre_NewEnt = $req->rowCount();


?>

<div class="col-md-2">
    <a href="dashboard.php"><img src="../img/orh_logo.png" class="mb-3 img-fluid" height="100" alt=""></a>
    <!--**************MENU SIDE BAR***********-->
    <div class="nav flex-column nav-pills my-2 mt-4 text-dark bg-white" id="sidebar" role="tablist">
        <a href="dashboard.php?dashboard" class='<?php echo $class['dashboard']?>' id="sideTableauDeBord"  > <i
                    class="fa fa-dashboard"></i> Tableau de Bord</a>
        <!--Icon avec badge-->
        <a href="gestioncv.php?cv" class='<?php echo $class['cv']?>' id="sideGestionCv"><i
                    class="fa fa-file-pdf-o"></i> Gestion CV
            <span class="badge badge-info"><?php $nbrecv = ($nbrecv!=0)?$nbrecv:""; echo $nbrecv?></span>
        </a>
        <a href="offre_emploi.php?offre_emploi" class='<?php echo $class['offre_emploi']?>' id="sideOffres"  ><i
                    class="fa fa-folder-open-o"></i> Offres d'emploi
            <span class="badge badge-info"><?php $nbre_offre_ent = ($nbre_offre_ent!=0)?$nbre_offre_ent:""; echo $nbre_offre_ent?></span>
        </a>
        <a href="souscription.php?souscription" class='<?php echo $class['souscription']?>' id="sideSouscription"  > <i
                    class="fa fa-table"></i> Souscriptions</a>
        <a href="services.php?service" class='<?php echo $class['service']?>' id="sideService"  > <i
                    class="fa fa-product-hunt"></i>
            Service</a>
        <a href="ecrireoffre.php?ecrire_offre" class='<?php echo $class['ecrire_offre']?>' id="sideEcrireOffres"  ><i
                    class="fa fa-pencil"></i> Ecrire Offre
            <span class="badge badge-danger"><?php $nbre_offre_exp = ($nbre_offre_exp!=0)?$nbre_offre_exp:""; echo $nbre_offre_exp?></span>
        </a>
        <a href="actualite.php?actualite" class='<?php echo $class['actualite']?>' id="sideActualite"  ><i class="fa fa-pencil"></i>
            Ecrire Actualité</a>
        <a href="candidat.php?cnd" class='<?php echo $class['cnd']?>' id="sideCandidat"  > <i
                    class="fa fa-users"></i> Candidats
            <span class="badge badge-info"><?php $nbreNewCnd = ($nbreNewCnd!=0)?$nbreNewCnd:""; echo $nbreNewCnd?></span>
        </a>
        <a href="entreprise.php?ent" class='<?php echo $class['ent']?>' id="sideAdmin"  > <i
                    class="fa fa-building-o"></i> Entreprises
            <span class="badge badge-info"><?php $nbre_NewEnt = ($nbre_NewEnt!=0)?$nbre_NewEnt:""; echo $nbre_NewEnt?></span>
        </a>
    </div>
    <a href="./php/deconnexionAdmin"><button  class="btn btn-outline-primary my-3 btn-block"><i class="fa fa-sign-out"></i> Deconnexion</button></a>
</div>