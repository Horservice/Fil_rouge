<?php 
$titles = "Futur Game - Catégorie"; 
ob_start(); 
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>


        .bg-custom-cateogries {
            background-image: linear-gradient(-45deg, rgba(255, 0, 0, 0.497) 30%, rgb(255, 255, 255) 25%);
            transition: transform 0.3s ease;
        }

        .bg-custom-cateogries:hover {
            transform: scale(1.05);
            transform: translateY(-5px);
        }

        .bg-custom-cateogries:active {
            transform: translateY(4px);

            background-image: linear-gradient(-45deg, rgba(255, 0, 0, 0.497) 100%, rgb(255, 255, 255) 25%);


        }

        .a-categories {
            color: black;
        }

        .a-categories:hover {
            color: rgb(0, 0, 0);
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





        .bg-category-name {
            background-color: white;
            border-radius: 15px;
        }

        .card-custom {
            transition: transform 0.3s ease;
        }

        .card-custom:hover {
            transform: scale(1.05);
        }
        .bg-custom{

background-color: #983838;
}
    </style>
</head>

<body>
    <div class="container py-3 ">
        <nav aria-label="breadcrumb ">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php?page=homepage">Accueil</a></li>
                <li class="breadcrumb-item active" aria-current="page"><?= $categorys['name'] ?></li>
            </ol>
        </nav>
    </div>

    <div class="container rounded-5 bg-body-secondary p-5 shadow">
        <div class="container-fluid mx-auto bg-category-name bg-custom py-2 shadow">
            <h1 class="text-center text-white">Catégorie <?= $categorys['name'] ?></h1>
        </div>

        <div class="container pt-5">
            <h3 class="fs-3">Sous Catégorie lié a <?= $categorys['name'] ?></h3>
        </div>

        <div class="container pt-5 ">
            <div class="row row-cols-2 row-cols-md-3 g-4">
                <?php foreach ($sub_categories as $sub_category) : ?>
                    <div class="col justify-content-center mx-auto">
                        <a class="link-offset-2 link-underline link-underline-opacity-0 h-100 a-categories card card-body text-center shadow bg-custom-cateogries border-0 rounded-pill py- d-flex flex-fill" href="index.php?page=sub_category&id_sub_category=<?= urlencode($sub_category['sub_category_id']) ?>&id_category=<?= $sub_category['category_id'] ?>"><?= $sub_category['name'] ?></a>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="container pt-5">
            <h4 class="fs-3">Jeux lié a la Catégorie <?= $categorys['name'] ?></h4>
        </div>

        <div class="container pt-5 teste " id="games">
            <div class="row row-cols-2" id="games-container">
                <?php foreach ($paginatedGames as $Game) : ?>
                    <div class="col col-md-6 mx-auto">
                        <div class="card card-custom mb-3">
                            <div class="row g-0 shadow h-100">
                                <div class="col-md-4 align-content-stretch">
                                    <img src="../../Back_end/uploads/<?= $Game['path'] ?>" loading="lazy" decoding="async" class="card-img img-fit-object h-100" alt="<?= $Game['alt'] ?>">
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
        </div>

        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center">
                <?php if ($currentPage > 1) : ?>
                    <li class="page-item">
                        <a class="page-link" href="index.php?page=category&id=<?= $id ?>&pages=<?= $currentPage - 1 ?>#games" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                <?php endif; ?>

                <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
                    <li class="page-item <?= ($i == $currentPage) ? "active" : '' ?>">
                        <a class="page-link" href="index.php?page=category&id=<?= $id ?>&pages=<?= $i ?>#games"><?= $i ?></a>
                    </li>
                <?php endfor; ?>

                <?php if ($currentPage < $totalPages) : ?>
                    <li class="page-item">
                        <a class="page-link" href="index.php?page=category&id=<?= $id ?>&pages=<?= $currentPage + 1 ?>#games" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        </nav>
    </div>
</body>

</html>

<?php 
$content = ob_get_clean();
require('layout.php');
?>
