<?php
// Controllers/game
require_once('../model/game.php');
require_once('../model/categories.php');
require_once('../model/sub_categories.php');
require_once('../model/plateforms.php');

function management_game(){
    $games = ShowGame();
    require_once('../view/management_game.php');
}

function add_game(){
    $msg = null;

    $categories = SelectCategorie();
    $subcategories =  SelectSubCategorie();
    $plateforms = SelectPlateforms();

    if (isset($_POST['submit'])) {
        if (
            !isset($_POST['name']) || empty($_POST['name']) ||
            !isset($_POST['genre']) || empty($_POST['genre']) ||
            !isset($_POST['description']) || empty($_POST['description']) ||
            !isset($_POST['price']) ||
            !isset($_POST['editor']) ||
            !isset($_FILES['path']) || empty($_FILES['path']) ||
            !isset($_POST['category_id']) ||
            !isset($_POST['sub_category_id']) ||
            !isset($_POST['alt']) || empty($_POST['alt'])
        ) {
            $msg = '<h2 class="text-danger">Merci de bien vouloir remplir le formulaire correctement !</h2>';
        } else {
            if (isset($_FILES['path']) && $_FILES['path']['error'] == 0) {
                if ($_FILES['path']['size'] <= 1000000) {
                    $fileInfo = pathinfo($_FILES['path']['name']);
                    $extension = $fileInfo['extension'];
                    $allowedExtensions = ['jpg', 'jpeg', 'gif', 'png', 'svg', 'webp'];
                    if (in_array($extension, $allowedExtensions)) {
                        $success = AddGame();
                        if ($success) {
                            $msg = '<h2 class="text-success">Ajout d\'un jeu vidéo réussi !</h2>';
                        } else {
                            $msg = '<h2 class="text-danger">Une erreur est survenue lors de l\'ajout du jeu vidéo !</h2>';
                        }
                    } else {
                        $msg = '<h2 class="text-danger">Le format du fichier n\'est pas autorisé. Merci d\'envoyer seulement des fichiers .jpg, .jpeg, .png, .gif, .svg ou .webp !</h2>';
                    }
                } else {
                    $msg = '<h2 class="text-danger">Le fichier dépasse la taille autorisée !</h2>';
                }
            } else {
                $msg = '<h2 class="text-danger">Le fichier n\'a pas été envoyé correctement !</h2>';
            }
        }
    }

    require_once('../view/add_game.php');
}

function edit_game($id){
    $msg = null;
    $games = getGame($id);
    $categories = SelectCategorie();
    $subcategories =  SelectSubCategorie();
    $plateforms = SelectPlateforms();
    $gamePath = $games['path']; // Remplacez cela par le chemin réel du fichier associé au jeu vidéo

    if (isset($_POST['submit'])) {
        if (
            !isset($_POST['name']) || empty($_POST['name']) ||
            !isset($_POST['genre']) || empty($_POST['genre']) ||
            !isset($_POST['description']) || empty($_POST['description']) ||
            !isset($_POST['price']) ||
            !isset($_POST['editor']) ||
            !isset($_FILES['path']) || empty($_FILES['path']) ||
            !isset($_POST['category_id']) ||
            !isset($_POST['sub_category_id']) ||
            !isset($_POST['alt']) || empty($_POST['alt'])
        ) {
            $msg = '<h2 class="text-danger">Merci de bien vouloir remplir le formulaire correctement !</h2>';
        } else {



                if (isset($_FILES['path']) && $_FILES['path']['error'] == 0) {
                    if ($_FILES['path']['size'] <= 1000000) {
                        $fileInfo = pathinfo($_FILES['path']['name']);
                        $extension = $fileInfo['extension'];
                        $allowedExtensions = ['jpg', 'jpeg', 'gif', 'png', 'svg', 'webp'];

                            if (in_array($extension, $allowedExtensions)) {
                                $success = UpdateGame($id);
                                if ($success) {
                                    // La mise à jour a réussi, donc nous supprimons la copie de sauvegarde
                                    $msg = '<h2 class="text-success">Modification du jeu vidéo réussie !</h2>';
                                } else {
                                    // En cas d'erreur, nous restaurons la photo à partir de la copie de sauvegarde
                                    $msg = '<h2 class="text-danger">Une erreur est survenue lors de la modification du jeu vidéo ! La photo a été restaurée.</h2>';
                                }
                            }
                    } else {
                        $msg = '<h2 class="text-danger">Le fichier dépasse la taille autorisée !</h2>';
                    }
                } else {
                    $msg = '<h2 class="text-danger">Le fichier n\'a pas été envoyé correctement !</h2>';
                }






        }
    }

    require_once('../view/edit_game.php');
}

function del_game($id){
    $msg = null;
    $games = getGame($id);

    if(isset($_POST['submit'])){
        // Sauvegarde temporaire du fichier

            $success = DeleteGame($id);

            if ($success) {
                // La suppression a réussi, donc nous supprimons la copie de sauvegarde
                $msg = "<h2 class='text-success'>Le jeu vidéo a été bien supprimé</h2>";
            } else {
                // En cas d'erreur, nous restaurons la photo à partir de la copie de sauvegarde

                $msg = '<h2 class="text-danger">Une erreur est survenue lors de la suppression du jeu vidéo !.</h2>';
            }

        } 

        require_once('../view/del_game.php');

}

