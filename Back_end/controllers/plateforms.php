<?php
// Controllers/plateforms
require_once('../model/plateforms.php');

function management_plateforms(){
    $plateforms = ShowPlateforms();
    require_once('../view/management_plateforms.php');
}

function add_plateforms(){
    $msg = null;

    if(isset($_POST['submit'])){
    
        if (
        
        !isset($_POST['name']) || empty($_POST['name'])

        ){
            
            $msg='<h2 class="text-danger">Merci de bien vouloir remplir le formulaire correctement !</h2>';
    
         } else {
            $success = AddPlateforms();
            if ($success) {
                $msg = '<h2 class="my-5 text-success">Une plateforme a été ajoutée.</h2>';
            } else {
                $msg = '<h2 class="text-danger">Une erreur est survenue !</h2>';
            }
         }
    }
    
    require_once('../view/add_plateforms.php');
}

function edit_plateforms($id) {
    $msg = null;
    $plateforms = getPlateforms($id);

    if (isset($_POST['submit'])) {
        if (!isset($_POST['name']) || empty($_POST['name'])) {
            $msg = '<h2 class="text-danger">Tous les champs doivent être remplis !</h2>';
        } else {
            $success = UpdatePlateforms($id, $_POST['name']);
            if ($success) {
                $msg = '<h2 class="text-success">La plateforme a été bien modifiée.</h2>';
            } else {
                $msg = '<h2 class="text-danger">Une erreur est survenue !</h2>';
            }
        }
    }

    require_once('../view/edit_plateforms.php');
}

function del_plateforms($id){
    $msg = null;
    $plateforms = getPlateforms($id);

    if(isset($_POST['submit'])){
        $success = DeletePlateforms($id);
        if ($success) {
            $msg = "<h2 class='text-success'>La plateforme a été supprimée.</h2>";
        } else {
            $msg = '<h2 class="text-danger">Une erreur est survenue !</h2>';
        }
    }

    require_once('../view/del_plateforms.php');
}