<?php $title = "edit une catégories"; ?>
<?php ob_start(); ?>

<div class="container">       
<h1 class="h3 mb-3 fw-normal">edit une catégories </h1>


<h4><?=$msg?></h4>

        <form action="" method="POST" class="row my-5" enctype="multipart/form-data">

            <div class="mb-3">
                <label for="name" class="form-label">Nom de la catégorie</label>
                <input type="text" class="form-control" name="name" value="<?=$categories['name'] ?>">
            </div>
            <div class="mb-3">

            <label for="path" class="form-label">photo actuelle</label>
            <img class=" ms-5 w-25" src="../uploads/<?=$categories['path']?>">
            </div>


            <div class="mb-3">
                <label for="path" class="form-label">Photo</label>
                <input type="file" class="form-control"  name="path" value="<?=$categories['path'] ?>">
            </div>


            <div class="mb-3">
                <label for="name" class="form-label">alt de la photo</label>
                <input type="text" class="form-control"  name="alt" value="<?=$categories['alt'] ?>" >
            </div>

            

            <div class="mb-3 col-3">
                <a class="btn btn-warning" href="index.php?page=management_categories" role="button">Retour</a>
                <button type="submit" class="btn btn-primary" name="submit">Valider</button>
            </div>

        </form>

    </div>

<?php $content = ob_get_clean(); ?> 
<?php require('layout.php') ?>

