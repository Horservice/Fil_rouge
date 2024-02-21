<?php
//model/categories.php
function dbConnectCategories(){

    try{
        $db = new PDO ('mysql:host=localhost;dbname=fil_rouge;charset=utf8','root','');
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $db;
    } catch (PDOException $e) {
        throw new Exception('Erreur de connexion à la base de données : ' . $e->getMessage());
    }

}



function ShowCategorie() {
    $db = dbConnectCategories();
    $req = $db->query("SELECT `category_id`, `name`, `path`, `alt` FROM `categories`");
    $categories = [];
    while ($row = $req->fetch()) {
        $categorie = [
            'category_id' => $row['category_id'],
            'name' => $row['name'],
            'path' => $row['path'],
            'alt' => $row['alt']
        ];
        $categories[] = $categorie;
    }
    return $categories;
}


function SelectCategorie() {
    $db = dbConnectCategories();
    $req = $db->query("SELECT `category_id`, `name`, `path`, `alt` FROM `categories`");
    $categories = [];
    while ($row = $req->fetch()) {
        $categorie = [
            'category_id' => $row['category_id'],
            'name' => $row['name'],
            'path' => $row['path'],
            'alt' => $row['alt']
        ];
        $categories[] = $categorie;
    }
    return $categories;
}



     

function getCategories($id){


    try {
        $db = dbConnectCategories();
        $id = strval($id);
        
        $statement = $db->prepare("SELECT `category_id`, `name`, `path`, `alt` FROM `categories` WHERE  category_id = :category_id");

        $statement->bindParam(':category_id', $id, PDO::PARAM_INT);
        $statement->execute();

        $result = $statement->fetch(PDO::FETCH_ASSOC);

        $statement->closeCursor();

        return $result;
    } catch (PDOException $e) {
        throw new Exception('Erreur lors de la récupération de  ID : ' . $e->getMessage());
    }


}


function AddCategorie(){


    $name = htmlspecialchars($_POST['name']);
    $alt = htmlspecialchars($_POST['alt']);



    move_uploaded_file($_FILES['path']['tmp_name'], '../uploads/' . basename($_FILES['path']['name']));
    $screenshot = '../uploads/' . basename($_FILES['path']['name']);


    $db = dbConnectCategories();

    $req = $db->prepare('INSERT INTO `categories` (`name`, `path`, `alt`) VALUES (:name, :path, :alt)');

    $req->bindParam(':name', $name, PDO::PARAM_STR);
    $req->bindParam(':alt', $alt, PDO::PARAM_STR);
    $req->bindParam(':path', $screenshot, PDO::PARAM_STR);

    $req->execute();

    $success = $req->rowCount() > 0;

    return $success;




}



function UpdateCategorie($id){


    $id = strval($_GET['id']);


    $name = htmlspecialchars($_POST['name']);
    $alt = htmlspecialchars($_POST['alt']);

    move_uploaded_file($_FILES['path']['tmp_name'], '../uploads/' . basename($_FILES['path']['name']));
    $screenshot = '../uploads/' . basename($_FILES['path']['name']);


    $db = dbConnectCategories();
    $req = $db->prepare('UPDATE `categories` SET `category_id`=:category_id, `name`=:name, `path`=:path, `alt`=:alt WHERE category_id = :category_id');

    $req->bindParam(':category_id', $id, PDO::PARAM_INT);
    $req->bindParam(':name', $name, PDO::PARAM_STR);
    $req->bindParam(':alt', $alt, PDO::PARAM_STR);
    $req->bindParam(':path', $screenshot, PDO::PARAM_STR);

    return $req->execute();

}


function DeleteCategorie($id){

    
    $db = dbConnectCategories();    
    $req = $db->prepare('DELETE FROM categories WHERE category_id = :category_id');
    $req->bindValue(':category_id', $id, PDO::PARAM_INT);
    $req->execute();

    $req = true;

    return $req;
    

}