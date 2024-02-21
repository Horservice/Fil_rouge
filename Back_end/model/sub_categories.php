<?php
//model/sub_categories.php
function dbConnectSubCategories(){

    try{
        $db = new PDO ('mysql:host=localhost;dbname=fil_rouge;charset=utf8','root','');
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $db;
    } catch (PDOException $e) {
        throw new Exception('Erreur de connexion à la base de données : ' . $e->getMessage());
    }

}
function ShowSubCategorie() {
    $db = dbConnectSubCategories();
    $query = "SELECT sc.sub_category_id, sc.category_id, sc.name AS sub_category_name,  c.name AS category_name
              FROM sub_categories sc
              INNER JOIN categories c ON sc.category_id = c.category_id";

    $req = $db->query($query);

    $Subcategories = [];
    while ($row = $req->fetch()) {
        $Subcategorie = [
            'sub_category_id' => $row['sub_category_id'],
            'category_id' => $row['category_id'],
            'name' => $row['sub_category_name'],

            'category_name' => $row['category_name']
        ];
        $Subcategories[] = $Subcategorie;
    }
    return $Subcategories;
}

function SelectSubCategorie() {
    $db = dbConnectSubCategories();
    $req = $db->query("SELECT `sub_category_id`, `name`, category_id  FROM `sub_categories`");
    $Subcategories = [];
    while ($row = $req->fetch()) {
        $Subcategorie = [
            'sub_category_id' => $row['sub_category_id'],
            'category_id' => $row['category_id'],
            'name' => $row['name'],

            'category_id' => $row['category_id']
        ];
        $Subcategories[] = $Subcategorie;
    }
    return $Subcategories;
}






function getSubCategories($id){


    try {
        $db = dbConnectSubCategories();
        $id = strval($id);
        
        $statement = $db->prepare("SELECT `sub_category_id`, `name`, category_id  FROM `sub_categories` WHERE  sub_category_id = :sub_category_id");

        $statement->bindParam(':sub_category_id', $id, PDO::PARAM_INT);
        $statement->execute();

        $result = $statement->fetch(PDO::FETCH_ASSOC);

        $statement->closeCursor();

        return $result;
    } catch (PDOException $e) {
        throw new Exception('Erreur lors de la récupération de  ID : ' . $e->getMessage());
    }


}


function AddSubCategorie(){
    $name = htmlspecialchars($_POST['name']);
    $category = htmlspecialchars($_POST['category_id']);

    // Vérifier si le nom de la sous-catégorie existe déjà
    $existingSubCategory = CheckExistingSubCategory($name);

    if ($existingSubCategory) {
        return false; // Le nom de la sous-catégorie existe déjà, retourner false
    }

    $db = dbConnectSubCategories();

    $req = $db->prepare('INSERT INTO `sub_categories`(`name`,  `category_id`) VALUES (:name, :category_id)');

    $req->bindParam(':name', $name, PDO::PARAM_STR);
    $req->bindParam(':category_id', $category, PDO::PARAM_STR);
    $req->execute();

    $success = $req->rowCount() > 0;

    return $success;
}

function CheckExistingSubCategory($subCategoryName) {
    try {
        $db = dbConnectSubCategories();
        $statement = $db->prepare("SELECT COUNT(*) as count FROM `sub_categories` WHERE `name` = :name");
        $statement->bindParam(':name', $subCategoryName, PDO::PARAM_STR);
        $statement->execute();

        $result = $statement->fetch(PDO::FETCH_ASSOC);

        return $result['count'] > 0;
    } catch (PDOException $e) {
        throw new Exception('Erreur lors de la vérification de l\'existence de la sous-catégorie : ' . $e->getMessage());
    }
}


function UpdateSubCategorie($id) {
    $id = strval($_GET['id']);

    $name = htmlspecialchars($_POST['name']);
    $category = htmlspecialchars($_POST['category_id']);



    $db = dbConnectSubCategories();

    $req = $db->prepare("UPDATE `sub_categories` SET `name`=:name,  `category_id`=:category_id WHERE sub_category_id = :sub_category_id");

    $req->bindValue(':name', $name, PDO::PARAM_STR);
    $req->bindValue(':category_id', $category, PDO::PARAM_STR);
    $req->bindValue(':sub_category_id', $id, PDO::PARAM_INT); // Ajout de cette ligne pour lier le paramètre :sub_category_id

    $success = $req->execute();

    return $success;
}

function DeleteSubCategorie($id){




    $db = dbConnectSubCategories();    
    $req = $db->prepare('DELETE FROM sub_categories WHERE sub_category_id = :sub_category_id');
    $req->bindValue(':sub_category_id', $id, PDO::PARAM_INT);
    $req->execute();

    $req = true;

    return $req;
    


    
}

