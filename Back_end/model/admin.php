<?php
//model/admin.php

function dbConnectAdmin(){

    try{
        $db = new PDO ('mysql:host=localhost;dbname=fil_rouge;charset=utf8','root','');
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $db;
    } catch (PDOException $e) {
        throw new Exception('Erreur de connexion à la base de données : ' . $e->getMessage());
    }

}


function ShowAdmin(){
    $db = dbConnectAdmin();
    $req = $db->query("SELECT admin_id, username, firstname, lastname, email, avatar FROM admin");
    $admins = [];
    while ($row = $req->fetch()) {
        $admin = [
            'admin_id' => $row['admin_id'],
            'username' => $row['username'],
            'firstname' => $row['firstname'],
            'lastname' => $row['lastname'],
            'email' => $row['email'],
            'avatar' => $row['avatar'],

        ];
        $admins[] = $admin;
    }
    return $admins;
}
     

function getAdmin($id){



    try {
        $db = dbConnectAdmin();
        $id = strval($id);
        
        $statement = $db->prepare("SELECT admin_id, username, firstname, lastname, email, avatar FROM admin WHERE admin_id = :admin_id");

        $statement->bindParam(':admin_id', $id, PDO::PARAM_INT);
        $statement->execute();

        $result = $statement->fetch(PDO::FETCH_ASSOC);

        $statement->closeCursor();

        return $result;
    } catch (PDOException $e) {
        throw new Exception('Erreur lors de la récupération de la compétence back-end par ID : ' . $e->getMessage());
    }


}


function AddAdmin(){
    $email = $_POST['email'];
    $lastname = htmlspecialchars($_POST['lastname']);
    $firstname = htmlspecialchars($_POST['firstname']);
    $username = htmlspecialchars($_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    move_uploaded_file($_FILES['avatar']['tmp_name'], '../uploads/' . basename($_FILES['avatar']['name']));
    $screenshot = '../uploads/' . basename($_FILES['avatar']['name']);

    $db = dbConnectAdmin();
    $req = $db->prepare('INSERT INTO admin(firstname, lastname, username, email, password, avatar) VALUES (:firstname, :lastname, :username, :email, :password, :avatar)');
    $req->bindParam(':firstname', $firstname, PDO::PARAM_STR);
    $req->bindParam(':lastname', $lastname, PDO::PARAM_STR);
    $req->bindParam(':username', $username, PDO::PARAM_STR);
    $req->bindParam(':avatar', $screenshot, PDO::PARAM_STR);
    $req->bindParam(':email', $email, PDO::PARAM_STR);
    $req->bindParam(':password', $password, PDO::PARAM_STR);
    $req->execute();

    $success = $req->rowCount() > 0;

    return $success;
}





function UpdateAdmin($id){

    
    $id = strval($_GET['id']);

    $email = $_POST['email'];
    $lastname = htmlspecialchars($_POST['lastname']);
    $firstname = htmlspecialchars($_POST['firstname']);
    $username = htmlspecialchars($_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);


    move_uploaded_file($_FILES['avatar']['tmp_name'], '../uploads/' . basename($_FILES['avatar']['name']));
    $screenshot = '../uploads/' . basename($_FILES['avatar']['name']);

    $db = dbConnectAdmin();

    $stmt = $db->prepare("UPDATE admin SET lastname = :lastname, firstname = :firstname, email = :email, username = :username, avatar = :avatar WHERE admin_id = :admin_id");
    $stmt->bindValue(':admin_id', $id, PDO::PARAM_INT);
    $stmt->bindValue(':lastname', $lastname, PDO::PARAM_STR);
    $stmt->bindValue(':firstname', $firstname, PDO::PARAM_STR);
    $stmt->bindValue(':email', $email, PDO::PARAM_STR);
    $stmt->bindValue(':username', $username, PDO::PARAM_STR);
    $stmt->bindValue(':avatar', $screenshot, PDO::PARAM_STR);


    return $stmt->execute();

        
}



function DeleteAdmin($id){
    
    $db = dbConnectAdmin();    
    $req = $db->prepare('DELETE FROM admin WHERE admin_id = :admin_id');
    $req->bindValue(':admin_id', $id, PDO::PARAM_INT);
    $req->execute();

    $req = true;

    return $req;
    

}