<?php
// controllers/category.php
require_once('../model/categories.php');
require_once('../model/sub_category.php');
require_once('../model/games.php');


function sub_category($id_sub_category,$id_category){



        // var_dump("la sous catégorie de sont id est : " . $id_sub_category);

        // var_dump("la catégorie de sont id est : " . $id_category);


        $currentPage = isset($_GET['pages']) ? (int)$_GET['pages'] : 1; // Get the current page from the URL

        // var_dump("nous sommes a la page : " . $currentPage);


        $perPage = 1; // Number of items per page

        // var_dump("nomnbre de jeux par page  : " . $perPage);


        $id = $id_category;

        $totalGames = count(GetGamesByIdBySubCategory($id_sub_category));

        // var_dump("nombre de jeux total : " . $totalGames);

        $paginationStart = max(0, ($currentPage - 1) * $perPage); // Ensure non-negative offset


        $paginatedGames = GetGamesByIdBySubCategory($id_sub_category, $perPage, $paginationStart);

        if (empty($paginatedGames)) {

                echo"marche mais manque de jeux";

        } else {

                // echo "il y a des jeux";

                // var_dump(($paginatedGames));
                
        }

        $categorys = GetCategory($id);



        // $Games = count(GetGamesByIdBySubCategory($id_sub_category));

        
        $totalPages = ceil($totalGames / $perPage);


        // var_dump("nombre de jeux total : " . $totalPages);



        $sub_categorys = GetSubCategoryByid($id_sub_category);

        require_once('../view/sub_category.php');

}