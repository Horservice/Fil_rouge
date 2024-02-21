<?php
//Model/db_connect.php
function dbCategory(){
    try{
        $db = new PDO ('mysql:host=localhost;dbname=fil_rouge;charset=utf8','root','');
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $db;
    } catch (PDOException $e) {
        throw new Exception('Erreur de connexion à la base de données : ' . $e->getMessage());
    }
}

function ShowCategory() {
    $db = dbCategory();
    $req = $db->query("SELECT `category_id`, `name`, `path`, `alt` FROM `categories`");
    return $req->fetchAll(PDO::FETCH_ASSOC);
}

function GetCategory($id){
    try {
        $db = dbCategory();
        $id = strval($id);
        $statement = $db->prepare("SELECT
            category_id, name, path, alt
            FROM 
            categories as c
            WHERE c.category_id = :category_id");

        $statement->bindParam(':category_id', $id, PDO::PARAM_INT);
        $statement->execute();

        $result = $statement->fetch(PDO::FETCH_ASSOC);

        $statement->closeCursor();

        return $result; 

    } catch (PDOException $e) {
        throw new Exception('Erreur lors de la récupération de l\'ID de la catégorie : ' . $e->getMessage());
    }
}