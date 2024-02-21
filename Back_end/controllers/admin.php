<?php
// Controllers/admin
require_once('../model/admin.php');

function management_admin(){
    $admins = ShowAdmin();
    require_once('../view/management_admin.php');
}

function add_admin(){
    $msg = null;

    if(isset($_POST['submit'])){
        if (!isset($_POST['email']) || (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
        || (!isset($_POST['username']) || empty($_POST['username']))
        || (!isset($_POST['lastname']) || empty($_POST['lastname']))
        || (!isset($_POST['firstname']) || empty($_POST['firstname']))
        || (!isset($_POST['password']) || empty($_POST['password']))
        ){
            $msg = '<h2 class="text-danger">Merci de bien vouloir remplir le formulaire !</h2>';
        } else {
            if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] == 0) {
                if ($_FILES['avatar']['size'] <= 1000000) {
                    $fileInfo = pathinfo($_FILES['avatar']['name']);
                    $extension = $fileInfo['extension'];
                    $allowedExtensions = ['jpg', 'jpeg', 'JPG' ,'gif', 'png', 'svg', 'webp'];
                    if (in_array($extension, $allowedExtensions)) {
                        $success = AddAdmin();
                        if ($success) {
                            $msg = '<h2 class="text-success">Un admin a été ajouté avec succès !</h2>';
                        } else {
                            $msg = '<h2 class="text-danger">Une erreur est survenue !</h2>';
                        }
                    } else {
                        $msg = '<h2 class="text-danger">Le format du fichier n\'est pas autorisé. Merci de n\'envoyer que des fichiers .jpg, .jpeg, .png ou .gif !</h2>';
                    }
                } else {
                    $msg = '<h2 class="text-danger">Le fichier dépasse la taille autorisée !</h2>';
                }
            } else {
                $msg = '<h2 class="text-danger">Le fichier n\'a pas été envoyé correctement !</h2>';
            }
        }
    }
    require_once('../view/add_admin.php');
}

function edit_admin($id){
    
    $msg = null;
    $admins = getAdmin($id);
    if(isset($_POST['submit'])){
        if (!isset($_POST['email']) || (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
        || (!isset($_POST['username']) || empty($_POST['username']))
        || (!isset($_POST['lastname']) || empty($_POST['lastname']))
        || (!isset($_POST['firstname']) || empty($_POST['firstname']))
        || (!isset($_POST['password']) || empty($_POST['password']))
        ){
            $msg = '<h2 class="text-danger">Merci de bien vouloir remplir le formulaire !</h2>';
        } else {
            if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] == 0) {
                if ($_FILES['avatar']['size'] <= 1000000) {
                    $fileInfo = pathinfo($_FILES['avatar']['name']);
                    $extension = $fileInfo['extension'];
                    $allowedExtensions = ['jpg', 'jpeg', 'gif', 'png', 'svg', 'webp' ,'JPG'];
                    if (in_array($extension, $allowedExtensions)) {
                        $oldAvatarPath = $admins['avatar']; // Remplacez cela par le chemin réel de l'ancien avatar
                        if (file_exists($oldAvatarPath)) {
                            unlink($oldAvatarPath); // Supprime l'ancien avatar du dossier
                            $success = UpdateAdmin($id);
                            if ($success) {


                                $screenshot = '../uploads/' . basename($_FILES['avatar']['name']);


                                $_SESSION['avatar'] = $screenshot;
                                $msg = '<h2 class="text-success">Modification de l\'admin réussie</h2>';




                            } else {
                                $msg = '<h2 class="text-danger">Une erreur est survenue !</h2>';
                            }
                        } else {
                            
                            $success = UpdateAdmin($id);
                            if ($success) {
                                $msg = '<h2 class="text-success">Modification de l\'admin réussie</h2>';
  
                                $screenshot = '../uploads/' . basename($_FILES['avatar']['name']);


                                $_SESSION['avatar'] = $screenshot;

                            } else {
                                $msg = '<h2 class="text-danger">Une erreur est survenue !</h2>';
                            }



                        }




                    } else {
                        $msg = '<h2 class="text-danger">Le format du fichier n\'est pas autorisé.</h2>';
                    }
                } else {
                    $msg = '<h2 class="text-danger">Le fichier dépasse la taille autorisée !</h2>';
                }
            } else {
                $msg = '<h2 class="text-danger">Le fichier n\'a pas été envoyé correctement !</h2>';
            }
        }
    }
    require_once('../view/edit_admin.php');
}

function del_admin($id){
    $msg = null;
    $admins = getAdmin($id);
    if(isset($_POST['submit'])){
        $oldPhotoPath = $admins['avatar']; // Remplacez cela par le chemin réel de l'ancienne photo
        if (file_exists($oldPhotoPath)) {
            unlink($oldPhotoPath); // Supprime l'ancienne photo du dossier
            $success = DeleteAdmin($id);
            if ($success) {
                $msg = "<h2 class='text-success'>L'admin a bien été supprimé</h2>";
            } else {
                $msg = '<h2 class="text-danger">Une erreur est survenue !</h2>';
            }
        }
    }
    require_once('../view/del_admin.php');
}