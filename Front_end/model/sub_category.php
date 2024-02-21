<?php
//Model/sub_category.php
function dbSubCategory(){
    try{
        $db = new PDO ('mysql:host=localhost;dbname=fil_rouge;charset=utf8','root','');
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $db;
    } catch (PDOException $e) {
        throw new Exception('Erreur de connexion à la base de données : ' . $e->getMessage());
    }
}


function ShowSubCategory(){
    $db = dbSubCategory();
    $req = $db->query("SELECT `sub_category_id`, `name`, `category_id` FROM `sub_categories`");
    return $req->fetchAll(PDO::FETCH_ASSOC);
}

function GetSubCategory($id){
    try {
        $db = dbSubCategory();
        $id = strval($id);
        $statement = $db->prepare("SELECT `sub_category_id`, `name`, `category_id` FROM `sub_categories` WHERE category_id = :category_id");
        $statement->bindValue(':category_id', $id, PDO::PARAM_INT);
        $statement->execute();

        $result = $statement->fetch(PDO::FETCH_ASSOC);

        return $result; 
    } catch (PDOException $e) {
        throw new Exception('Erreur lors de la récupération de l\'ID de la sous-catégorie : ' . $e->getMessage());
    }
}



function GetSubCategoryByid($id){
    try {
        $db = dbSubCategory();
        $id = strval($id);
        $statement = $db->prepare("SELECT `sub_category_id`, `name`, `category_id` FROM `sub_categories` WHERE sub_category_id = :sub_category_id");
        $statement->bindValue(':sub_category_id', $id, PDO::PARAM_INT);
        $statement->execute();

        $result = $statement->fetch(PDO::FETCH_ASSOC);

        return $result; 
    } catch (PDOException $e) {
        throw new Exception('Erreur lors de la récupération de l\'ID de la sous-catégorie : ' . $e->getMessage());
    }
}



function ShowSubCategoryById($id){
    try {
        $db = dbSubCategory();
        $id = strval($id);
        $statement = $db->prepare("SELECT `sub_category_id`, `name`, `category_id` FROM `sub_categories` WHERE category_id = :category_id");
        $statement->bindValue(':category_id', $id, PDO::PARAM_INT);
        $statement->execute();

        $result = $statement->fetch(PDO::FETCH_ASSOC);

        return $result; 
    } catch (PDOException $e) {
        throw new Exception('Erreur lors de la récupération : ' . $e->getMessage());
    }
}


function GetSubCategoriesByCategoryId($id){
    try {
        $db = dbSubCategory();
        $id = strval($id);
        $statement = $db->prepare("SELECT `sub_category_id`, `name`, `category_id` FROM `sub_categories` WHERE category_id = :category_id");
        $statement->bindValue(':category_id', $id, PDO::PARAM_INT);
        $statement->execute();

        $results = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $results;
    } catch (PDOException $e) {
        throw new Exception('Erreur lors de la récupération des sous-catégories : ' . $e->getMessage());
    }
}

