<?php
// Connexion à la base de données (à adapter)
require_once('../model/db_connect.php');

// Connexion à la base de données (à adapter)
$conn = dbconnect();

$msg="";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['reset_password'])) {
    $token = $_POST['token'];
    $newPassword = $_POST['new_password'];

    // Recherche du jeton dans la base de données
    $query = "SELECT * FROM admin WHERE reset_token = :token AND token_expiration > NOW()";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':token', $token);
    $stmt->execute();

    // Utilisez rowCount() pour obtenir le nombre de lignes retournées
    $rowCount = $stmt->rowCount();

    if ($rowCount == 1) {
        // Mettre à jour le mot de passe et supprimer le jeton
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        $query = "UPDATE admin SET password = :hashedPassword, reset_token = NULL, token_expiration = NULL WHERE reset_token = :token";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':hashedPassword', $hashedPassword);
        $stmt->bindParam(':token', $token);
        $stmt->execute();

        $msg="Votre mot de passe a été réinitialisé avec succès.";
    } else {
        $msg="Le lien de réinitialisation est invalide ou a expiré.";
    }
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HS - Réinitialisation de mot de passe</title>
    <!-- Ajoutez les liens vers les fichiers CSS de Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<style>
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
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h2 class="text-center">Réinitialisation de mot de passe</h2>
                    </div>
                    <div class="card-body">
                        <form action="" method="post">
                            <input type="hidden" name="token" value="<?php echo $_GET['token']; ?>">    
                            <div class="form-group">
                                <label for="new_password">Nouveau mot de passe :</label>
                                <input type="password" class="form-control" name="new_password" required>
                            </div>
                            <div class="container">
                                <p class="text-center py-2"> <?=$msg?> </p>
                            </div>
                            <button type="submit" class="d-flex align-items-center btn btn-primary" name="reset_password">Réinitialiser le mot de passe</button>
                        </form>
                    </div>
                </div>
                <div class="mt-3">
                    <a class="btn btn-secondary" href="login.php">Retour à la page de connexion</a>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Ajoutez les liens vers les fichiers JavaScript de Bootstrap (jQuery et Popper.js) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>