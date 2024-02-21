<?php $title = "Erreur !"; ?>
<?php ob_start(); ?>

<main>


    <div class="container-fluid text-center">
        <h1>Une erreur et survenue !</h1>
        <p class="fs-6"><?=$e?></p>
        <a type="button" class="btn btn-secondary" href="index.php?page=dashboard">Retour a la page menue principal</a>
    </div>



</main>
<?php $content = ob_get_clean(); ?>
<?php require('layout.php') ?>
</html>