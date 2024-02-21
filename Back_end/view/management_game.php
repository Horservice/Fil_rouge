<title><?= $title = "Gestion des Jeux Vidéo"; ?></title>
<?php ob_start(); ?>

<div class="container">
    <h1>Gestion des jeux vidéo</h1>
    <p class="text-end">
        <a class="btn btn-primary text-end" href="index.php?page=add_game" role="button">Ajouter un jeux vidéo</a>
    </p>

    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Image</th>
                    <th>Nom</th>
                    <th>Plateforme</th>
                    <th>Prix</th>
                    <th>Description</th>
                    <th>Genre</th>
                    <th>Éditeur</th>
                    <th>Alt</th>
                    <th>État d'activation</th>
                    <th>Catégorie</th>
                    <th>Sous-catégorie</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($games as $game) { ?>
                    <tr>
                        <td><?= $game['game_id'] ?></td>
                        <td class="w-25"><img class="img-fluid" src="../uploads/<?= $game['path'] ?>"></td>
                        <td><?= $game['name'] ?></td>
                        <td><?= $game['platform_name'] ?></td>
                        <td><?= $game['price'] ?></td>

                        <td><span class="d-inline-block text-truncate" style="max-width: 150px;">
                        <?= $game['description'] ?></span></td>

                        <td><?= $game['genre'] ?></td>
                        <td><?= $game['editor'] ?></td>
                        <td><?= $game['alt'] ?></td>
                        <td>
                            <?php
                            $status = ($game['is_enabled'] == 1) ? 'activé' : 'désactivé';
                            echo $status;
                            ?>
                        </td>
                        <td><?= $game['category_name'] ?></td>
                        <td><?= $game['sub_category_name'] ?></td>
                        <td class="text-center">
                            <a class="btn btn-warning" href="index.php?page=edit_game&id=<?= urlencode($game['game_id']) ?>" role="button">Modifier</a>
                            <a class="btn btn-danger" href="index.php?page=del_game&id=<?= urlencode($game['game_id']) ?>" role="button">Supprimer</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<?php $content = ob_get_clean(); ?>
<?php require('layout.php') ?>


