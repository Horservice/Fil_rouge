<?php
session_name('back_office');
session_start();

try {


    require_once('../controllers/dashboard.php');
    require_once('../controllers/admin.php');
    require_once('../controllers/game.php');
    require_once('../controllers/sub_categories.php');
    require_once('../controllers/categories.php');
    require_once('../controllers/plateforms.php');

    // require_once('../controllers/login.php');
    // require_once('../controllers/reset_password.php');
    // require_once('../controllers/password_forgot.php');



    // if (!isset($_SESSION['username']) || $_SESSION['username'] !== 'admin') {
    //     header('location: login.php');
    //     exit;
    // }







    if (!isset($_SESSION['role']) & !isset($_SESSION['username'])) {
        header('location: login.php');

    }

    if (isset($_GET['action']) && $_GET['action'] == "signout") {
        session_destroy();
        header('location: login.php');

    }




    //faire a la fin
    // if (!isset($_SESSION['username'])) {
    //     # code pour avant se connecet

    // if (isset($_GET['page'])) {
    //     $page = strval($_GET['page']);

    //     if ($page == "login") {
    //         login();
    //     } elseif ($page == "password_forgot") {
    //         password_forgot();
    //     } elseif ($page == "reset_password") {
    //         reset_password();
    //     } else {


    //         login();

    //     }

    // } else {
    //     # code en dessu du isset page etc quand admin et co

    if (isset($_GET['page'])) {
        $page = strval($_GET['page']);

        if ($page == "dashboard") {
            dashboard();
        } elseif ($page == "management_admin") {
            management_admin();
        } elseif ($page == "management_game") {
            management_game();
        }  elseif ($page == "management_plateforms") {
            management_plateforms();
        }  elseif ($page == "management_categories") {
            management_categories();
        }   elseif ($page == "management_sub_categories") {
            management_sub_categories();
        }  elseif ($page == "add_admin") {
            add_admin();
        } elseif ($page == "add_game") {
            add_game();
        } elseif ($page == "add_plateform") {
            add_plateforms();
        } elseif ($page == "add_categories") {
            add_categories();
        } elseif ($page == "add_sub_categories") {
            add_sub_categories();
        } elseif ($page == "edit_admin") {
            if (isset($_GET['id']) && is_numeric($_GET['id'])) {
                $id = intval($_GET['id']);
                edit_admin($id);
            } else {
                throw new Exception('Aucun identifiant d\'admin trouvé pour être modifié');
            }






        } elseif ($page == "edit_game") {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                $id = strval($_GET['id']);
                edit_game($id);
            } else {
                throw new Exception('Aucun identifiant du jeux a trouvé pour être modifié');
            }

        }  elseif ($page == "edit_plateform") {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                $id = strval($_GET['id']);
                edit_plateforms($id);
            } else {
                throw new Exception('Aucun identifiant d\'admin trouvé pour être modifié');
            }
        } elseif ($page == "edit_categories") {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                $id = strval($_GET['id']);
                edit_categories($id);
            } else {
                throw new Exception('Aucun identifiant d\'admin trouvé pour être modifié');
            }
            
        } elseif ($page == "edit_sub_categories") {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                $id = strval($_GET['id']);
                edit_sub_categories($id);
            } else {
                throw new Exception('Aucun identifiant d\'admin trouvé pour être modifié');
            }
            
        } 



        elseif ($page == "del_admin") {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                $id = strval($_GET['id']);
                del_admin($id);
            }


        } elseif ($page == "del_game") {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                $id = strval($_GET['id']);
                del_game($id);
            }
            


        }  elseif ($page == "del_plateform") {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                $id = strval($_GET['id']);
                del_plateforms($id);
            }
            


        }  elseif ($page == "del_categories") {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                $id = strval($_GET['id']);
                del_categories($id);
            }
            



        }  elseif ($page == "del_sub_categories") {

            if (isset($_GET['id']) && $_GET['id'] > 0) {
                $id = strval($_GET['id']);
                del_sub_categories($id);
            }

        }  

        
        
    } else {

        dashboard();
    }


//   }


} catch (Exception $e) {
    $errorMessage = $e->getMessage();
    require_once('../view/error.php');
}