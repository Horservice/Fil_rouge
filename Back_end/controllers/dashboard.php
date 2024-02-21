<?php 
//Controllers/dashboard.php
function dashboard(){

    $avatar = $_SESSION['avatar'];

    $lastname = $_SESSION['lastname'];

    $firstname = $_SESSION['firstname'];

    var_dump($_SESSION);

    


    require_once('../view/dashboard.php');   

}