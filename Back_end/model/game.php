<?php
//model/game.php
function dbConnectGame(){

    try{
        $db = new PDO ('mysql:host=localhost;dbname=fil_rouge;charset=utf8','root','');
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $db;
    } catch (PDOException $e) {
        throw new Exception('Erreur de connexion à la base de données : ' . $e->getMessage());
    }

}


function ShowGame() {
    $db = dbConnectGame();

    // Sélectionnez les données de la table 'games' avec les noms correspondants
    $query = "SELECT g.game_id, g.name, p.name AS platform_name, g.price, g.description, g.genre, g.editor, g.alt, g.is_enabled, c.name AS category_name, sc.name AS sub_category_name, g.path
              FROM games g
              JOIN plateforms p ON g.platform_id = p.platform_id
              JOIN categories c ON g.category_id = c.category_id
              JOIN sub_categories sc ON g.sub_category_id = sc.sub_category_id ";

    $req = $db->query($query);
    $games = [];

    while ($row = $req->fetch()) {
        $game = [
            'game_id' => $row['game_id'],
            'name' => $row['name'],
            'platform_name' => $row['platform_name'],
            'price' => $row['price'],
            'description' => $row['description'],
            'genre' => $row['genre'],
            'editor' => $row['editor'],
            'alt' => $row['alt'],
            'is_enabled' => $row['is_enabled'],
            'category_name' => $row['category_name'],
            'sub_category_name' => $row['sub_category_name'],
            'path' => $row['path'],
        ];

        $games[] = $game;
    }

    return $games;
}

function GetGame($id) {
    try {
        $db = dbConnectGame();
        $id = strval($id);
        $statement = $db->prepare("SELECT `game_id`, `name`, `platform_id`, `price`, `description`, `genre`, `editor`, `alt`, `is_enabled`, `category_id`, `sub_category_id` , path FROM `games` WHERE game_id = :game_id");
        $statement->bindParam(':game_id', $id, PDO::PARAM_INT);
        $statement->execute();

        $result = $statement->fetch(PDO::FETCH_ASSOC);

        $statement->closeCursor();

        return $result;
    } catch (PDOException $e) {
        throw new Exception('Erreur lors de la récupération de l\'ID : ' . $e->getMessage());
    }
}

function AddGame(){
    $name = htmlspecialchars($_POST['name']);
    $genre = htmlspecialchars($_POST['genre']);
    $description = htmlspecialchars($_POST['description']);
    $is_enabled = htmlspecialchars($_POST['is_enabled']);
    $price = floatval($_POST['price']);
    $editor = htmlspecialchars($_POST['editor']);
    $category = htmlspecialchars($_POST['category_id']);
    $subcategory = htmlspecialchars($_POST['sub_category_id']);
    $alt = htmlspecialchars($_POST['alt']);
    $platform = htmlspecialchars($_POST['platform_id']);

    move_uploaded_file($_FILES['path']['tmp_name'], '../uploads/' . basename($_FILES['path']['name']));
    $screenshot = '../uploads/' . basename($_FILES['path']['name']);

    $db = dbConnectGame();

    $req = $db->prepare("INSERT INTO `games`(`name`, `platform_id`, `price`, `description`, `genre`, `editor`, `alt`, `is_enabled`, `category_id`, `sub_category_id`, `path`) VALUES 
    (:name, :platform, :price, :description, :genre, :editor, :alt, :is_enabled, :category, :subcategory, :path)");

    $req->bindParam(':name', $name, PDO::PARAM_STR);
    $req->bindParam(':platform', $platform, PDO::PARAM_INT);
    $req->bindParam(':price', $price, PDO::PARAM_STR);
    $req->bindParam(':description', $description, PDO::PARAM_STR);
    $req->bindParam(':genre', $genre, PDO::PARAM_STR);
    $req->bindParam(':editor', $editor, PDO::PARAM_STR);
    $req->bindParam(':alt', $alt, PDO::PARAM_STR);
    $req->bindParam(':is_enabled', $is_enabled, PDO::PARAM_INT);
    $req->bindParam(':category', $category, PDO::PARAM_INT);
    $req->bindParam(':subcategory', $subcategory, PDO::PARAM_INT);
    $req->bindParam(':path', $screenshot, PDO::PARAM_STR);

    $req->execute();

    $success = $req->rowCount() > 0;

    return $success;
}



function UpdateGame($id){

    $id = strval($id);
    $name = htmlspecialchars($_POST['name']);
    $genre = htmlspecialchars($_POST['genre']);
    $description = htmlspecialchars($_POST['description']);
    $is_enabled = htmlspecialchars($_POST['is_enabled']);
    $price = floatval($_POST['price']);
    $editor = htmlspecialchars($_POST['editor']);
    $category = htmlspecialchars($_POST['category_id']);
    $subcategory = htmlspecialchars($_POST['sub_category_id']);
    $alt = htmlspecialchars($_POST['alt']);
    $platform = htmlspecialchars($_POST['platform_id']);



    move_uploaded_file($_FILES['path']['tmp_name'], '../uploads/' . basename($_FILES['path']['name']));
    $screenshot = '../uploads/' . basename($_FILES['path']['name']);

    $db = dbConnectGame();


    $req = $db->prepare("UPDATE `games` SET 
    `name` = :name,
    `platform_id` = :platform,
    `price` = :price,
    `description` = :description,
    `genre` = :genre,
    `editor` = :editor,
    `alt` = :alt,
    `is_enabled` = :is_enabled,
    `category_id` = :category,
    `sub_category_id` = :subcategory,
    `path` = :path
    WHERE `game_id` = :game_id");



    $req->bindParam(':name', $name, PDO::PARAM_STR);
    $req->bindParam(':platform', $platform, PDO::PARAM_INT);
    $req->bindParam(':price', $price, PDO::PARAM_STR);
    $req->bindParam(':description', $description, PDO::PARAM_STR);
    $req->bindParam(':genre', $genre, PDO::PARAM_STR);
    $req->bindParam(':editor', $editor, PDO::PARAM_STR);
    $req->bindParam(':alt', $alt, PDO::PARAM_STR);
    $req->bindParam(':is_enabled', $is_enabled, PDO::PARAM_INT);
    $req->bindParam(':category', $category, PDO::PARAM_INT);
    $req->bindParam(':subcategory', $subcategory, PDO::PARAM_INT);
    $req->bindParam(':path', $screenshot, PDO::PARAM_STR);



    $req->bindParam(':game_id', $id, PDO::PARAM_INT);


    return $req->execute();










}


function DeleteGame($id){

    $id = strval($id);

    $db = dbConnectGame();    
    $req = $db->prepare('DELETE FROM games WHERE game_id = :game_id');
    $req->bindValue(':game_id', $id, PDO::PARAM_INT);
    $req->execute();

    $req = true;

    return $req;
    


}