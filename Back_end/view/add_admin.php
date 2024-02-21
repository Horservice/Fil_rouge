<?php $title = "Ajouter un admin"; ?>
<?php ob_start(); ?>
<div class="container">       
<h1 class="h3 mb-3 fw-normal">Ajouter un admin </h1>


<h4><?=$msg?></h4>

        <form action="" method="POST" class="row my-5" enctype="multipart/form-data">

            <div class="mb-3">
                <label for="email">Email</label>
                <input type="email" class="form-control" placeholder="Votre email" name="email">
            </div>

            <div class="mb-3">
                <label for="firstname">Nom d'utilisateur</label>
                <input type="text" class="form-control" placeholder="Votre nom utilisateur" name="username" >
            </div>


            <div class="mb-3">
                <label for="firstname">Prénom</label>
                <input type="text" class="form-control" placeholder="Votre prénom" name="firstname" >
            </div>


            <div class="mb-3">
                <label for="lastname">Famille</label>
                <input type="text" class="form-control" placeholder="Votre nom de famille" name="lastname">
            </div>

            <div class="mb-3">
                <label for="path" class="form-label">Avatar</label>
                <input type="file" class="form-control"  name="avatar">
            </div>


            <div class="mb-3">
                <label for="password">Mot de passe</label>
                <input type="password" class="form-control" placeholder="Mot de passe" name="password" >
            </div>


            <div class="mb-3 col-3">
                <a class="btn btn-warning" href="index.php?page=management_admin" role="button">Retour</a>
                <button type="submit" class="btn btn-primary" name="submit">Valider</button>
            </div>

        </form>

</div>






<?php $content = ob_get_clean(); ?> 
<?php require('layout.php') ?>

