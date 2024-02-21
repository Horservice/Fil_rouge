<?php $titles = "Futur Game - Page d'accueil"; 
 ob_start(); 
?>


<style>

  @media only screen and (max-width: 767px) {
    /* Styles for screens smaller than 768px (typical mobile devices) */

  }

  
  .a-categories{  
    color: black;
  }

  .a-categories:hover{
    color: black;
  }



  .bg-custom-categories {
  background-image: linear-gradient(-45deg, hwb(20 0% 0% / 0.497) 30%, rgb(255, 255, 255) 25%);
  transition: background-image 0.3s ease, transform 0.3s ease; /* Ajout d'une transition pour une animation fluide */
}

.bg-custom-categories:hover {
  background-image: linear-gradient(-45deg, hwb(20 0% 0% / 0.497) 70%, rgb(255, 255, 255) 25%);
  transform: scale(1.05); /* Vous pouvez ajuster la valeur selon votre préférence */
}

  
.card-custom {

    transition: transform 0.3s ease; /* Ajoute une transition à la propriété transform */
}



  .card-custom:hover{
    transform: scale(1.05); /* Vous pouvez ajuster la valeur selon votre préférence */
  }

  /* .img-fit-object {
      object-fit: cover; 
      width: 100%;
      height: 100%;
  } */

  .bg-custom {
      background-color: rgb(152, 56, 56);
      color:white;
    }

  .cat-img{
    max-width: 128px;
    max-height: 128px;
  }




  /* .btn-custom-voir {
    background-color: orangered;
    border-color: orangered;
    color: white;
    transition: transform 0.3s ease;


}

.btn-custom-voir:hover,
.btn-custom-voir:active,
.btn-custom-voir:focus,
.btn-custom-voir:active:focus {
  border-color: darkorange;
  color: white;
  transform: scale(1.05);
  transform: translateY(-5px);
  outline-color: darkorange;
    background-color: darkorange;
}

.btn-custom-voir:active:focus{

  transform: translateY(4px);


}
*/

/* Notif MyAlert*/
.close{

opacity: 100%;
background-color: white;
color:white;

}

.close:hover{

opacity: 100%;
background-color: rgb(255, 255, 255);

}

</style>



<?= $message ?>



<div class="container-fluid py-5 bg-custom shadow" >
  <h2 class="fs-3 text-center">Les trois nouveaux jeux récemment sortis</h2>
</div>


<div class="container py-5 ">
    <div class="row gy-4 row-cols-2 ">
      <?php foreach ($newGames as $key => $game): ?>
        <div class="col-lg-6 mx-auto">
          <div class="card shadow card-custom h-100 ">
            <div class="row g-0  ">
              <div class="col-lg-4 ">
                <img src="../../Back_end/uploads/<?=$game['path']?>" loading="lazy" decoding="async" class="img-fluid object-fit-cover " alt="<?= $game['name'] ?>">
              </div>
              <div class="col-lg-8">
                <h5 class="card-header"><?= $game['name'] ?></h5>
                <div class="card-body">
                  <p class="card-text"><?= $game['genre'] ?> / <?=$game['sub_category_name']?><br><?= $game['platform_name'] ?><br><?= $game['price'] ?>€</p>
                  <a href="index.php?page=games&id=<?= urlencode($game['game_id']) ?>" class="btn btn-custom-voir shadow rounded-pill ">Voir</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>

</div>

<div class="container-fluid py-5 bg-custom shadow">
  <h3 class="fs-3 text-center" >Catégorie</h3>
</div>

  <div class="container py-5"> 

    <div class="row row-cols-2 row-cols-md-2 g-4 ">
      <?php foreach ($categories as $categorie) { ?>
      <div class="col justify-content-center mx-auto">
        <div class="card shadow bg-custom-categories border-0 py-4 text-center"> <!-- Correction ici -->
            <a href="index.php?page=category&id=<?= urlencode($categorie['category_id']) ?>" class="fs-1 link-offset-2 link-underline link-underline-opacity-0 a-categories"><?= $categorie['name'] ?><br><img src="../../Back_end/uploads/<?= $categorie['path'] ?>" alt="<?= $categorie['alt'] ?>" class="img-fluid cat-img">
            </a>
        </div>
      </div>
      <?php } ?>
    </div>
    
  
</div>


<div class="container-fluid py-5 bg-custom shadow">

  <h4 class="fs-3 text-center">Nouveaux Jeux  </h4>
  
</div>





<div class="container py-5 ">
  <div class="row gy-4 row-cols-2">
    <?php foreach ($Games20 as $Game20) { ?>
      <div class="col-lg-6 mx-auto">
        <div class="card card-custom h-100 shadow ">
          <div class="row g-0 ">
          
            <div class="col-lg-4 teste">
              <img src="../../Back_end/uploads/<?=$Game20['path']?>" class="img-fluid object-fit-cover" alt="<?=$Game20['alt']?>">
            </div>
            <div class="col-lg-8">
              <h5 class="card-header"><?=$Game20['name']?></h5>
              <div class="card-body">
                <p class="card-text"><?=$Game20['genre']?> / <?=$Game20['sub_category_name']?><br><?=$Game20['platform_name']?><br><?=$Game20['price']?>€<br></p>
                <a href="index.php?page=games&id=<?= urlencode($Game20['game_id']) ?>" class="btn btn-custom-voir btn-primary rounded-pill ">Voir</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    <?php } ?>
  </div>
</div>


<script>
document.getElementById('notif').querySelector('.close').addEventListener('click', function() {
  document.getElementById('myAlert').style.display = 'none';
});

  
</script>




<?php $content = ob_get_clean(); ?> 
<?php require('layout.php') ?>