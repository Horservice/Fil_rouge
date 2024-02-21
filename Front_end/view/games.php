<?php
$titles = "Futur Game - {$Game['name']}";
ob_start();
?>

<style>
    /* Pages games */
    .sticky-info {
        position: sticky;
        top: 20px;
    }

    .btn-custom {
        transition: 0.3s;
    }

    .btn-custom:hover {
        transform: translateY(-5px);
    }

    .btn-custom:active {
        transform: translateY(4px);
    }

    .card-header {
        background-color: rgb(152, 56, 56);
        color: white !important ;
    }


    

    /* // Pages games // */
</style>



<div class="container py-5 ">
    <div class="card shadow border-0">
        <form id="AddGamesForCart" method="POST" enctype="multipart/form-data">
            <div class="card-header pt-4  ">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item  "><a class="text-white" href="index.php?page=homepage">Accueil</a></li>
                        <li class="breadcrumb-item"><a class="text-white" href="index.php?page=category&id=<?= $Game['category_id'] ?>"><?= $Game['category_name'] ?></a></li>
                        <li class="breadcrumb-item"><a class=" text-white" href="index.php?page=sub_category&id_sub_category=<?= $Game['sub_category_id'] ?>&id_category=<?= $Game['category_id'] ?>"><?= $Game['sub_category_name'] ?></a></li>
                        <li class="breadcrumb-item active text-white" aria-current="page"><?= $Game['name'] ?></li>
                    </ol>
                </nav>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-4">
                        <img src="../../Back_end/uploads/<?= $Game['path'] ?>" alt="jacket de <?= $Game['name'] ?>" class="img-thumbnail img-fluid">
                    </div>
                    <div class="col-md-8">
                        <div class="sticky-info">
                            <h1><?= $Game['name'] ?></h1>
                            <hr>
                            <p>Plateforme : <?= $Game['platform_name'] ?></p>
                            <p>Genre : <?= $Game['genre'] ?> / <?= $Game['sub_category_name'] ?> </p>
                            <p>Éditeur : <?= $Game['editor'] ?></p>
                            <p>Prix : <?= $Game['price'] ?> €</p>
                            <hr>
                            <div class="text-center">
                                    <div class="py-2"><?= $msg ?></div>

                                <button type="submit" class="btn btn-success p-3 rounded-5 <?=$disabled?> shadow btn-custom" name="submit">Ajouter aux panier</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container pt-5">
                    <div class="col-md-12">
                        <h2>Description du Jeu</h2>
                        <hr>
                        <p><?= $Game['description'] ?></p>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>





    </script>


<?php
$content = ob_get_clean();
require('layout.php');
?>
