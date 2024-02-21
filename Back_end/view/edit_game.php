<?php $title = "modifer d'un jeu vidéo"; ?>
<?php ob_start(); ?>

<div class="container">
    <h1 class="h3 mb-3 fw-normal">modifier un jeu vidéo</h1>

    <h4><?= $msg ?></h4>

    <form action="" method="POST" class="row my-5" enctype="multipart/form-data">
        <div class="mb-3 col-md-6">
            <label for="name" class="form-label">Nom du jeu</label>
            <input type="text" class="form-control" id="name" name="name" value="<?=$games['name']?>">
        </div>

        <div class="mb-3 col-md-6">
            <label for="genre" class="form-label">Genre</label>
            <input type="text" class="form-control" id="genre" name="genre" value="<?=$games['genre']?>">
        </div>

        <div class="mb-3 col-12">
            <label for="description" class="form-label">Description</label>
<textarea class="form-control" id="description" name="description"><?=$games['description']?></textarea>
        </div>

        <div class="mb-3 col-md-6">
            <label for="price" class="form-label">Prix :</label>
            <input type="number" class="form-control" id="price" name="price" step="0.01" value="<?=$games['price']?>">
        </div>

        <div class="mb-3 col-md-6">
            <label for="editor" class="form-label">Éditeur</label>
            <input type="text" class="form-control" id="editor" name="editor" value="<?=$games['editor']?>">
        </div>



        <div class="mb-3 col-md-6">
            <label for="path" class="form-label">Photo</label>
            <input type="file" class="form-control" id="path" name="path" >
        </div>


        <div class="mb-3 col-md-6">
            <label for="alt" class="form-label">Alt</label>
            <input type="text" class="form-control" id="alt" name="alt" value="<?=$games['alt']?>">
        </div>

        <div class="mb-3 col-md-6">
            <label for="category_id" class="form-label">Catégorie</label>
            <select class="form-select" id="category_id" name="category_id" value="<?=$games['category_id']?>">
                <?php
                foreach ($categories as $categorie) {
                ?>
                    <option value="<?= $categorie['category_id'] ?>"><?= $categorie['name'] ?></option>
                <?php
                }
                ?>
            </select>
        </div>

        <div class="mb-3 col-md-6">
            <label for="sub_category_id" class="form-label">Sous Catégorie</label>
            <select class="form-select" id="sub_category_id" name="sub_category_id" value="<?=$games['sub_category_id']?>">
                <?php
                foreach ($subcategories as $subcategorie) {
                ?>
                    <option value="<?= $subcategorie['sub_category_id'] ?>"><?= $subcategorie['name'] ?></option>
                <?php
                }
                ?>
            </select>
        </div>

        <div class="mb-3 col-md-6">
            <label for="platform_id" class="form-label">Plateforme</label>
            <select class="form-select" id="platform_id" name="platform_id" value="<?=$games['platform_id']?>">
                <?php
                foreach ($plateforms as $platform) {
                    ?>
                    <option value="<?= $platform['platform_id'] ?>"><?= $platform['name'] ?></option>
                <?php
                }
                ?>
            </select>
        </div>

        <div class="mb-3 col-12">
    <label>Activer / Désactiver :</label>
    <?php
    if (isset($games['is_enabled'])) {
    ?>
    <div class="form-check">
        <input type="checkbox" class="form-check-input" id="is_enabled_1" name="is_enabled" value="1" <?= $games['is_enabled'] == 1 ? 'checked' : '' ?>>
        <label class="form-check-label" for="is_enabled_1">Activer</label>
    </div>
    <div class="form-check">
        <input type="checkbox" class="form-check-input" id="is_enabled_0" name="is_enabled" value="0" <?= $games['is_enabled'] == 0 ? 'checked' : '' ?>>
        <label class="form-check-label" for="is_enabled_0">Désactiver</label>
    </div>
    <?php
    }
    ?>
</div>

        <div class="mb-3 col-12">
            <a class="btn btn-warning" href="index.php?page=management_game" role="button">Retour</a>
            <button type="submit" class="btn btn-primary" name="submit">Valider</button>
        </div>
    </form>
</div>

<?php $content = ob_get_clean(); ?>
<?php require('layout.php') ?>