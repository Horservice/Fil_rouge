<?php $title = "supprimer une jeux video"; ?>
<?php ob_start(); ?>

<div class="container a1 text-center py-5 my-5">
<h1>Supprimer une jeux video </h1>

<h4><?=$msg?></h4>

        <form action="" method="POST" class="row my-5" enctype="multipart/form-data">

            <div class="container bg-primary-subtle rounded-5 text-center py-5">
                <p class="py-2 bg-warning-subtle rounded-5 my-3 py-3">Voules vous vraiment supprimer : <?=$games['name']?> ?</p>
            </div>

            
            <div class="container pt-5">
                <a type="button" class="btn btn-light" href="index.php?page=management_game">Retour</a>
                <button type="submit" class="btn btn-danger" name="submit">Confirmer</button>
            </div>

        </form>
</div>




<?php $content = ob_get_clean(); ?> 
<?php require('layout.php') ?>
