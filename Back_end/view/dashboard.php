<title><?= $title="Futur game - Menue principal"; ?></title>
<?php ob_start(); ?>

<body>

<div class="container py-5">
    <h1 class="text-center"> Bienvenue <?= $lastname ?> <?= $firstname ?>
        <img src="../uploads/<?= $avatar ?>" class="avatar img-fluid rounded-circle shadow" alt="Avatar" width="150" height="150">
    </h1>
</div>

</body>
<?php $content = ob_get_clean(); ?>
<?php require('layout.php') ?>
</html>
