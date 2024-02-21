<?php
// Controllers/sub_categories
require_once('../model/sub_categories.php');
require_once('../model/categories.php');

function management_sub_categories(){
    $subCategories = ShowSubCategorie();
    require_once('../view/management_sub_categories.php');
}

function add_sub_categories(){
    $msg = null;
    $categories = SelectCategorie();

    if (isset($_POST['submit'])) {
        if (!isset($_POST['name']) || empty($_POST['name'])) {
            $msg = '<h2 class="text-danger">Merci de bien vouloir remplir le formulaire correctement !</h2>';
        } else {
            // Vérifier si le nom de la sous-catégorie existe déjà
            $existingSubCategory = CheckExistingSubCategory($_POST['name']);

            if ($existingSubCategory) {
                $msg = '<h2 class="text-danger">Le nom de la sous-catégorie existe déjà. Veuillez en choisir un autre.</h2>';
            } else {
                $success = AddSubCategorie();
                if ($success) {
                    $msg = '<h2 class="text-success">Ajout d\'une sous-catégorie réussi !</h2>';
                } else {
                    $msg = '<h2 class="text-danger">Une erreur est survenue !</h2>';
                }
            }
        }
    }

    require_once('../view/add_sub_categories.php');
}


function edit_sub_categories($id){
    $msg = null;
    $subcategories = getSubCategories($id);
    $categories = SelectCategorie();

    if (isset($_POST['submit'])) {
        if (!isset($_POST['name']) || empty($_POST['name'])
        ) {    
            $msg = '<h2 class="text-danger">Merci de bien vouloir remplir le formulaire correctement !</h2>';
        } else  {

                        

                            $success = UpdateSubCategorie($id); // Met à jour la sous-catégorie dans la base de données
                            
                            if ($success) {
                                // La mise à jour a réussi, donc nous supprimons la copie de sauvegarde
                                $msg = '<h2 class="text-success">Modification de la sous-catégorie réussie</h2>';
                            } else {
                                // En cas d'erreur, nous restaurons la photo à partir de la copie de sauvegarde
                                $msg = '<h2 class="text-danger">Une erreur est survenue lors de la mise à jour de la sous-catégorie ! La photo a été restaurée.</h2>';
                            }

                        }

                    }
    require_once('../view/edit_sub_categories.php');
}





function del_sub_categories($id){
    $msg = null;
    $subcategories = getSubCategories($id);

    if(isset($_POST['submit'])){
            // Sauvegarde temporaire du fichier
            
                $success = DeleteSubCategorie($id); // Supprime la sous-catégorie dans la base de données
                
                if ($success) {
                    // La suppression a réussi, donc nous supprimons la copie de sauvegarde
                    $msg = "<h2 class='text-success'>La sous-catégorie a été supprimée</h2>";
                } else {
                    // En cas d'erreur, nous restaurons la photo à partir de la copie de sauvegarde

                    $msg = '<h2 class="text-danger">Une erreur est survenue lors de la suppression de la sous-catégorie ! La photo a été restaurée.</h2>';
                }

    }
    require_once('../view/del_sub_categories.php');
}