<?php
// controllers/category.php
require_once('../model/categories.php');
require_once('../model/sub_category.php');
require_once('../model/games.php');


function category($id){




        //marche code 
        // var_dump("id de la catégorie est : " . $id);


        $currentPage = isset($_GET['pages']) ? (int)$_GET['pages'] : 1; // Get the current page from the URL

        // var_dump("nous sommes a la page : " . $currentPage);

        $perPage = 3; // Number of items per page

        // var_dump("nomnbre de jeux par page  : " . $perPage);


    
        $totalGames = count(GetGamesByIdByCategory($id)); // Total number of games for the category

        // var_dump("nombre de jeux total : " . $totalGames);
    
        $paginationStart = max(0, ($currentPage - 1) * $perPage); // Ensure non-negative offset


        $paginatedGames = GetGamesByIdByCategory($id, $perPage, $paginationStart);





        // if (empty($paginatedGames)) {

        //         echo"marche mais manque de jeux";

        // } else {

        //         echo "il y a des jeux";
                
        // }
                

    
        $totalPages = ceil($totalGames / $perPage);

        // var_dump("nombre de page total  : " . $totalPages);





        //sert a afficher genre ; sous catégorie action etc, nom gatégorie cation
        $categorys = GetCategory($id);

        $DescriptionPage = "Catégorie des jeux liés à " . $categorys['name'];



        //sert afficher les sous catéogir lié a la catégorie
        $sub_categories = GetSubCategoriesByCategoryId($id);



   require_once('../view/category.php');
}
