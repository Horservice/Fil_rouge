<title><?= $title = "Gestion des Sous-Catégories"; ?></title>
<?php ob_start(); ?>



<div class="container">
        <h1>Gestion des sous-catégories</h1>
        <p class="text-end">
            <a class="btn btn-primary text-end" href="index.php?page=add_sub_categories" role="button">Ajouter une sous-catégorie</a>
        </p>
        
        <table class="table">
            <thead>
                <tr>
                    <th>Catégorie</th>
                    <th>Catégorie ID</th>
                    <th>Sous-catégorie ID</th>
                    <th>Nom</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($subCategories as $subCategorie) : ?>
                    <tr>
                        <td><?= $subCategorie['category_name'] ?></td>
                        <td><?= $subCategorie['category_id'] ?></td>
                        <td><?= $subCategorie['sub_category_id'] ?></td>
                        <td><?= $subCategorie['name'] ?></td>
                        <td class="text-center">
                            <a class="btn btn-warning" href="index.php?page=edit_sub_categories&id=<?= urlencode($subCategorie['sub_category_id']) ?>" role="button">Modifier</a>
                            <a class="btn btn-danger" href="index.php?page=del_sub_categories&id=<?= urlencode($subCategorie['sub_category_id']) ?>" role="button">Supprimer</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    
<?php $content = ob_get_clean(); ?>
<?php require('layout.php') ?>









