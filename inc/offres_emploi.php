
<div class="card bg-light border-0 offreEmploi">
    <div class=" card-header border-0">
        <span class="offreTitre"><h6 class="text-center ">Nouvelles Offres d'Emploi <i class="fa fa-file-pdf-o"></i></h6></span>
    </div>
    <ul class="list-group">
    <?php
    $offres = $db->query("SELECT * FROM offre_site where DATE_EXPIRATION>=CURDATE()  ORDER BY DATE_EXPIRATION")->fetchAll(PDO::FETCH_ASSOC);
    foreach ($offres as $offre) {
       
?>
       
        <li class="list-group-item text-capitalize">
                <p class="my-1"><b><?php echo $offre['OFFRE_SITE'] ?></b></p>
                <span>Expire le : <?php echo $offre['DATE_EXPIRATION'] ?></span>
           
        </li>
    </ul>
<?php
    }
?>

</div>