<?php $titles = "Futur Game - Erreur !"; ?>
<?php ob_start(); ?>



    <div class="container-fluid text-center py-5 ">
        <h1>Une erreur et survenue !</h1>
        <p class="fs-6"><?=$e?></p>
        <a type="button" class="btn btn-secondary" href="index.php?page=homepage">Retour a la page menue principal</a>
    </div>



<?php $content = ob_get_clean(); ?>
<?php require('layout.php') ?>
</html>