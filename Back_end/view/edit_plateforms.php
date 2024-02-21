<?php $title = "Modifier une Plateforme"; ?>
<?php ob_start(); ?>

<div class="container">       
<h1 class="h3 mb-3 fw-normal">Modifier une plateforme</h1>

<h4><?= isset($msg) ? $msg : '' ?></h4>

<form action="" method="POST" class="row my-5">
    <div class="mb-3">
        <label for="name" class="form-label">Nom de la plateforme</label>
        <input type="text" class="form-control" name="name" value="<?=$plateforms['name']?>">
    </div>

    <div class="mb-3 col-3">
        <a class="btn btn-warning" href="index.php?page=management_plateforms" role="button">Retour</a>
        <button type="submit" class="btn btn-primary" name="submit">Valider</button>
    </div>
</form>
</div>

<?php $content = ob_get_clean(); ?> 
<?php require('layout.php'); ?>