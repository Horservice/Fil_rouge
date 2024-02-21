<?php $titles = "modificiation du compte"; ?>
<?php ob_start(); ?>

<style>
    .bg-custom {
      background-color: rgb(152, 56, 56);
    }
  </style>
<div class="container py-1">
    <div class="card shadow border-0">
        <div class="card-header bg-custom text-white">
            <h2>Modificiation du compte</h2>
        </div>
        <div class="card-body">
            <!-- Formulaire de création de compte -->
            <form method="POST" action="" enctype="multipart/form-data">
            <p><?=$msg?></p>

                <div class="row">
                    <div class="col-md-6 mb-3">     
                        <label for="username" class="form-label">Nom d'utilisateur</label>
                        <input type="text" class="form-control" name="username" value="<?= $accounts['username']; ?>" placeholder="Entrez votre nom d'utilisateur">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="firstname" class="form-label">Prénom</label>
                        <input type="text" class="form-control" name="firstname" value="<?= $accounts['firstname']; ?>" placeholder="Entrez votre prénom">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                            <label for="lastname" class="form-label">Nom de famille</label>
                        <input type text="text" class="form-control" name="lastname" value="<?= $accounts['lastname']; ?>" placeholder="Entrez votre nom de famille">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="email" class="form-label">Adresse e-mail</label>
                        <input type="email" class="form-control" name="email" value="<?= $accounts['email']; ?>" placeholder="Entrez votre adresse e-mail">
                    </div>
                </div>
                <div class="row">
                <div class="col-md-6 mb-3">
                        <label for="motdepasse" class="form-label">Mot de passe</label>
                        <div class="input-group">
                        <input type="password" class="form-control" name="password" id="password" placeholder="Entrez votre mot de passe">
                        <button type="button" class="btn btn-secondary" onclick="togglePasswordVisibility()" id="togglePassword">Afficher</button>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="confirmationmdp" class="form-label">Confirmation du mot de passe</label>
                        <div class="input-group">
                            <input type="password" class="form-control" name="password_confirm" id="password_confirm" placeholder="Confirmez votre mot de passe">
                            <button type="button" class="btn btn-secondary" onclick="togglePasswordConfirmVisibility()" id="togglePasswordConfirm">Afficher</button>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="billing_address" class="form-label">Adresse de facturation</label>
                    <input class="form-control" name="billing_address"  value="<?= $accounts['billing_address']; ?>" rows="3" placeholder="Entrez votre adresse de facturation"></input>
                </div>
                <div class="mb-3">
                    <label for="delivery_address" class="form-label">Adresse de livraison</label>
                    <input class="form-control" name="delivery_address"  value="<?= $accounts['delivery_address']; ?>" rows="3" placeholder="Entrez votre adresse de livraison"></input>
                </div>
                <a href="index.php?page=account" class="btn btn-secondary">Retour</a>
                <button type="submit" class="btn btn-success" name="submit">Modification</button>

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

<?php $content = ob_get_clean(); ?> 
<?php require('layout.php') ?>

