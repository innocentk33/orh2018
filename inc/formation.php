

<div class="card bg-light border-0 mb-3 formation">
    <div class=" card-header">
        <span class="formationTitre"><h5 class="text-center ">Formation <i class="fa fa-laptop"></i></h5></span>
    </div>
    <ul class="list-group text-left scroll">
    <?php
    $formations = $db->query("SELECT * FROM service_cnd where DATE_SERV_CND >=CURDATE()    ORDER BY DATE_SERV_CND")->fetchALL(PDO::FETCH_ASSOC);
    foreach ($formations as $formation ) { ?>
        <li class="list-group-item scroll">
        


        <p class="scroll text-capitalize ">
        <b><?php echo $formation['LIB_SERV_CND']?></b>
      <?php
        echo $formation['DESC_SERV_CND']
      ?>
     
            <span>Expire le : <?php
            echo $formation['DATE_SERV_CND']
            
            ?></span>
        </p>
    </li>
<?php
    }
    ?>
    </ul>
    <div class="card-footer text-center">
        <a href="#" class="text-center">
            <a class="btn btn-danger btn-block text-white" style="a:hover{color: #FFF;}">Voir plus de formation..</a>
        </a>
    </div>
</div>