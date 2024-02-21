<?php 
//fini
$titles = "Futur Game -  Commande Numéro #$id"; 
 ob_start(); 
?>

<style>

    .bg-custom {
        background-color: rgb(152, 56, 56);
    
    }
</style>



    <div class="container">

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php?page=account">Compte</a></li>
                <li class="breadcrumb-item active" aria-current="page">Commande</li>
            </ol>
        </nav>  
        <p class="text-end">
            <a class="btn btn-info text-end" href="index.php?page=account" role="button">Retourner en arrière</a>
        </p>

    </div>




<div class="container">
    <div class="col-md-12">
        <div class="card  shadow border-0">
            <div class="card-header bg-custom text-white">
            <?php foreach ($orders as $order) { ?>

                <h3 class="card-title text-white">Ma commandes #<?=$id ?>, Date : <?=$order['order_date']?></h3>
            </div>
            <div class="card-body table-responsive">
                <table class="table" id="orders">
                    <thead>
                        <tr>
                            <!-- <th>Game ID</th> -->
                            <th>Image</th>
                            <th>Nom</th>
                            <th>Genre</th>
                            <th>Plateforme</th>
                            <th>Quantitié</th>
                            <th>Prix</th>

                        </tr>
                    </thead>
                    <tbody>
                            <tr>
                                <!-- <td><?=$order['game_id']?></td> -->
                                <td><img src="../../Back_end/uploads/<?=$order['path']?>" alt="Jackette du jeux <?=$order['game_name']?>" class="img-thumbnail" style="max-width: 200px; max-height: 200px;"></td>
                                <td><?=$order['game_name']?></td>
                                <td><?=$order['genre']?></td>
                                <td><?=$order['platform_name']?></td>
                                <td><?=$order['quantity']?></td>
                                <td><?=$order['price']?> €</td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>    
                <hr>
                <p class="text-center">Prix total : <?= $order['price_total']?> €</p>
            </div>
        </div>
    </div>
</div>



<?php $content = ob_get_clean();
require('layout.php') ?>