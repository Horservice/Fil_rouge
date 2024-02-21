<?php
session_name('front_end');
session_start();



try {

    require_once('../controllers/homepage.php');
    require_once('../controllers/login.php');
    require_once('../controllers/account.php');
    require_once('../controllers/cart.php');
    require_once('../controllers/games.php');
    require_once('../controllers/category.php');
    require_once('../controllers/sub_category.php');
    require_once('../controllers/orders.php');
    require_once('../controllers/search.php');

    
    
    if (isset($_GET['action']) && $_GET['action'] == "signout") {

      unset($_SESSION['lastname']);
      unset($_SESSION['firstname']);
      unset($_SESSION['avatar']);
      unset($_SESSION['username']);
      unset($_SESSION['user_id']);


      header("Location: index.php?page=homepage"); 
        
    }


    if (isset($_GET['page']) && $_GET['page'] !== '') {
        $page = strval($_GET['page']);

        if($page == "homepage") {
            homepage();
          } elseif ($page == "password_forgot") {
            password_forgot();
          } elseif ($page == "login") {
            login();
          } elseif ($page == "reset_password") {
            reset_password();
          } elseif ($page == "create_account") {
            create_account(); 
          } elseif ($page == "cart") {
            cart(); 
          } elseif ($page == "account") {
            account(); 
          } elseif ($page == "edit_account") {
            edit_account(); 
          } elseif ($page == "avatar") {
            avatar(); 
          } elseif ($page == "contact") {
            contact(); 
          } elseif ($page == "games") {
              if (isset($_GET['id']) && $_GET['id']) {
                $id = strval($_GET['id']);
                games($id);
            } else {
              throw new Exception('Aucun jeux video trouvé');
            }
          }
            
          elseif ($page == "category") {
            if (isset($_GET['id']) && $_GET['id']) {
              $id = strval($_GET['id']);
              category($id);
          } else {
            throw new Exception('Aucune catégorie trouvé');
          }          
        }  
        
        elseif ($page == "sub_category") {
          if (isset($_GET['id_sub_category']) && $_GET['id_sub_category'] && isset($_GET['id_category']) && $_GET['id_category']) {
              $id_sub_category = strval($_GET['id_sub_category']);
              $id_category = strval($_GET['id_category']);
      
              sub_category($id_sub_category, $id_category);
          } else {
              throw new Exception('Aucune sous catégorie trouvée');
          }      
      }

          
          
        elseif ($page == "orders") {
          if (isset($_GET['id']) && $_GET['id']) {
            $id = strval($_GET['id']);
            orders($id);
        } else {
          throw new Exception('Aucune commande trouvé');
        }          
      }  

      elseif ($page == "search") {
        if (isset($_GET['query'])) {
            // query = nom du jeu rentré dans le search input
            $query = htmlspecialchars($_GET['query']);

            $category = isset($_GET['category_id']) ? $_GET['category_id'] : null;
            $sub_category = isset($_GET['sub_category_id']) ? $_GET['sub_category_id'] : null;
            $plateforme = isset($_GET['platform_id']) ? $_GET['platform_id'] : null;
            $price = isset($_GET['price']) ? $_GET['price'] : null;



            

            // var_dump($query,$category, $sub_category, $plateforme, $price_max  , $price_min);

            //a supprimer ?
            // if (!empty($category)  || !empty($plateforme) || !empty($sub_category)) {
            //     // Appeler la fonction de recherche avancée dans le modèle
            //     //changer le nom de la function ? 
            //     $results = advancedSearchGames($query, $category, $price, $plateforme, $sub_category);
            // } else {
            //     // Appeler la fonction de recherche normale dans le modèle
            //     $results = search($query);
            // }



             search($query,$category, $sub_category, $plateforme, $price);

            // $results = search($query); pour teste
        } else {
            throw new Exception('Une erreur est survenue pour la recherche du/des jeux video');
        }

     }
    
     //alafin
     elseif ($page == "mention_legal") {

     }

     elseif ($page == "credit_icon") {

     }
     elseif ($page == "politique") {

     }
     elseif ($page == "condition") {

     }

    } else {
        
        homepage();
  
    }


}  catch (Exception $e) {



    $errorMessage = $e->getMessage();
    require_once('../view/error.php');


}