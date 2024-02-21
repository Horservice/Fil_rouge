<?php 
    $titles = "Futur Game - Création du compte";
    ob_start(); 
?>

<style>
    .card-header {
        background-color: rgb(152, 56, 56);
        color: white;
    }
</style>

<div class="container py-5">
    <div class="card">
        <div class="card-header">
            <h2>Création de compte</h2>
        </div>
        <div class="card-body shadow">
            <form method="POST" action="" enctype="multipart/form-data">
                <h4 class="text-center"><?=$msg?></h4>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="username" class="form-label">Nom d'utilisateur</label>
                        <input type="text" class="form-control" name="username" placeholder="Entrez votre nom d'utilisateur" require>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="firstname" class="form-label">Prénom</label>
                        <input type="text" class="form-control" name="firstname" placeholder="Entrez votre prénom" require>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="lastname" class="form-label">Nom de famille</label>
                        <input type="text" class="form-control" name="lastname" placeholder="Entrez votre nom de famille" require>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="email" class="form-label">Adresse e-mail</label>
                        <input type="email" class="form-control" name="email" placeholder="Entrez votre adresse e-mail" require>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="motdepasse" class="form-label">Mot de passe</label>
                        <div class="input-group">
                            <input type="password" class="form-control" name="password" id="password" placeholder="Entrez votre mot de passe" require>
                            <button type="button" class="btn btn-secondary" onclick="togglePasswordVisibility()" id="togglePassword">Afficher</button>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="confirmationmdp" class="form-label">Confirmation du mot de passe</label>
                        <div class="input-group">
                            <input type="password" class="form-control" name="password_confirm" id="password_confirm" placeholder="Confirmez votre mot de passe" require>
                            <button type="button" class="btn btn-secondary" onclick="togglePasswordConfirmVisibility()" id="togglePasswordConfirm">Afficher</button>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="billing_address" class="form-label">Adresse de facturation</label>
                        <input class="form-control" name="billing_address" rows="3" placeholder="Entrez votre adresse de facturation"></input>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="delivery_address" class="form-label">Adresse de livraison</label>
                        <input class="form-control" name="delivery_address" rows="3" placeholder="Entrez votre adresse de livraison"></input>
                    </div>
                </div>
                <div class="py-2">
                    <div class="g-recaptcha" data-sitekey="6LdboyEpAAAAAJF-Lt_B9Yhr5XnnmGxxEMGvAYIE"></div>
                </div>
                <a href="index.php?page=login" class="btn btn-secondary">Retour</a>
                <button type="submit" class="btn btn-primary" name="submit">Créer un compte</button>
            </form>
        </div>
    </div>
</div>

<script>
    function togglePasswordVisibility() {
        var passwordInput = document.getElementById("password");
        var passwordButton = document.getElementById("togglePassword");

        if (passwordInput.type === "password") {
            passwordInput.type = "text";
            passwordButton.textContent = "Cacher";
        } else {
            passwordInput.type = "password";
            passwordButton.textContent = "Afficher";
        }
    }

    function togglePasswordConfirmVisibility() {
        var passwordConfirmInput = document.getElementById("password_confirm");
        var passwordConfirmButton = document.getElementById("togglePasswordConfirm");

        if (passwordConfirmInput.type === "password") {
            passwordConfirmInput.type = "text";
            passwordConfirmButton.textContent = "Cacher";
        } else {
            passwordConfirmInput.type = "password";
            passwordConfirmButton.textContent = "Afficher";
        }
    }
</script>

<?php 
    $content = ob_get_clean(); 
    require('layout.php');
?>
