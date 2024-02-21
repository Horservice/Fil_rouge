<?php $titles = "Futur Game -  Jeux recherche !"; 
 ob_start(); ?>


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>

      /* Faire que le accordion soit en order 1 en mobile ? */



    </style>
  </head>
  <body>

  <?php

if (empty($Game)) {
  echo"Aucun jeux existe";
}

?>



    <div class="container bg-info">
        

        
      <div class="container">
        <div class="row row-cols-2 row-cols-lg-2 g-2 g-lg-3 ">
          <?php foreach ($Game as $Game20) { ?>
            <div class="col col-md-6 mx-auto">
                  <div class="card mb-3 card-custom h-100 shadow s">
                      <div class="row g-0 ">
                          <div class="col-md-4">
                              <img src="../../Back_end/uploads/<?=$Game20['path']?>" class="img-fluid object-fit-cover  " alt="Image 1">
                          </div>
                          <div class="col-md-8 ">
                              <h5 class="card-header"><?=$Game20['name']?></h5>
                              <div class="card-body ">
                                  <p class="card-text"><?=$Game20['genre']?> / <?=$Game20['sub_category_name']?><br><?=$Game20['platform_name']?><br><?=$Game20['price']?>€<br></p>
                                  <a href="index.php?page=games&id=<?= urlencode($Game20['game_id']) ?>" class="btn btn-custom-voir btn-primary rounded-pill">Voir</a>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          <?php } ?>

        </div>
      </div>
      
      
      
      
      
    </div>



  </body>
</html>

<script>





</script>


<?php $content = ob_get_clean(); 
require('layout.php') ?>