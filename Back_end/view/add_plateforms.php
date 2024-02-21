<?php $title = "Ajouter une Plateforms"; ?>
<?php ob_start(); ?>

<div class="container">       
<h1 class="h3 mb-3 fw-normal">Ajouter une plateforms</h1>

<h4><?=$msg?></h4>

        <form action="" method="POST" class="row my-5" enctype="multipart/form-data">

            <div class="mb-3">
                <label for="name" class="form-label">Nom de la plateforme</label>
                <input type="text" class="form-control"  name="name">
            </div>

            <div class="mb-3 col-3">
                <a class="btn btn-warning" href="index.php?page=management_plateforms" role="button">Retour</a>
                <button type="submit" class="btn btn-primary" name="submit">Valider</button>
            </div>

        </form>
    </div>

<?php $content = ob_get_clean(); ?> 
<?php require('layout.php') ?>

