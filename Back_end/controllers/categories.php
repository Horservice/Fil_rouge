<?php
// Controllers/categories
require_once('../model/categories.php');

function management_categories(){
    $categories = ShowCategorie();
    require_once('../view/management_categories.php');
}

function add_categories(){
    $msg = null;

    if (isset($_POST['submit'])) {
        if (!isset($_POST['name']) || empty($_POST['name']) || 
            !isset($_FILES['path']) || empty($_FILES['path']) || 
            !isset($_POST['alt']) || empty($_POST['alt'])
        ) {
            $msg = '<h2 class="text-danger">Merci de bien vouloir remplir le formulaire !</h2>';
        } else {
            if (isset($_FILES['path']) && $_FILES['path']['error'] == 0) {
                if ($_FILES['path']['size'] <= 1000000) {
                    $fileInfo = pathinfo($_FILES['path']['name']);
                    $extension = $fileInfo['extension'];
                    $allowedExtensions = ['jpg', 'jpeg', 'gif', 'png', 'svg', 'webp'];
                    if (in_array($extension, $allowedExtensions)) {
                        $success = AddCategorie();
                        if ($success) {
                            $msg = '<h2 class="text-success">Ajout d\'une catégorie réussi</h2>';
                        } else {
                            $msg = '<h2 class="text-danger">Une erreur est survenue !</h2>';
                        }
                    } else {
                        $msg = '<h2 class="text-danger">Le format du fichier n\'est pas autorisé. Merci d\'envoyer seulement des fichiers .jpg, .jpeg, .png ou .gif, ainsi que des fichiers .svg et .webp !</h2>';
                    }
                } else {
                    $msg = '<h2 class="text-danger">Le fichier dépasse la taille autorisée !</h2>';
                }
            } else {
                $msg = '<h2 class="text-danger">Le fichier n\'a pas été envoyé correctement !</h2>';
            }
        }
    }
    require_once('../view/add_categories.php');
}

function edit_categories($id){
    $msg = null;
    $categories = getCategories($id);
    $categoryPath = $categories['path']; // Remplacez cela par le chemin réel du fichier associé à la catégorie

    if (isset($_POST['submit'])) {
        if (!isset($_POST['name']) || empty($_POST['name']) || 
            !isset($_FILES['path']) || empty($_FILES['path']) || 
            !isset($_POST['alt']) || empty($_POST['alt'])
        ) {
            $msg = '<h2 class="text-danger">Merci de bien vouloir remplir le formulaire !</h2>';
        } else {
            if (isset($_FILES['path']) && $_FILES['path']['error'] == 0) {
                if ($_FILES['path']['size'] <= 1000000) {
                    $fileInfo = pathinfo($_FILES['path']['name']);
                    $extension = $fileInfo['extension'];
                    $allowedExtensions = ['jpg', 'jpeg', 'gif', 'png', 'webp'];
                    if (in_array($extension, $allowedExtensions)) {
                        // Sauvegarde temporaire du fichier
                        $backupPath = '../uploads'. basename($categoryPath);
                        
                        if (copy($categoryPath, $backupPath)) { // Crée une copie de sauvegarde du fichier
                            $oldPath = $categories['path']; // Remplacez cela par le chemin réel de l'ancienne image
                            if (file_exists($oldPath)) {
                                unlink($oldPath); // Supprime l'ancienne image du dossier
                            }
                            $success = UpdateCategorie($id);
                            if ($success) {
                                // La mise à jour a réussi, donc nous supprimons la copie de sauvegarde
                                unlink($backupPath);
                                $msg = '<h2 class="text-success">Modification de la catégorie réussie</h2>';
                            } else {
                                // En cas d'erreur, nous restaurons la photo à partir de la copie de sauvegarde
                                copy($backupPath, $categoryPath);
                                unlink($backupPath); // Supprime la copie de sauvegarde
                                $msg = '<h2 class="text-danger">Une erreur est survenue lors de la mise à jour de la catégorie ! La photo a été restaurée.</h2>';
                            }
                        } else {
                            $msg = '<h2 class="text-danger">Une erreur est survenue lors de la création de la copie de sauvegarde du fichier !</h2>';
                        }
                    } else {
                        $msg = '<h2 class="text-danger">Extension de fichier non autorisée !</h2>';
                    }
                } else {
                    $msg = '<h2 class="text-danger">Le fichier dépasse la taille autorisée !</h2>';
                }
            } else {
                $msg = '<h2 class="text-danger">Le fichier n\'a pas été envoyé correctement !</h2>';
            }
        }
    }
    require_once('../view/edit_categories.php');
}


function del_categories($id){
    $msg = null;
    $categories = getCategories($id);
    $categoryPath = $categories['path']; // Remplacez cela par le chemin réel du fichier associé à la catégorie

    if(isset($_POST['submit'])){
        // Sauvegarde temporaire du fichier
        $backupPath = '../uploads' . basename($categoryPath);

        if (copy($categoryPath, $backupPath)) { // Crée une copie de sauvegarde du fichier
            $success = DeleteCategorie($id);
            if ($success) {
                // La suppression a réussi, donc nous supprimons la copie de sauvegarde
                unlink($backupPath);
                $msg = "<h2 class='text-success'>La catégorie a été bien supprimée</h2>";
            } else {
                // En cas d'erreur, nous restaurons la photo à partir de la copie de sauvegarde
                copy($backupPath, $categoryPath);
                unlink($backupPath); // Supprime la copie de sauvegarde
                $msg = '<h2 class="text-danger">Une erreur est survenue lors de la suppression de la catégorie ! La photo a été restaurée.</h2>';
            }
        } else {
            $msg = '<h2 class="text-danger">Une erreur est survenue lors de la création de la copie de sauvegarde du fichier !</h2>';
        }
    }
    require_once('../view/del_categories.php');
}