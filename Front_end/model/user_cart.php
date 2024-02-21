<?php
//Model/user_cart.php

function dbConnectUserCart(){
    try{
        $db = new PDO ('mysql:host=localhost;dbname=fil_rouge;charset=utf8','root','');
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $db;
    } catch (PDOException $e) {
        throw new Exception('Erreur de connexion à la base de données : ' . $e->getMessage());
    }
}

///controllers/cart.php
function InsertUserCart($user_id, $game_ids, $quantities, $order_id, $prices) {
    // Connexion à la base de données
    $db = dbConnectUserCart();

    // Vérification si les tableaux ont la même longueur
    if (count($game_ids) !== count($quantities) || count($game_ids) !== count($prices)) {
        return false; // Les tableaux n'ont pas la même longueur, donc l'opération n'est pas possible
    }

    // Construction des valeurs pour la requête SQL
    $values = array();
    for ($i = 0; $i < count($game_ids); $i++) {
        $values[] = "(:user_id, :game_id_$i, :quantity_$i, :order_id, :price_$i)";
    }

    // Construction de la requête SQL avec des paramètres dynamiques
    $sql = "INSERT INTO `user_cart`(`user_id`, `game_id`, `quantity`, `order_id`, `price`) VALUES " . implode(', ', $values);

    // Préparation de la requête
    $req = $db->prepare($sql);

    // Liaison des paramètres communs
    $req->bindParam(':user_id', $user_id, PDO::PARAM_STR);
    $req->bindParam(':order_id', $order_id, PDO::PARAM_STR);

    // Liaison des paramètres pour chaque jeu
    for ($i = 0; $i < count($game_ids); $i++) {
        $req->bindParam(":game_id_$i", $game_ids[$i], PDO::PARAM_STR);
        $req->bindParam(":quantity_$i", $quantities[$i], PDO::PARAM_STR);
        $req->bindParam(":price_$i", $prices[$game_ids[$i]], PDO::PARAM_STR); // Utilisation de l'ID du jeu comme clé pour récupérer le prix
    }

    // Exécution de la requête
    $req->execute();
    
    // Vérification du succès de l'opération
    $success = $req->rowCount() > 0;

    // Retourne le résultat de l'opération
    return $success;
}




