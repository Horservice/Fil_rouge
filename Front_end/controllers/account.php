<?php
//controllers/account.php
require_once('../model/users.php');
require_once('../model/orders.php');


function account(){

    $DescriptionPage = "Information du compte de l'utilistater de Futur game";

    $id  = $_SESSION['user_id'];
    $accounts = GetUser($id);

    //teste
    // $orders = GetOrders($id);


    
    /// ajouter plus tard une pagination pour le orders


    // /faire limite a 10 puis faire les pagination etc 

    $currentPage = isset($_GET['pages']) ? (int)$_GET['pages'] : 1; // Get the current page from the URL

        var_dump("nous sommes a la page : " . $currentPage);

        $perPage = 1; // Number of items per page

        var_dump("nomnbre de commande par page  : " . $perPage);



        $totalorders = count(GetOrders($id)); // Total number of games for the category
        var_dump("nomnbre de commande total  : " . $totalorders);


        $paginationStart = max(0, ($currentPage - 1) * $perPage); // Ensure non-negative offset


        $orders = GetOrdersById($id, $perPage, $paginationStart);

        $totalPages = ceil($totalorders / $perPage);






    if(isset($_POST['delete_account'])){


        $accounts = GetUser($id);

        $oldPhotoPath = $accounts['avatar']; // Remplacez cela par le chemin réel de l'ancienne photo

        if (file_exists($oldPhotoPath)) {
            unlink($oldPhotoPath); // Supprime l'ancienne photo du dossier
            $success = DeleteUser($id);
            if ($success) {

                $_SESSION['message'] = '
                <div id="myAlert" class="container shadow text-center bg-danger w-50 mx-auto text-white rounded-3 ">
                    <p class="py-2">
                        Votre compte a été bien supprimer !
                        <button type="button"  class="btn-close mx-auto close rounded-pill p-2"></button>
                    </p>
                </div>';

                unset($_SESSION['lastname']);
                unset($_SESSION['firstname'] );
                unset($_SESSION['avatar']);
                unset($_SESSION['username']);
                unset($_SESSION['user_id']);
                // session_destroy();
                header("Location: index.php?page=homepage");

            } else {
                $msg = '<h2 class="text-danger">Une erreur est survenue !</h2>';
            }
        } else {

            $success = DeleteUser($id);
            if ($success) {

                $_SESSION['message'] = '
                <div id="myAlert" class="container shadow text-center bg-danger w-50 mx-auto text-white rounded-3 ">
                    <p class="py-2">
                        Votre compte a été bien supprimer !
                        <button type="button"  class="btn-close mx-auto close rounded-pill p-2"></button>
                    </p>
                </div>';

                unset($_SESSION['lastname']);
                unset($_SESSION['firstname'] );
                unset($_SESSION['avatar']);
                unset($_SESSION['username']);
                unset($_SESSION['user_id']);
                // session_destroy();
                header("Location: index.php?page=homepage");

            } else {
                $msg = '<h2 class="text-danger">Une erreur est survenue !</h2>';
            }
        }
    }

    require_once('../view/account.php');  
}


function create_account() {
  $msg = null;

  if (isset($_POST['submit'])) {


    $recaptchaSecretKey = "6LdboyEpAAAAAG5yrmIt7Pf0CSP_niR96FG9dV8q";
    $recaptchaResponse = $_POST['g-recaptcha-response'];
    $recaptchaUrl = "https://www.google.com/recaptcha/api/siteverify?secret=$recaptchaSecretKey&response=$recaptchaResponse";
    $recaptchaResult = json_decode(file_get_contents($recaptchaUrl));

    if (!$recaptchaResult->success) {
        $msg = "Veuillez prouver que vous n'êtes pas un robot.";
    } else {

    
      if (
          !isset($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) ||
          !isset($_POST['username']) || empty($_POST['username']) ||
          !isset($_POST['lastname']) || empty($_POST['lastname']) ||
          !isset($_POST['firstname']) || empty($_POST['firstname']) ||
          !isset($_POST['password']) || empty($_POST['password']) ||
          !isset($_POST['password_confirm']) || empty($_POST['password_confirm']) ||
          !isset($_POST['billing_address']) || empty($_POST['billing_address']) ||
          !isset($_POST['delivery_address']) || empty($_POST['delivery_address'])
      ) {
          $msg = '<h2 class="text-center text-white shadow py-2 rounded-5 bg-danger">Merci de bien vouloir remplir le formulaire !</h2>';
      } else {
          if ($_POST['password'] !== $_POST['password_confirm']) {
              $msg = '<h2 class="text-danger">Les mots de passe ne correspondent pas !</h2>';
          } else {

            if (strlen($_POST['password']) < 6) {
                $msg = '<h2 class="text-danger">Le mot de passe doit avoir au moins 6 caractères !</h2>';
            } else {
                $email = htmlspecialchars($_POST['email']);

                $existingUser = checkLogin($email);

                if ($existingUser->rowCount() > 0) {
                    $msg = '<h2 class="text-danger">Cette adresse e-mail est déjà utilisée.</h2>';
                } else {
                
            
                $success = AddUser();
                if ($success) {
  
                  $email = htmlspecialchars($_POST['email']);
                  $password = htmlspecialchars($_POST['password']);
                  $req = checkLogin($email); 
      
                  if ($req->rowCount() > 0) {
                      $data = $req->fetchAll();
      
                      if (password_verify($password, $data[0]["password"])) {
      
                          $_SESSION['lastname'] = $data[0]['lastname'];
                          $_SESSION['firstname'] = $data[0]['firstname'];
                          $_SESSION['avatar'] = $data[0]['avatar'];
                          $_SESSION['username'] = $data[0]['username'];
                          $_SESSION['user_id'] = $data[0]['user_id'];
      
  
                          $_SESSION['message'] =
                          
                          
                          '<div id="myAlert" class="container shadow text-center bg-success w-50 mx-auto text-white rounded mb-5 py-2">
                          <p> Inscription réussie  et Bienvenue '. $_SESSION['username']  .' sur Futur Game ! 
                          <button type="button"  class="btn-close mx-auto close rounded-pill p-2"></button>
                          </p>
                          </div>';
                          
                          
                          header("Location: index.php?page=homepage"); 
                      
      
                      } else {
                          $msg = "<p class='text-danger fs-2'>Le nom utilisateur ou le mot de passe incorrect</p>";
                      }
                    } else {
                        $msg = '<p class="text-danger fs-2 "> Le nom utilisateur ou le mot de passe incorrect </p>'; 
                    }
    
                    } else {
                        $msg = '<h2 class="text-danger">Une erreur est survenue !</h2>';
                    }

                }
            }
          }
      }

   }

//    require_once('../view/create_account.php');


    }
    require_once('../view/create_account.php');
}





function edit_account() {
    $id  = $_SESSION['user_id'];
    $accounts = GetUser($id);
    $msg = null;

    if (isset($_POST['submit'])) {
        if (
            !isset($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) ||
            !isset($_POST['username']) || empty($_POST['username']) ||
            !isset($_POST['lastname']) || empty($_POST['lastname']) ||
            !isset($_POST['firstname']) || empty($_POST['firstname']) ||
            !isset($_POST['password']) || empty($_POST['password']) ||
            !isset($_POST['password_confirm']) || empty($_POST['password_confirm']) ||
            !isset($_POST['billing_address']) || empty($_POST['billing_address']) ||
            !isset($_POST['delivery_address']) || empty($_POST['delivery_address'])
        ) {
            $msg = '<h2 class="text-danger">Merci de bien vouloir remplir le formulaire !</h2>';
        } else {
            if ($_POST['password'] !== $_POST['password_confirm']) {
                $msg = '<h2 class="text-danger">Les mots de passe ne correspondent pas !</h2>';
            } else {
                $success = UpdateUser($id);
                if ($success) {

                    $email = htmlspecialchars($_POST['email']);
                    $password = htmlspecialchars($_POST['password']);
                    $req = refreshAccount($email); 
        
                    if ($req->rowCount() > 0) {
                        $data = $req->fetchAll();
        
                        if (password_verify($password, $data[0]["password"])) {
        
                            $_SESSION['lastname'] = $data[0]['lastname'];
                            $_SESSION['firstname'] = $data[0]['firstname'];
                            $_SESSION['avatar'] = $data[0]['avatar'];
                            $_SESSION['username'] = $data[0]['username'];
        
    
                            $msg = '<h2 class="text-success">La modification de votre profil a réussi.</h2>';
                            
    
        
                        } else {
                            $msg = "<p class='text-danger fs-2'>une erreur et survenue </p>";
                        }





                    } else {
                        $msg = "<p class='text-danger fs-2'>une erreur et survenue </p>";
                    }


                } else {
                    $msg = '<h2 class="text-danger">Une erreur est survenue !</h2>';
                }
            }
        }
    }

    require_once('../view/edit_account.php');
}


function avatar() {

    $id = $_SESSION['user_id'];

    $accounts = GetUser($id);

    $msg = null;


    if (isset($_POST['submit'])) {
        if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] == 0) {
            if ($_FILES['avatar']['size'] <= 1000000) {
                $fileInfo = pathinfo($_FILES['avatar']['name']);
                $extension = $fileInfo['extension'];
                $allowedExtensions = ['jpg', 'jpeg', 'JPG', 'gif', 'png', 'svg', 'webp'];

                if (in_array($extension, $allowedExtensions)) {

                    if (empty($accounts['avatar'])) {

                        $success = UpdateAvatar($id);

                        if ($success) {





                            $msg = '<h2 class="text-success">L\'avatar a été mis à jour avec succès !</h2>';
                            



                        } else {
                            $msg = '<h2 class="text-danger">Une erreur est survenue lors de la mise à jour de l\'avatar.</h2>';
                        }


                    } else {


                        $oldAvatarPath = $accounts['avatar']; 
                        if (file_exists($oldAvatarPath)) {
                            unlink($oldAvatarPath); 

                        } 

                        $success = UpdateAvatar($id);

                        if ($success) {
                            


                            $msg = '<h2 class="text-success">L\'avatar a été mis à jour avec succès !</h2>';



                        } else {
                            $msg = '<h2 class="text-danger">Une erreur est survenue lors de la mise à jour de l\'avatar.</h2>';
                        }

                    }
 
                } else {
                    $msg = '<h2 class="text-danger">Le format du fichier n\'est pas autorisé. Merci d\'envoyer uniquement des fichiers .jpg, .jpeg, .png ou .gif !</h2>';
                }
            } else {
                $msg = '<h2 class="text-danger">Le fichier dépasse la taille autorisée !</h2>';
            }
        } else {
            $msg = '<h2 class="text-danger">Le fichier n\'a pas été envoyé correctement !</h2>';
        }
    }

    require_once('../view/avatar.php');
}


// changer d'endroit de controllers ?
function password_forgot(){











  require_once('../view/password_forgot.php');

}


function password_reset(){








    require_once('../view/reset_password.php');
}