<?php
//controllers/homepage.php
require_once('../model/categories.php');
require_once('../model/games.php');


function homepage(){


    //afficher les 3 jeux récent mis
    $newGames = ShowNewGameOnly3();


    $totalGames = count($newGames);

    $Games20 = ShowGame20();

    $categories = ShowCategory(); 


    $message = null;

    if (isset($_SESSION['message'])) {
        $message = $_SESSION['message'];
        unset($_SESSION['message']);
    }
    
    if (isset($_SESSION['messagelogin'])) {
        $message = $_SESSION['messagelogin'];
        unset($_SESSION['messagelogin']);
    }

    


    //débug

    var_dump($_SESSION);

    if (!empty($_SESSION)) {
        if (isset($_SESSION['lastname'])) {
            var_dump("le nom de famille : " . $_SESSION['lastname']);
        } else {
            var_dump("le nom de famille n'est pas défini dans la session.");
        }
    
        if (isset($_SESSION['firstname'])) {
            var_dump("le prénom : " . $_SESSION['firstname']);
        } else {
            var_dump("le prénom n'est pas défini dans la session.");
        }
    
        if (!empty($_SESSION['avatar'])) {
            var_dump("l'avatar le chemin ou si avatar: " . $_SESSION['avatar']);
        } else {
            var_dump("n'a pas d'avatar");
        }
    
        if (isset($_SESSION['username'])) {
            var_dump("le nom utilisateur : " . $_SESSION['username']);
        } else {
            var_dump("le nom utilisateur n'est pas défini dans la session.");
        }
    
        if (isset($_SESSION['user_id'])) {
            var_dump("sont id : " . $_SESSION['user_id']);
        } else {
            var_dump("L'identifiant d'utilisateur n'est pas défini dans la session.");
        }



    } else {
        var_dump("La session est vide.");
    }
    

    
    
    require_once('../view/homepage.php');
}