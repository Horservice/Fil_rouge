<?php
//Model/orders.php

function dbConnectOrders(){
    try{
        $db = new PDO ('mysql:host=localhost;dbname=fil_rouge;charset=utf8','root','');
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $db;
    } catch (PDOException $e) {
        throw new Exception('Erreur de connexion à la base de données : ' . $e->getMessage());
    }
}


function CreateOrder($user_id, $totalPrice) {
    $db = dbConnectOrders();

    $req = $db->prepare("INSERT INTO `orders` (`user_id`, `price_total`) VALUES (:user_id, :price_total)");
    $req->bindParam(':user_id', $user_id, PDO::PARAM_STR);
    $req->bindParam(':price_total', $totalPrice, PDO::PARAM_STR);

    if ($req->execute()) {
        // Récupérez l'ID de la commande nouvellement créée
        return $db->lastInsertId();
    } else {
        // Gestion d'erreur ici
        return null;
    }
}

function GetOrders($id){
    try {
        $db = dbConnectOrders();
        $id = strval($id);
        $statement = $db->prepare("SELECT `order_id`, `user_id`, `order_date`, `price_total` FROM `orders` WHERE user_id = :user_id ORDER BY order_date DESC");
        $statement->bindValue(':user_id', $id, PDO::PARAM_INT);
        $statement->execute();

        $result = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $result; 
    } catch (PDOException $e) {
        throw new Exception('Erreur lors de la récupération des commandes : ' . $e->getMessage());
    }
}


function GetOrdersById($id, $limit = 20, $offset = 0) {
    $db = dbConnectOrders();
    $id = strval($id);

    $statement = $db->prepare("SELECT `order_id`, `user_id`, `order_date`, `price_total` FROM `orders` WHERE user_id = :user_id ORDER BY order_date DESC LIMIT :limit OFFSET :offset");

    $statement->bindParam(':user_id', $id, PDO::PARAM_INT);
    $statement->bindParam(':limit', $limit, PDO::PARAM_INT);
    $statement->bindParam(':offset', $offset, PDO::PARAM_INT);

    $statement->execute();

    $result = $statement->fetchAll(PDO::FETCH_ASSOC);

    $statement->closeCursor();

    return $result;
}








//ajouter plus tard le price total du orders et aussi la date 
function GetOrdersByIdCart($user_id, $order_id){
    try {
        $db = dbConnectOrders();
        $user_id = strval($user_id);
        $order_id = strval($order_id);

        $statement = $db->prepare("
                SELECT uc.`cart_id`, uc.`user_id`, uc.`game_id`, uc.`quantity`, uc.`price`, uc.`order_id`,
                g.`game_id`, g.`name` AS game_name, g.`genre`, g.`path`, p.`platform_id`, p.`name` AS platform_name,
                o.`order_id`, o.`user_id`, o.`order_date`, o.`price_total`
                FROM `user_cart` uc
                INNER JOIN `games` g ON uc.`game_id` = g.`game_id`
                INNER JOIN `orders` o ON uc.`order_id` = o.`order_id`
                INNER JOIN `plateforms` p ON g.`platform_id` = p.`platform_id`
                WHERE uc.`user_id` = :user_id AND uc.`order_id` = :order_id;
 
        ");
        $statement->bindValue(':user_id', $user_id, PDO::PARAM_INT);
        $statement->bindValue(':order_id', $order_id, PDO::PARAM_INT);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        
        if (empty($result)) {
            echo "Aucune commande trouvée pour l'utilisateur $user_id et la commande $order_id.";
        }
        
        return $result;
    } catch (PDOException $e) {
        throw new Exception('Erreur : ' . $e->getMessage());
    }
}