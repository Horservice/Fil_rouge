<?php $titles = "Futur Game - Connexion"; ?>
<?php ob_start(); ?>

<style>
    .shad {
        box-shadow: 25px 18px 15px -3px rgba(0,0,0,0.1);
    }

    .card-header {
        background-color: rgb(152, 56, 56);
        color: white;
    }

    .card-body {
        padding: 15%;
    }
</style>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header">Connexion</div>
                <div class="card-body">
                    <form action="" method="POST">  
                        <div class="mb-auto">
                            <?= $msg ?> 
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Adresse e-mail</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Mot de passe</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>                        
                        
                        <div class="d-flex justify-content-center py-2">

                            <div class="g-recaptcha" data-sitekey="6LdboyEpAAAAAJF-Lt_B9Yhr5XnnmGxxEMGvAYIE"></div>

                        </div>

                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary" name="login">Se connecter</button>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-center mt-3">
                            <a class="btn btn-success btn-block mb-3" href="index.php?page=create_account">Créer un compte</a>
                        </div>
                        <div class="text-center">
                            <a href="index.php?page=password_forgot" class="link-underline link-underline-opacity-0">Mot de passe oublié ?</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>



<?php $content = ob_get_clean(); ?> 
<?php require('layout.php') ?>