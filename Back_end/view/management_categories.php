<title><?= $title = "Gestion Catégories"; ?></title>
<?php ob_start(); ?>

<div class="container">
    <h1>Gestion des Catégories</h1>
    <p class="text-end">
        <a class="btn btn-primary text-end" href="index.php?page=add_categories" role="button">Ajouter une catégorie</a>
    </p>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Image</th>
                <th>Nom</th>
                <th>Alt</th>
                <th class="text-center">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($categories as $categorie) { ?>
                <tr>
                    <td><?= $categorie['category_id'] ?></td>
                    <td class="w-25"><img class="w-25" src="../uploads/<?= $categorie['path'] ?>"> </td>
                    <td><?= $categorie['name'] ?></td>
                    <td><?= $categorie['alt'] ?></td>
                    <td class="text-center">
                        <a class="btn btn-warning" href="index.php?page=edit_categories&id=<?= urlencode($categorie['category_id']) ?>" role="button">Modifier</a>
                        <a class="btn btn-danger" href="index.php?page=del_categories&id=<?= urlencode($categorie['category_id']) ?>" role="button">Supprimer</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<?php $content = ob_get_clean(); ?>
<?php require('layout.php') ?>