<?php
//
require_once('../model/db_connect.php');

// Connexion à la base de données (à adapter)
$conn = dbConnect();



$msg="";
// Génération d'un jeton unique
function generateToken() {
    return bin2hex(random_bytes(32));
}

if (isset($_POST['forgot_password'])) {
    $email = $_POST['email'];

    // Vérifier si l'email existe dans la base de données
    $query = "SELECT * FROM admin WHERE email = :email";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    $num_rows = $stmt->rowCount(); // Utilisez rowCount() pour obtenir le nombre de lignes affectées

    if ($num_rows == 1) {
        // Générer un jeton et le stocker dans la base de données
        $token = generateToken();
        $query = "UPDATE admin SET reset_token = :token, token_expiration = DATE_ADD(NOW(), INTERVAL 1 HOUR) WHERE email = :email";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':token', $token);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        // Envoyer l'email de réinitialisation
        sendResetEmail($email, $token);

         $msg = "Un email de réinitialisation a été envoyé à votre adresse email.";
    } else {
        $msg = "Aucun email trouvé.";
    }
}


// Envoi d'un email de réinitialisation
function sendResetEmail($email, $token) {
    $head = "MIME-Version: 1.0" . "\r\n";
    $head .= 'From: helleringer.simon@hotmail.com' . "\r\n"; 
    $head .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $to = $email;
    
    $subject = "Réinitialisation de votre mot de passe - Fil-rouge";    
    $message = "Bonjour,\n\n";
    $message .= "Vous avez demandé la réinitialisation de votre mot de passe. Cliquez sur le lien ci-dessous pour procéder :\n";
    $message .= "<br>";
    $message .= "<br>";
    $message .= "http://fil-rouge/admin/public/reset_password.php?token=$token\n\n";
    $message .= "<br>";
    $message .= "<br>";
    $message .= "Ce lien expirera dans 1 heure.\n\n";
    $message .= "Si vous n'avez pas demandé cette réinitialisation, ignorez simplement cet email.\n\n";
    $message .= "Cordialement,\n Votre équipe.";

    mail($email, $subject, $message, $head);
}



?>

<!DOCTYPE html>
<html>
<head>
    <title>HS - Mot de passe oublié</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<style>
body::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-image: linear-gradient(to bottom right, rgb(152, 56, 56), rgb(152, 56, 56));
    
    transform: skewY(-12deg); 
    transform-origin: top left; 
    z-index: -1; 
}





</style>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center ">
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-header">
                        <h2 class="text-center">Réinitialisation de mot de passe</h2>
                    </div>
                    <div class="card-body ">
                        <form action="" method="POST">
                            <div class="form-group">
                                <label for="email">Adresse email :</label>
                                <input type="email" class="form-control" name="email" required>
                            </div>
                            <div class="form-group text-center">
                                <button type="submit" class="btn btn-primary" name="forgot_password">Envoyer le lien de réinitialisation</button>
                            </div>
                        </form>
                        <div class="contenair">
                            <p class="text-center"><?=$msg?></p> 
                        </div>
                        <div class="text-center">
                            <a href="index.php?page=login">Retour</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Ajoutez le lien vers le fichier JavaScript de Bootstrap (si nécessaire) -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>