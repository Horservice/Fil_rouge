<?php $titles = "Futur Game -  Sous Catégorie !"; ?>
<?php ob_start(); ?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Bootstrap demo</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>

  <style>
    /* .bg-custom-all{

      background-color: rgba(128, 128, 128, 0.35);
      border-radius: 30px;
    } */

    .bg-custom-sub_categorys{

      background-color: white;

      border-radius: 20px;
    }



    .pagination {
                    display: flex;
                    justify-content: center;
                    list-style: none;
                }
                .page-item {
              margin: 0 5px;
        }

        .page-link {
            text-decoration: none;
            padding: 5px 10px;
            border: 1.5px solid rgba(0, 0, 0, 0);
            border-radius: 3px;
            color: white;
            background-color: #983838;
            
        }




        .page-link:hover,
        .page-link:active {
            background-color: #983838ab;
            color: white;
            border: 1.5px solid rgba(0, 0, 0, 0);
        }

        .page-link:focus {
            outline: none;
            box-shadow: 0 0 0 2px #fff, 0 0 0 4px #983838;
            
        }

        .page-item.disabled .page-link {
            pointer-events: none;
            background-color: #dddddd;
            color: #888;
            border: 1px solid #ddd;
        }

        .bg-custom{

background-color: #983838;
}

  </style>

<div class="container">
  <div class="container py-3">
    <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.php?page=homepage">Accueil</a></li>
      <li class="breadcrumb-item"><a href="index.php?page=category&id=<?=$categorys['category_id']?>"><?=$categorys['name']?></a></li>
      <li class="breadcrumb-item active" aria-current="page"><?=$sub_categorys['name']?></li>
    </ol>
  </nav>
  </div>

  <div class="container bg-custom-all bg-body-secondary rounded-5 shadow py-5">

  <div class="container w-50 bg-custom rounded-5 shadow py-2"  id="games">
    <h1 class="text-center text-white">Sous Catégorie <br><?=$sub_categorys['name']?> </h1>
  </div>

    <div class="row row-cols-2 py-5">
      <?php foreach ($paginatedGames as $Game) : ?>
        <div class="col-md-6">
          <div class="card mb-3">
            <div class="row g-0 shadow">
              <div class="col-md-4 align-content-stretch">
                <img src="../../Back_end/uploads/<?= $Game['path'] ?>" loading="lazy" decoding="async" class="card-img" alt="Image 1">
              </div>
              <div class="col-md-8">
                <h5 class="card-header"><?= $Game['name'] ?></h5>
                <div class="card-body">
                  <p class="card-text"><?= $Game['genre'] ?> / <?= $Game['sub_category_name'] ?><br><?= $Game['platform_name'] ?><br><?= $Game['price'] ?>€<br></p>
                  <a href="index.php?page=games&id=<?= urlencode($Game['game_id']) ?>" class="btn btn-primary rounded-pill">Voir</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>




    <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-center">
            <?php if ($currentPage > 1) : ?>
                <li class="page-item">

                    <a class="page-link " href="index.php?page=sub_category&id_sub_category=<?=$id_sub_category ?>&id_category=<?= $id_category?>&pages=<?= $currentPage - 1 ?>#games" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
            <?php endif; ?>
    
            <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
                <li class="page-item <?= ($i == $currentPage) ? 'active ' : '' ?>">
                    <a class="page-link " href="index.php?page=sub_category&id_sub_category=<?=$id_sub_category ?>&id_category=<?= $id_category?>&pages=<?= $i ?>#games"><?= $i ?></a>
                </li>
            <?php endfor; ?>
    
            <?php if ($currentPage < $totalPages) : ?>
                <li class="page-item">
                    <a class="page-link " href="index.php?page=sub_category&id_sub_category=<?=$id_sub_category ?>&id_category=<?= $id_category?>&pages=<?= $currentPage + 1 ?>#games" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            <?php endif; ?>
        </ul>
    </nav>



  </div>



<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html> -->


<?php $content = ob_get_clean(); ?> 
<?php require('layout.php') ?>