<?php
// controllers/homepage.php
require_once('../model/users.php');

function login(){

    if (isset($_SESSION['username'])) {
        header("Location: index.php?page=homepage");
        exit();
    }

    $msg = "";

    if (isset($_POST['login'])) {

        $recaptchaSecretKey = "6LdboyEpAAAAAG5yrmIt7Pf0CSP_niR96FG9dV8q";
        $recaptchaResponse = $_POST['g-recaptcha-response'];
        $recaptchaUrl = "https://www.google.com/recaptcha/api/siteverify?secret=$recaptchaSecretKey&response=$recaptchaResponse";
        $recaptchaResult = json_decode(file_get_contents($recaptchaUrl));

        if (!$recaptchaResult->success) {
            $msg = "Veuillez prouver que vous n'êtes pas un robot.";
        } else {

            if (
                !isset($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) ||
                !isset($_POST['password']) || empty($_POST['password'])
            ) {
                $msg = "Merci de remplir les champs !";
            } else {
                $email = htmlspecialchars($_POST['email']);
                $password = htmlspecialchars($_POST['password']);
                $req = checkLogin($email);

                if ($req->rowCount() > 0) {
                    $data = $req->fetch();

                    if (password_verify($password, $data["password"])) {
                        $_SESSION['lastname'] = $data['lastname'];
                        $_SESSION['firstname'] = $data['firstname'];
                        $_SESSION['avatar'] = $data['avatar'];
                        $_SESSION['username'] = $data['username'];
                        $_SESSION['user_id'] = $data['user_id'];

                        $_SESSION['message'] = '
                            <div id="myAlert" class="container shadow text-center bg-success mb-5 w-50 mx-auto text-white rounded ">
                                <p class="py-2">
                                    Vous êtes maintenant connecté utilisateur '. $_SESSION['username'] . ' sur Futur Game !
                                    <button type="button"  class="btn-close mx-auto close rounded-pill p-2"></button>
                                    <p/>                          
                            </div>';

                        header("Location: index.php?page=homepage");
                        exit();

                    } else {
                        $msg = "<p class='text-danger fs-2'>Le nom utilisateur ou le mot de passe incorrect</p>";
                    }
                } else {
                    $msg = '<p class="text-danger fs-2 "> Le nom utilisateur ou le mot de passe incorrect </p>';
                }
            }
        }
    }

    require_once('../view/login.php');
}