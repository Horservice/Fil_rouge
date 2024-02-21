<?php
//Model/users.php


function dbConnectUser(){
    try{
        $db = new PDO ('mysql:host=localhost;dbname=fil_rouge;charset=utf8','root','');
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $db;
    } catch (PDOException $e) {
        throw new Exception('Erreur de connexion à la base de données : ' . $e->getMessage());
    }

}


function ShowUser(){

    $db = dbConnectUser();
    $req = $db->query("SELECT user_id, username, firstname, lastname, email, billing_address , delivery_address , avatar FROM admin");
    $users = [];
    while ($row = $req->fetch()) {
        $user = [
            'user_id' => $row['user_id'],
            'username' => $row['username'],
            'firstname' => $row['firstname'],
            'lastname' => $row['lastname'],
            'email' => $row['email'],
            'avatar' => $row['avatar'],
            'billing_address' => $row['billing_address'],
            'delivery_address' => $row['delivery_address'],

        ];
        $users[] = $user;
    }
    return $users;
    
}



function AddUser(){

    $email = $_POST['email'];
    $lastname = htmlspecialchars($_POST['lastname']);
    $firstname = htmlspecialchars($_POST['firstname']);
    $username = htmlspecialchars($_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $billing_address = htmlspecialchars($_POST['billing_address']);
    $delivery_address = htmlentities($_POST['delivery_address']);


    $db = dbConnectUser();

    $req = $db->prepare('INSERT INTO users (
        firstname,
        lastname,
        username,
        email,
        password,
        billing_address,
        delivery_address
    ) VALUES (
        :firstname,
        :lastname,
        :username,
        :email,
        :password,
        :billing_address,
        :delivery_address
    )');


    $req->bindParam(':firstname', $firstname, PDO::PARAM_STR);
    $req->bindParam(':lastname', $lastname, PDO::PARAM_STR);
    $req->bindParam(':username', $username, PDO::PARAM_STR);
    $req->bindParam(':email', $email, PDO::PARAM_STR);
    $req->bindParam(':password', $password, PDO::PARAM_STR);
    $req->bindParam(':billing_address', $billing_address, PDO::PARAM_STR);
    $req->bindParam(':delivery_address', $delivery_address, PDO::PARAM_STR);

    $req->execute();

    $success = $req->rowCount() > 0;

    return $success;


}


function getAvatar($id){



    try {
        $db = dbConnectUser();
        $id = strval($id);
        
        $req = $db->prepare("SELECT avatar FROM users WHERE user_id = :user_id");

        $req->bindParam(':user_id', $id, PDO::PARAM_INT);
        $req->execute();

        $result = $req->fetch(PDO::FETCH_ASSOC);

        $req->closeCursor();

        return $result;
    } catch (PDOException $e) {
        throw new Exception('Erreur lors de la récupération de l\'Avatar : ' . $e->getMessage());
    }

}


function GetUser($id){ 

    try {
        $db = dbConnectUser();
        $id = strval($id);
        
        $req = $db->prepare("SELECT user_id, username, firstname, lastname, email, avatar, billing_address,delivery_address FROM users WHERE user_id = :user_id");

        $req->bindParam(':user_id', $id, PDO::PARAM_INT);
        $req->execute();

        $result = $req->fetch(PDO::FETCH_ASSOC);

        $req->closeCursor();

        return $result;
    } catch (PDOException $e) {
        throw new Exception('Erreur lors de la récupération de l\'ID : ' . $e->getMessage());
    }


}



function UpdateUser($id) {
    $email = $_POST['email'];
    $lastname = htmlspecialchars($_POST['lastname']);
    $firstname = htmlspecialchars($_POST['firstname']);
    $username = htmlspecialchars($_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $billing_address = htmlspecialchars($_POST['billing_address']);
    $delivery_address = htmlspecialchars($_POST['delivery_address']);

    $db = dbConnectUser();

    $req = $db->prepare("UPDATE users SET 
    user_id = :user_id, 
    firstname = :firstname, 
    lastname = :lastname, 
    username = :username, 
    email = :email, 
    password = :password, 
    billing_address = :billing_address, 
    delivery_address = :delivery_address 
    WHERE user_id = :user_id");

    $req->bindValue(':user_id', $id, PDO::PARAM_INT);
    $req->bindValue(':lastname', $lastname, PDO::PARAM_STR);
    $req->bindValue(':firstname', $firstname, PDO::PARAM_STR);
    $req->bindValue(':email', $email, PDO::PARAM_STR);
    $req->bindValue(':username', $username, PDO::PARAM_STR);
    $req->bindValue(':password', $password, PDO::PARAM_STR);
    $req->bindValue(':billing_address', $billing_address, PDO::PARAM_STR);
    $req->bindValue(':delivery_address', $delivery_address, PDO::PARAM_STR);

    return $req->execute();
}



function UpdateAvatar($id){


    move_uploaded_file($_FILES['avatar']['tmp_name'], '../uploads/' . basename($_FILES['avatar']['name']));
    $screenshot = '../uploads/' . basename($_FILES['avatar']['name']);


    $db = dbConnectUser();

    $req = $db->prepare("UPDATE users SET
     avatar = :avatar
    WHERE user_id = :user_id");


    $req->bindParam(':avatar', $screenshot, PDO::PARAM_STR);
    $req->bindParam(':user_id', $id, PDO::PARAM_INT); 


    return $req->execute();


}

function DeleteUser($id){
    $db = dbConnectUser();

    // Check and delete related records in user_cart table
    $deleteCartQuery = $db->prepare('DELETE FROM user_cart WHERE user_id = :user_id');
    $deleteCartQuery->bindValue(':user_id', $id, PDO::PARAM_INT);
    $deleteCartQuery->execute();

    $deleteOrdersQuery = $db->prepare('DELETE FROM orders WHERE user_id = :user_id');
    $deleteOrdersQuery->bindValue(':user_id', $id, PDO::PARAM_INT);
    $deleteOrdersQuery->execute();

    // Now, delete the user
    $deleteUserQuery = $db->prepare('DELETE FROM users WHERE user_id = :user_id');
    $deleteUserQuery->bindValue(':user_id', $id, PDO::PARAM_INT);
    $deleteUserQuery->execute();

    // Return true if both operations were successful
    return $deleteCartQuery && $deleteUserQuery;
}

function checkLogin($email){

    $db = dbConnectUser();
    $req = $db->prepare("SELECT * FROM users WHERE email = :email");
    $req->bindParam(':email', $email);
    $req->execute();
    return $req; // You need to return the query result

}

function refreshAccount($email){

    $db = dbConnectUser();
    $req = $db->prepare("SELECT * FROM users WHERE email = :email");
    $req->bindParam(':email', $email);
    $req->execute();
    return $req; // You need to return the query result

}

