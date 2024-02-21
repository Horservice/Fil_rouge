<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>HS - Login </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
  </head>
  <style>
    .clogin {
        margin-top: 100px;
        max-width: 600px;
        padding: 25px;
        border: 1px solid #ddd;
        box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.1);
        background-color: #fff;
        border-radius: 25px;
        
    }

    .clogin form {
        margin-top: 15px;
    }

    .clogin label {
        font-weight: bold;
    }

    .clogin .mb-3 {
        margin-bottom: 15px;
    }

    .clogin a {
        color: #007bff;
        text-decoration: none;
    }

body::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-image: linear-gradient(to bottom right, rgba(0, 225, 255, 0.486), rgba(0, 255, 200, 0.478));
    
    transform: skewY(-12deg); 
    transform-origin: top left; 
    z-index: -1; 
}




</style>
</head>
<body>

    <div class="container clogin">
        <form class="contenair-fluid rounded-5" action="" method="POST">
            <div class="mb-3">
                <label for="username" class="form-label">Nom utilisateur</label>
                <input type="text" class="form-control" placeholder="Entrez votre nom utilisateur" name="username" required>
            </div>
            <div class="mb-3">
                <label for="Password" class="form-label">Mot de passe</label>
                <input type="password" class="form-control" placeholder="Entrez votre mot de passe" name="password" required >
            </div>
            <div class="mb-3">
                <a href="password_forgot.php">Mot de passe oublié</a>
                <h5 class="w-100 text-center"><?= $msg ?></h5>
            </div>
            <div class="d-flex justify-content-center align-items-center">
                <button type="submit" class="btn btn-primary boutton " name="submit">Se connecter</button>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
  </body>
</html>