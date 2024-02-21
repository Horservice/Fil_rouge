<?php
require_once('../model/categories.php');
require_once('../model/sub_category.php');
require_once('../model/plateforms.php');

$Plateforms = ShowPlateforms();

$categories = ShowCategory(); 

$sub_categorys = ShowSubCategory(); 

if (empty($DescriptionPage)) {
  $DescriptionPage = null;
}

?>
<!doctype html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="viewport">
        <meta name="description" content="<?=$DescriptionPage?>">
        <meta name="keywords" content="Jeux video,Futur Game, Déma',Vente Jeux video ">
        <meta name="author" content="Helleringer Simon">
        <meta name="theme-color" content="#000000"/>
        <title><?=$titles ?></title>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous" ></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" media="all" defer>
        <link rel="stylesheet" href="../public/assets/css/style.css" defer>
        <script async src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    </head>
<style>

  .bg-body-custom, .bg-footer{

    background-color: #983838;
    color :  white !important; 
  }


  /*Scrolls bar  */

  ::-webkit-scrollbar {
    width: 12px; /* Largeur de la barre de défilement */
  }

  ::-webkit-scrollbar-track {
    background-color: rgb(152, 56, 56);
  }

  ::-webkit-scrollbar-thumb {
    background-color: rgb(176, 133, 133);
    border-radius: 60px; /* Bordure arrondie du bouton */
  }

  ::-webkit-scrollbar-thumb:hover {
    background-color: rgb(174, 82, 82);
  }

    /*Scrolls bar  end */

  .dropdown-item:hover{ 
    background-color: grey;
    color: white;
  }


  .dropdown-item:active{

    background-color: grey;
    color: white;
  }

  .navbar-toggler{

    background-color: white !important;
    color: grey !important; 


  }



  .navbar-toggler-icon:hover{
    color: grey;
  }


  .dropdown-item:hover{
    border-radius: 15px;
  }


  body.dark-mode {
      background-color: #333;
      color: #fff; /* Couleur du texte en mode sombre */
  }

  .btn-custom-voir {
    background-color: orangered;
    border-color: orangered;
    color: white;
    transition: transform 0.3s ease;


}


/* marche si quand pas de lien de boostrap dans page dans le header doublé */
.btn-custom-voir:hover,
.btn-custom-voir:active,
.btn-custom-voir:focus,
.btn-custom-voir:active:focus {
  
  border-color: darkorange;
  color: white;
  transform: scale(1.05);
  transform: translateY(-5px);
  outline-color: darkorange;
  background-color: darkorange; /* Changer la couleur pour ces états */

}

.btn-custom-voir:active:focus{

  transform: translateY(4px);

}

#caché{
  display: none;
}

.option-custom:hover{

  background-color: darkorange !important; /* Changer la couleur pour ces états */

}

</style>

<header>                      <!-- sm ? -->
  <nav class="navbar navbar-expand-md bg-body-custom " >
      <div class="container-fluid">   
          <a class="navbar-brand text-white" href="index.php?page=homepage">
              <img src="../public/assets/image/lancement (3).png" alt="Logo" class="d-inline-block align-text-top">
              Futur Game
          </a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-basket2-fill" viewBox="0 0 16 16">
  <path d="M5.929 1.757a.5.5 0 1 0-.858-.514L2.217 6H.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h.623l1.844 6.456A.75.75 0 0 0 3.69 15h8.622a.75.75 0 0 0 .722-.544L14.877 8h.623a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1.717L10.93 1.243a.5.5 0 1 0-.858.514L12.617 6H3.383zM4 10a1 1 0 0 1 2 0v2a1 1 0 1 1-2 0zm3 0a1 1 0 0 1 2 0v2a1 1 0 1 1-2 0zm4-1a1 1 0 0 1 1 1v2a1 1 0 1 1-2 0v-2a1 1 0 0 1 1-1"/>
</svg>
          <?php
                          if (isset($_SESSION['carts']) && is_array($_SESSION['carts'])) {
                              $quantities = array_column($_SESSION['carts'], 'quantity');
                              $totalQuantity = array_sum($quantities);

                              if (!empty($totalQuantity)) {
                                  echo "<span class=\"badge rounded-pill bg-danger\">" . $totalQuantity . "</span>";
                              } else {
                                  echo "<span class=\"badge rounded-pill bg-danger\"></span>";
                              }
                          } else {
                              echo "<span class=\"badge rounded-pill bg-danger\"></span>";
                          }
                          ?>
          <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <!-- Partie à gauche de la navbar -->
              <ul class="navbar-nav me-auto">
                  <li class="nav-item">
                      <a class="nav-link active text-white" href="index.php?page=homepage">Accueil</a>
                  </li>

                  <ul class="navbar-nav me-auto">
                      <li class="nav-item dropdown">
                          <button class="nav-link dropdown-toggle text-white" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                              Jeux
                          </button>
                          <div class="dropdown-menu text-center mx-auto" style="width:400px;" aria-labelledby="navbarDropdown">
                              <div class="container">
                                  <div class="row row-cols-3">
                                      <?php foreach ($categories as $index => $categorie) { ?>
                                          <div class="col-sm-4 <?php echo ($index === count($categories) - 1) ? 'mx-auto' : ''; ?>">
                                              <a class="dropdown-item" style="width:100px" href="index.php?page=category&id=<?= urlencode($categorie['category_id']) ?>"><?= $categorie['name'] ?></a>
                                          </div>
                                      <?php } ?>
                                  </div>
                              </div>
                          </div>
                      </li>
                  </ul>
              </ul>

              <!-- Partie à droite de la navbar --> 
              <ul class="navbar-nav ml-auto">
                  <li class="nav-item">
                    
                      <a class="nav-link text-white" href="index.php?page=cart">
                      Panier 

                          <?php
                          if (isset($_SESSION['carts']) && is_array($_SESSION['carts'])) {
                              $quantities = array_column($_SESSION['carts'], 'quantity');
                              $totalQuantity = array_sum($quantities);

                              if (!empty($totalQuantity)) {
                                  echo "<span class=\"badge rounded-pill bg-danger\">" . $totalQuantity . "</span>";
                              } else {
                                  echo "<span class=\"badge rounded-pill bg-danger\">0</span>";
                              }
                          } else {
                              echo "<span class=\"badge rounded-pill bg-danger\">0</span>";
                          }
                          ?>
                      </a>
                  </li>
                </ul class="navbar-nav ml-auto">
              <ul class="navbar-nav ml-auto">
                  <li class="nav-item">
                    <?php if (isset($_SESSION['username']) && !empty($_SESSION['username'])) { ?>
                        <a class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <?php if (!empty($_SESSION['avatar'])) { ?>
                                <img src="<?= $_SESSION['avatar'] ?>" class="rounded-pill mx-2" alt="Avatar" width="40" height="40">
                            <?php } ?>
                            <?= $_SESSION['username']; ?>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-lg-end " style="width: 150px;">
                            <li><a class="dropdown-item" href="index.php?page=account">Mon Compte</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="index.php?action=signout">Se déconnecter</a></li>
                        </ul>
                    <?php } else { ?>
                        <a class="nav-link text-white" href="index.php?page=login">Se connecter</a>
                    <?php } ?>
                </li>
                

              </ul>
          </div>
      </div>
  </nav>  
</header>



<nav>
<form action="index.php" method="GET" class="form-search">
  <div class="container bg-body-custom shadow py-2 text-center rounded-bottom-3">  
    <input type="hidden" name="page" value="search">
  <div class="row">
    <div class="col">
      <input type="search" class="form-control" name="query" placeholder="Rechercher des jeux">
    </div>
    <div class="col-auto">
      <button type="submit"  class="btn btn-custom-voir rounded-5">Rechercher</button>
    </div>
    
  </div> 
  <div class="container text-center  searchmore" id="caché">
    <div class="row row-cols-2 row-cols-lg-4 g-2 g-lg-3">
      <div class="col">


        <div class="p-3">

          <select class="form-select" aria-label="Default select example" name="platform_id">
          <option selected value="">Plateforme</option>
          <?php
          foreach ($Plateforms as $plateform) {
          ?>
              <option class="option-custom" value="<?= $plateform['platform_id'] ?>"  name="<?= $plateform['platform_id'] ?>"><?= $plateform['name'] ?></option>
          <?php
          }
          ?>
          </select>
        </div>
      </div>
      <div class="col">
        <div class="p-3">
          <select class="form-select" aria-label="Default select example" name="category_id">
          <option selected value="">Catégorie</option>
          <?php
          foreach ($categories as $categorie) {
          ?>
              <option value="<?= $categorie['category_id'] ?>"  name="<?= $categorie['category_id'] ?>" ><?= $categorie['name'] ?></option>
          <?php
          }
          ?>
        </select>
      </div>
      </div>
      <div class="col">
        <div class="p-3"><select class="form-select" aria-label="Default select example" name="sub_category_id">
          <option selected value="">Sous Catégorie</option>
          <?php
          foreach ($sub_categorys as $sub_category) {
          ?>
              <option value="<?= $sub_category['sub_category_id'] ?>"  name="<?= $sub_category['sub_category_id'] ?>" ><?= $sub_category['name'] ?></option>
          <?php
          }
          ?>
        </select>
      </div>
      </div>
      <div class="col">
        <div class="p-3">
          <div class="input-group ">
          <input type="number" min="1" placeholder="Prix Max" name="price" value="price" class="form-control" aria-label="Dollar amount (with dot and two decimal places)">
            <span class="input-group-text">€</span>

          </div>
        </div>
      </div>
    </div>



  
</div>
</form>

  <div class="btn btn-show rounded-5 text-white">
    <svg  id="rotate" xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="currentColor" class="bi bi-arrow-down-circle-fill" viewBox="0 0 16 16">
      <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M8.5 4.5a.5.5 0 0 0-1 0v5.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293z"/>
    </svg>
  </div>

  </div>
</nav>

<script>
document.addEventListener('DOMContentLoaded', function() {
  var isHidden = true; // Variable pour garder une trace de l'état de l'élément caché
  var isRotated = false; // Variable pour garder une trace de l'état de rotation de l'icône

  // Sélectionner le bouton de recherche
  var btnRechercher = document.querySelector('.btn-show');

  // Sélectionner l'icône SVG avec l'ID "rotate"
  var rotateIcon = document.getElementById('rotate');

  // Ajouter un écouteur d'événement sur le bouton de recherche
  btnRechercher.addEventListener('click', function() {
    // Afficher ou cacher l'élément avec l'ID "caché" en fonction de son état actuel
    var elementCache = document.getElementById('caché');
    if (isHidden) {
      elementCache.style.display = 'block';
      isHidden = false; // Mettre à jour l'état de l'élément
    } else {
      elementCache.style.display = 'none';
      isHidden = true; // Mettre à jour l'état de l'élément
    }

    // Faire tourner l'icône de 180 degrés lorsqu'elle est cliquée
    if (!isRotated) {
      rotateIcon.style.transform = 'rotate(180deg)';
      isRotated = true;
    } else {
      rotateIcon.style.transform = 'rotate(0deg)';
      isRotated = false;
    }
  });
});
</script>
  




<main class="bg-dark-subtle">
<?= $content ?>
</main>




  <footer class="bg-footer  text-center">
    <div class="container py-5">
      <div class="row">
        <!-- Section Informations -->
        <div class="col-md-4">
          <h5>Informations</h5>
          <ul class="list-unstyled ">
            <li><a href="index.php?page=politique" class="link-light link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">Politique de confidentialité</a></li>
            <li><a href="index.php?page=condition" class="link-light link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">Conditions générales</a></li>
            <li><a href="index.php?page=mention_legal" class="link-light link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">Mention légale</a></li>
            <li><a href="index.php?page=credit_icon" class="link-light link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">Crédits des Icônes</a></li>

          </ul>
        </div>
  
        <!-- Section Navigation -->
        <div class="col-md-4">
          <h5>Navigation</h5>
          <ul class="list-unstyled">
            <li> <a href="index.php?page=homepage" class="link-light link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">Accueil</a></li>
            <li><a href="index.php?page=cart" class="link-light link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">Panier</a></li>
            <li><a href="index.php?page=contact" class="link-light link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">Contact</a></li>
          </ul>
        </div>
  
        <!-- Section Réseaux sociaux -->
        <div class="col-md-4">
          <h5>Réseaux sociaux</h5>
          <ul class="list-unstyled">
              <li><a href="#" class="link-light link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover" onclick="ShowPopUp('Facebook')"><i class="fab fa-facebook"></i> Facebook</a></li>
              <li><a href="#" class="link-light link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover" onclick="ShowPopUp('Twitter')"><i class="fab fa-twitter"></i> Twitter</a></li>
              <li><a href="#" class="link-light link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover" onclick="ShowPopUp('Instagram')"><i class="fab fa-instagram"></i> Instagram</a></li>
          </ul>
      </div>
      </div>
      <hr>
      <div class="text-center">
        <p>Helleringer Simon &copy; 2023 Futur Game</p>
      </div>
    </div>
  </footer>

  <script>
  //Footer liens réseaux sociaux
  function ShowPopUp(reseauSocial) {
      // Afficher le pop-up avec le message approprié
      alert("C'est une démo de lien pour " + reseauSocial);
  }
  //supprimer les notification de delete account
  document.getElementById('myAlert').querySelector('.close').addEventListener('click', function() {
  document.getElementById('myAlert').style.display = 'none';
});
</script>
  
</html>