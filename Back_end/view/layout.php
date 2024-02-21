<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
  <title><?=$title?></title>
</head>
<style>

  .teste{

    height: 100vh;

    background: linear-gradient(336deg, rgba(0,0,0,0) 49%, rgba(240,240,240,1) 49%);

    
  }

  .teste a{
      color: black;
      border-radius: 15px;

  }

  .teste a:hover{
      color: rgb(0, 0, 0);
      background-color: rgba(255, 213, 0, 0.63);
      border-radius: 15px;
  }


  .mobile{

  display: none;
  }

  @media (max-width: 768px) {

    .mobile{

      display: block;
    }

    .desktop{

      display: none;
    }

    .teste2{

    color: black;
      border-radius: 15px;

    }
    .teste2 a:hover{
      color: rgb(0, 0, 0);
      background-color: rgba(255, 213, 0, 0.63);
      border-radius: 15px;
    }

    .dropdown-menu {
      background-color: white(255, 255, 255, 0.475);
    }


    
  }




</style>
<body>
  <header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">Futur Game - Gestion  </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ms-auto desktop">
            <li class="nav-item ">
              
              <a class="nav-link" href="index.php?action=signout">Déconnexion</a>
            </li>
          </ul>
          <ul class="navbar-nav ms-auto mobile ">
            <li class="nav-item">
              <a class="nav-link" aria-current="page" href="index.php?page=dashboard">
                Tableau de bord
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="index.php?page=management_admin">
                Admin
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="index.php?page=management_game">
                Jeux
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="index.php?page=management_plateforms">
                Plateforme
              </a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Catégorie
              </a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="index.php?page=management_categories">Catégorie</a></li>
                <li><a class="dropdown-item" href="index.php?page=management_sub_categories">Sous Catégorie</a></li>
              </ul>
            </li>
            <li class="nav-item ">
              <a class="nav-link" href="index.php?action=signout">Déconnexion</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </header>

    <div class="container-fluid ">
      <div class="row">
        <nav id="sidebarMenu" class="teste col-md-2 col-lg-2 d-md-block  sidebar collapse ">
          <div class="position-sticky pt-3">
            <ul class="nav flex-column">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="index.php?page=dashboard">
                  Tableau de bord
                </a>
              </li>
              <li class="nav-item">
              <a class="nav-link" href="index.php?page=management_admin">
                Admin
              </a>
            </li>
              <li class="nav-item">
              <a class="nav-link" href="index.php?page=management_game">
                  Jeux
                </a>
              </li>
              <li class="nav-item">
              <a class="nav-link" href="index.php?page=management_plateforms">
                  Plateforme
                </a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Catégorie
                </a>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="index.php?page=management_categories">Catégorie</a></li>
                  <li><a class="dropdown-item" href="index.php?page=management_sub_categories">Sous Catégorie</a></li>
                </ul>
              </li>
            </ul>
          </div>
        </nav>

        <div class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
          <main>

            <?= $content ?>

          </main>
        </div>
      </div>
    </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>
</html>