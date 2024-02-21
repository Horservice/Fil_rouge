<?php
//controllers/account.php
require_once('../model/users.php');
require_once('../model/user_cart.php');
require_once('../model/orders.php');


function orders($id){


    var_dump("id de la commande " . $id);

    $user_id = $_SESSION['user_id'];
    var_dump("id du compte  " . $user_id);



    $order_id = $id;

    $orders = GetOrdersByIdCart($user_id, $order_id);




    // $user_id = GetUser();

    // $orders = GetOrders();



    require_once('../view/orders.php');
}