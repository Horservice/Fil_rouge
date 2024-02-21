<title><?= $title = "Gestion des Plateformes"; ?></title>
<?php ob_start(); ?>



<div class="container">
        <h1>Gestion des Plateformes</h1>
        <p class="text-end">
            <a class="btn btn-primary text-end" href="index.php?page=add_plateform" role="button">Ajouter une plateforme</a>
        </p>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($plateforms as $plateform) : ?>
                    <tr>
                        <td><?= $plateform['platform_id'] ?></td>
                        <td><?= $plateform['name'] ?></td>
                        <td class="text-center">
                            <a class="btn btn-warning" href="index.php?page=edit_plateform&id=<?= urlencode($plateform['platform_id']) ?>" role="button">Modifier</a>
                            <a class="btn btn-danger" href="index.php?page=del_plateform&id=<?= urlencode($plateform['platform_id']) ?>" role="button">Supprimer</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

<?php $content = ob_get_clean(); ?>
<?php require('layout.php') ?>


