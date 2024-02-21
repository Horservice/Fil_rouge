<?php $title = "edit une catégories"; ?>
<?php ob_start(); ?>

<div class="container">       
<h1 class="h3 mb-3 fw-normal">edit une sous catégories </h1>


<h4><?=$msg?></h4>

        <form action="" method="POST" class="row my-5" enctype="multipart/form-data">

            <div class="mb-3">
                <label for="name" class="form-label">Nom de la sous catégorie</label>
                <input type="text" class="form-control" name="name" value="<?=$subcategories['name'] ?>">
            </div>
            <div class="mb-3">

            
            <div class="mb-3">
            <label for="category_id" class="form-label">Catégorie</label>
                <select class="form-select"  aria-label="Default select example" name="category_id">
                    <?php
                    foreach ($categories as $categorie) {
                    ?>
                        <option value="<?= $categorie['category_id']?>"><?= $categorie['name'] ?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>

            <div class="mb-3 col-3">
                <a class="btn btn-warning" href="index.php?page=management_sub_categories" role="button">Retour</a>
                <button type="submit" class="btn btn-primary" name="submit">Valider</button>
            </div>

        </form>

    </div>

<?php $content = ob_get_clean(); ?> 
<?php require('layout.php') ?>

