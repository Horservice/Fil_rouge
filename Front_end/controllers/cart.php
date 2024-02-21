<?php
// controllers/cart.php
require_once('../model/games.php');
require_once('../model/user_cart.php');
require_once('../model/orders.php');


function cart(){

        $DescriptionPage = "Panier de Futur game";


        $msg = null;
        $noaccount = null;



        // Vérification de la session 'carts'
        if (empty($_SESSION['carts'])) {
            $carts = null;
        } else {
            $ids = $_SESSION['carts'];

            // Appel à la fonction GetGamesCart pour récupérer les jeux du panier
            $carts = GetGamesCart($ids);

            // Récupération des quantités à partir de la session
            $quantities = array_column($_SESSION['carts'], 'quantity');

            if (isset($_POST['submit'])) {
                // Vérification de la connexion de l'utilisateur
                if (!isset($_SESSION['username']) && !isset($_SESSION['user_id'])) {
                    $noaccount = '
                    <div id="myAlert" class="container-fluid shadow text-center bg-danger  mx-auto text-white rounded">
                        <p class="py-3">
                            Veuillez vous connecter pour effectuer l\'achat
                            <button type="button"  class="btn-close mx-auto close rounded-pill p-2"></button>
                        </p>
                    </div>';
                } else {
                    
                    $prices = [];

                    // Mise à jour des quantités dans la session en fonction du formulaire
                    foreach ($_SESSION['carts'] as &$cart) {
                        $quantity_key = 'quantity_' . $cart['game_id'];
                        if (isset($_POST[$quantity_key])) {
                            $cart['quantity'] = $_POST[$quantity_key];
                        }
                    
                        $price_key = 'price_' . $cart['game_id'];
                        if (isset($_POST[$price_key])) {
                            $cart['price'] = $_POST[$price_key];

                            $cart['unique'] = $_POST[$price_key];

                            
                            // Ajout du var_dump pour vérifier si le prix unique est récupéré correctement
                            var_dump("Prix unique du jeu {$cart['game_id']} avant mise à jour : " . $cart['price'] . "€");
                    

                            var_dump("Prix unique du jeu {$cart['game_id']} teste : " . $cart['unique'] . "€");

                            // Mettre à jour le prix en fonction de la quantité
                            $cart['price'] = $cart['price'] * $cart['quantity'];
                    
                            // Ajout du var_dump pour vérifier le nouveau prix après mise à jour
                            var_dump("Nouveau prix du jeu {$cart['game_id']} : " . $cart['price'] . "€");

                            var_dump("prix unitaire " . $cart['unique'] . "€");

                    
                            // Stockage du prix unique dans le tableau associatif
                            $prices[$cart['game_id']] = $cart['price'];


                        }
                    }

                    var_dump($prices);


                    // $totalPrice = isset($_POST['total_price']) ? floatval($_POST['total_price']) : 0;
                    // var_dump("Prix total : " . $totalPrice . "€");

                    // Affichage des informations pour le débogage
                    var_dump("Id du client : " . $_SESSION['user_id']);
                    var_dump("Id du jeu : " . implode(', ', array_column($_SESSION['carts'], 'game_id')));
                    var_dump("Quantités : " . implode(', ', array_column($_SESSION['carts'], 'quantity')));


                    $user_id = $_SESSION['user_id'];

                    
                    $totalPrice = isset($_POST['total_price']) ? floatval($_POST['total_price']) : 0;
                   
                    var_dump("Prix total : " . $totalPrice . "€");

                    
                    // Créez la commande et obtenez l'ID de la commande
                    $order_id = CreateOrder($user_id, $totalPrice);

                    var_dump("order_id : " . $order_id);

                    $game_ids = array_column($_SESSION['carts'], 'game_id');
                    $quantities = array_column($_SESSION['carts'], 'quantity');
                    
                    var_dump("teste game_ids: ", $game_ids);
                    var_dump("teste quantities: ", $quantities);
                    

                    if ($order_id !== null) {

                                // Insertion des jeux dans la base de données utilisateur avec l'ID de la commande
                                $success = InsertUserCart(
                                    $user_id,
                                    // array_column($_SESSION['carts'], 'game_id'),
                                    $game_ids,
                                    // array_column($_SESSION['carts'], 'quantity'),
                                    $quantities,
                                    $order_id,
                                    $prices  // Utilisation du tableau des prix uniques
                                );

                            // Affichage du résultat de l'insertion
                            if ($success) {
                                echo "Votre commandes bien passé";
                                unset($_SESSION['carts']);

                                $_SESSION['carts'] = array();

                                $_SESSION['message'] = '
                                <div id="myAlert" class="container-fluid mb-5 shadow text-center bg-success w-50 mx-auto text-white rounded">
                                    <p class="py-3">
                                            Votre commande a bien été passée.
                                        <button type="button"  class="btn-close mx-auto close rounded-pill p-2"></button>
                                    </p>
                                </div>';
                                //a réactive quand tout marche
                                // header("Location: index.php?page=homepage"); 


                            } else {

                                // unset($_SESSION['carts']);
                                // $_SESSION['carts'] = array();

                                $_SESSION['message'] = '
                                <div id="myAlert" class="container-fluid mb-5 shadow text-center bg-danger w-50 mx-auto text-white rounded">
                                    <p class="py-3">
                                        Une erreur est survenue lors de la commande
                                            <button type="button"  class="btn-close mx-auto close rounded-pill p-2"></button>
                                    </p>
                                    
                                /div>';
                                
                                echo "Une erreur est survenue lors de la commande";
                            }

                    } else {

                        echo "Une erreur est survenue lors de la création de la commande";
                        $errororders = "Une erreur est survenue lors de la création de la commande";
                    }

                }
            }




            if (isset($_POST['delete'])) {
                // Suppression d'un jeu du panier
                $deletedGameId = $_POST['delete'];
                $cartIndex = array_search($deletedGameId, array_column($_SESSION['carts'], 'game_id'));

                if ($cartIndex !== false) {
                    unset($_SESSION['carts'][$cartIndex]);
                    $_SESSION['carts'] = array_values($_SESSION['carts']);
                    // Rechargement de la page avec JavaScript
                    echo "<script>location.reload();</script>";
                    exit();
                } 


                
            }
        }

        // Inclusion de la vue
        require_once('../view/cart.php');
}


