<?php
//controllers/search_game.php
require_once('../model/games.php');
require_once('../model/categories.php'); 
require_once('../model/sub_category.php'); 
require_once('../model/plateforms.php'); 


function search($query,$category, $sub_category, $plateforme, $price ){



    $msg = null;
    // $results = searchGames($query); pour teste

    var_dump("Barre de recherche : " , $query, "Numéro de la catégorie ID : ", $category, "Numéro de la sous-catégorie ID : ", $sub_category, "Numéro de la plateforme ID : ", $plateforme, "Prix : ", $price);

    $Plateforms = ShowPlateforms();

    $categories = ShowCategory(); 

    $sub_categorys = ShowSubCategory(); 

    if (empty($category)) {

        echo"est empty , category";
        # code...
    }

    if (empty($sub_category)) {

        echo" , sub_category";
        # code...
    }

    if (empty($plateforme)) {

        echo" , plateforme";
        # code...
    }

    if (empty($price)) {

        echo" , price";
        # code...
    }



        if (empty($query)) {

            //query vide





              //  la function afficher les jeux sortis récemment a la instant gaming

              $Game = EmptyQuery($category, $sub_category, $plateforme, $price);


                // $Game = EmptyQuery();

            if (empty($Game)) {
                echo"<br>Oui vide<br>";
                $msg ="";

            }
    
                echo"aucun nom de jeux cherche donc afficher les jeux récent ? <br>
                
                je confirmer afficher jeux récent sortis comme instant gaming";
    
    

            
        } else {


            echo "<br> query afficher le nom du jeux : $query <br>";

            // ajouter les autre arguement de recherche plus tard
            // $category, $sub_category, $plateforme, $price
             $Game = SearchNameGame($query,$category, $sub_category, $plateforme, $price);

            // $Game = SearchNameGame($query);

            // var_dump(count(SearchNameGame($query,$category, $sub_category, $plateforme, $price)));
                        // var_dump(count(SearchNameGame($query,$category, $sub_category, $plateforme, $price)));


            if(empty($Game)){

                $msg ="";
                echo"Aucun jeux existe dans la bdd";
            }


        }


    require_once("../view/search.php");
}
