<?php
//model/games.php
function dbConnectGame(){
    try{
        $db = new PDO ('mysql:host=localhost;dbname=fil_rouge;charset=utf8','root','');
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $db;
    } catch (PDOException $e) {
        throw new Exception('Erreur de connexion à la base de données : ' . $e->getMessage());
    }
}

function ShowGame(){


    $db = dbConnectGame();
    $req = $db->query("SELECT
            `game_id`, 
            `name`,
             `platform_id`,
            `price`,
             `description`,
            `genre`,
             `editor`, 
            `alt`,
             `is_enabled`,
            `category_id`, 
            `sub_category_id`, 
            `path`
            FROM `games`
            WHERE `is_enabled` = 1
            ORDER BY `game_id` DESC");
    
    $games = [];
    while (($row = $req->fetch())) {
        $game = [
            'game_id' => $row['game_id'],
            'name' => $row['name'],
            'platform_id' => $row['platform_id'],
            'price' => $row['price'],
            'description' => $row['description'],
            'genre' => $row['genre'],
            'editor' => $row['editor'],
            'alt' => $row['alt'],
            'is_enabled' => $row['is_enabled'],
            'category_id' => $row['category_id'],
            'sub_category_id' => $row['sub_category_id'],
            'path' => $row['path'],
        ];
        $games[] = $game;
    }

    return $games;



}

function ShowNewGameOnly3(){
    $db = dbConnectGame();

    $query = "SELECT g.game_id, g.name, p.name AS platform_name, g.price, g.description, g.genre, g.editor, g.alt, g.is_enabled, c.name AS category_name, sc.name AS sub_category_name, g.path
              FROM games g
              JOIN plateforms p ON g.platform_id = p.platform_id
              JOIN categories c ON g.category_id = c.category_id
              JOIN sub_categories sc ON g.sub_category_id = sc.sub_category_id
              WHERE g.is_enabled = 1
              ORDER BY g.game_id DESC
              LIMIT 3;";

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

    // var_dump($games);

    return $games;
}

function ShowGame20() {


    $db = dbConnectGame();


    $req = $db->query("SELECT g.game_id, g.name, p.name AS platform_name, g.price, g.description, g.genre, g.editor, g.alt, g.is_enabled, c.name AS category_name, sc.name AS sub_category_name, g.path
    FROM games g
    JOIN plateforms p ON g.platform_id = p.platform_id
    JOIN categories c ON g.category_id = c.category_id
    JOIN sub_categories sc ON g.sub_category_id = sc.sub_category_id
    WHERE g.is_enabled = 1
    ORDER BY g.game_id DESC 
    LIMIT 20
    OFFSET 3;");

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

function ShowGameCateogry() {


    $db = dbConnectGame();


    $req = $db->query("SELECT g.game_id, g.name, p.name AS platform_name, g.price, g.description, g.genre, g.editor, g.alt, g.is_enabled, c.name AS category_name, sc.name AS sub_category_name, g.path
    FROM games g
    JOIN plateforms p ON g.platform_id = p.platform_id
    JOIN categories c ON g.category_id = c.category_id
    JOIN sub_categories sc ON g.sub_category_id = sc.sub_category_id
    WHERE g.is_enabled = 1
    ORDER BY g.game_id DESC ");

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
        $statement = $db->prepare("SELECT 
        g.`game_id`, 
        g.`name`, 
        g.`platform_id`, 
        p.`name` AS `platform_name`, 
        g.`price`, 
        g.`description`, 
        g.`genre`, 
        g.`editor`, 
        g.`alt`, 
        g.`is_enabled`, 
        g.`category_id`, 
        c.`name` AS `category_name`,
        g.`sub_category_id`, 
        sc.`name` AS `sub_category_name`,
        g.`path` 
    FROM 
        `games` AS g
    INNER JOIN 
        `plateforms` AS p ON g.`platform_id` = p.`platform_id`
    LEFT JOIN 
        `categories` AS c ON g.`category_id` = c.`category_id`
    LEFT JOIN 
        `sub_categories` AS sc ON g.`sub_category_id` = sc.`sub_category_id`
    WHERE 
        g.`game_id` = :game_id");        
        $statement->bindParam(':game_id', $id, PDO::PARAM_INT);
        $statement->execute();

        $result = $statement->fetch(PDO::FETCH_ASSOC);

        $statement->closeCursor();

        return $result;
    } catch (PDOException $e) {
        throw new Exception('Erreur lors de la récupération de l\'ID du Jeux Video : ' . $e->getMessage());
    }
}




function GetGamesCart($ids) {
    try {
        $db = dbConnectGame();
    
        // Assuming $ids is an array of game IDs
        $game_ids = implode(',', array_fill(0, count($ids), '?'));

        $statement = $db->prepare("SELECT 
        g.`game_id`, 
        g.`name`, 
        g.`platform_id`, 
        p.`name` AS `platform_name`, 
        g.`price`, 
        g.`description`, 
        g.`genre`, 
        g.`editor`, 
        g.`alt`, 
        g.`is_enabled`, 
        g.`category_id`, 
        c.`name` AS `category_name`,
        g.`sub_category_id`, 
        sc.`name` AS `sub_category_name`,
        g.`path` 
    FROM 
        `games` AS g
    INNER JOIN 
        `plateforms` AS p ON g.`platform_id` = p.`platform_id`
    LEFT JOIN 
        `categories` AS c ON g.`category_id` = c.`category_id`
    LEFT JOIN 
        `sub_categories` AS sc ON g.`sub_category_id` = sc.`sub_category_id`
    WHERE 
        g.`game_id` IN ($game_ids) 
    ORDER BY 
        g.`name` DESC");

        // Bind each game ID in the array
        foreach ($ids as $index => $id) {
            $statement->bindValue(($index + 1), $id['game_id'], PDO::PARAM_INT);
        }

        $statement->execute();

        $result = $statement->fetchAll(PDO::FETCH_ASSOC);

        $statement->closeCursor();

        return $result;
    } catch (PDOException $e) {
        throw new Exception('Erreur lors de la récupération de l\'ID du Jeux Video pour le panier: ' . $e->getMessage());
    }
}

// function GetGamesByIdByCategory($id) {
//     $db = dbConnectGame();
//     $id = strval($id);

//     $statement = $db->prepare("SELECT g.`game_id`, g.`name`, p.`name` AS platform_name, g.`price`, g.`description`, g.`genre`, g.`editor`, g.`alt`, g.`is_enabled`, g.`category_id`, g.`sub_category_id`, sc.`name` AS sub_category_name, g.`path`
//                                FROM `games` g
//                                INNER JOIN `plateforms` p ON g.`platform_id` = p.`platform_id`
//                                INNER JOIN `sub_categories` sc ON g.`sub_category_id` = sc.`sub_category_id`
//                                WHERE g.`category_id` = :category_id ORDER BY game_id DESC LIMIT 20" );

//     $statement->bindParam(':category_id', $id, PDO::PARAM_INT);

//     $statement->execute();

//     $result = $statement->fetchAll(PDO::FETCH_ASSOC);

//     $statement->closeCursor();

//     return $result;
// }



function GetGamesByIdByCategory($id, $limit = 20, $offset = 0) {
    $db = dbConnectGame();
    $id = strval($id);

    $statement = $db->prepare("SELECT g.`game_id`, g.`name`, p.`name` AS platform_name, g.`price`, g.`description`, g.`genre`, g.`editor`, g.`alt`, g.`is_enabled`, g.`category_id`, g.`sub_category_id`, sc.`name` AS sub_category_name, g.`path`
                               FROM `games` g
                               INNER JOIN `plateforms` p ON g.`platform_id` = p.`platform_id`
                               INNER JOIN `sub_categories` sc ON g.`sub_category_id` = sc.`sub_category_id`
                               WHERE g.`category_id` = :category_id AND g.`is_enabled` = 1 ORDER BY game_id DESC LIMIT :limit OFFSET :offset");

    $statement->bindParam(':category_id', $id, PDO::PARAM_INT);
    $statement->bindParam(':limit', $limit, PDO::PARAM_INT);
    $statement->bindParam(':offset', $offset, PDO::PARAM_INT);

    $statement->execute();

    $result = $statement->fetchAll(PDO::FETCH_ASSOC);

    $statement->closeCursor();

    return $result;
}






function GetGamesByIdBySubCategory($id_category, $limit = 20, $offset = 0){


    $db = dbConnectGame();
    $id = strval($id_category);

    $statement = $db->prepare("SELECT g.`game_id`, g.`name`, p.`name` AS platform_name, g.`price`, g.`description`, g.`genre`, g.`editor`, g.`alt`, g.`is_enabled`, g.`category_id`, g.`sub_category_id`, sc.`name` AS sub_category_name, g.`path`
                               FROM `games` g
                               INNER JOIN `plateforms` p ON g.`platform_id` = p.`platform_id`
                               INNER JOIN `sub_categories` sc ON g.`sub_category_id` = sc.`sub_category_id`
                               WHERE g.`sub_category_id` = :sub_category_id AND g.`is_enabled` = 1 ORDER BY game_id DESC LIMIT :limit OFFSET :offset" );

    $statement->bindParam(':sub_category_id', $id, PDO::PARAM_INT);
    $statement->bindParam(':limit', $limit, PDO::PARAM_INT);
    $statement->bindParam(':offset', $offset, PDO::PARAM_INT);


    $statement->execute();

    $result = $statement->fetchAll(PDO::FETCH_ASSOC);

    $statement->closeCursor();

    return $result;

}

//controllers/search.php
////L'original
// function EmptyQuery(){


//     $db = dbConnectGame();

//     $query = "SELECT g.game_id, g.name, p.name AS platform_name, g.price, g.description, g.genre, g.editor, g.alt, g.is_enabled, c.name AS category_name, sc.name AS sub_category_name, g.path
//               FROM games g
//               JOIN plateforms p ON g.platform_id = p.platform_id
//               JOIN categories c ON g.category_id = c.category_id
//               JOIN sub_categories sc ON g.sub_category_id = sc.sub_category_id
//               WHERE g.is_enabled = 1
//               ORDER BY g.game_id DESC;";

//     $req = $db->query($query);
//     $games = [];

//     while ($row = $req->fetch()) {
//         $game = [
//             'game_id' => $row['game_id'],
//             'name' => $row['name'],
//             'platform_name' => $row['platform_name'],
//             'price' => $row['price'],
//             'description' => $row['description'],
//             'genre' => $row['genre'],
//             'editor' => $row['editor'],
//             'alt' => $row['alt'],
//             'is_enabled' => $row['is_enabled'],
//             'category_name' => $row['category_name'],
//             'sub_category_name' => $row['sub_category_name'],
//             'path' => $row['path'],
//         ];

//         $games[] = $game;
//     }

//     // var_dump($games);

//     return $games;


// }

// controllers/search.php
function EmptyQuery($category, $sub_category, $plateforme, $price) {
    $db = dbConnectGame();

    $query = "SELECT g.game_id, g.name, p.name AS platform_name, g.price, g.description, g.genre, g.editor, g.alt, g.is_enabled, c.name AS category_name, sc.name AS sub_category_name, g.path
              FROM games g
              JOIN plateforms p ON g.platform_id = p.platform_id
              JOIN categories c ON g.category_id = c.category_id
              JOIN sub_categories sc ON g.sub_category_id = sc.sub_category_id
              WHERE g.is_enabled = 1";

    // Ajouter des conditions en fonction des paramètres non vides
    $conditions = [];

    if (!empty($category)) {
        $conditions[] = "g.category_id = :category";
    }
    
    if (!empty($sub_category)) {
        $conditions[] = "g.sub_category_id = :sub_category";
    }
    
    if (!empty($plateforme)) {
        $conditions[] = "g.platform_id = :platform";
    }    

    if (!empty($price)) { //remeetre en g.price >= :price ?
        $conditions[] = "g.price <= :price";
    }

    // Concaténer les conditions
    if (!empty($conditions)) {
        $query .= " AND " . implode(" AND ", $conditions);
    }

    // Ajouter l'ordre par nom de jeu
    $query .= " ORDER BY g.game_id DESC";

    // Préparer la requête
    $statement = $db->prepare($query);

    // Binder les valeurs des paramètres non vides
    if (!empty($category)) {
        $statement->bindValue(":category", $category);
    }

    if (!empty($sub_category)) {
        $statement->bindValue(":sub_category", $sub_category);
    }

    if (!empty($plateforme)) {
        $statement->bindValue(":platform", $plateforme);
    }

    if (!empty($price)) {
        $statement->bindValue(":price", $price);
    }

    // Exécuter la requête
    $statement->execute();

    // Récupérer les résultats
    $games = $statement->fetchAll(PDO::FETCH_ASSOC);

    return $games;
}






//controllers/search

function SearchNameGame($query, $category, $sub_category, $plateforme, $price) {
    $db = dbConnectGame();

    $q = '%' . $query . '%';

    $sql = 'SELECT g.game_id, g.name, p.name AS platform_name, g.price, g.description, g.genre, g.editor, g.alt, g.is_enabled, c.name AS category_name, sc.name AS sub_category_name, g.path
            FROM games g
            JOIN `plateforms` p ON g.`platform_id` = p.`platform_id`
            JOIN categories c ON g.category_id = c.category_id
            JOIN sub_categories sc ON g.sub_category_id = sc.sub_category_id
            WHERE g.is_enabled = 1';

    $conditions = [];

    if (!empty($category)) {
        $conditions[] = "g.category_id = :category";
    }
    
    if (!empty($sub_category)) {
        $conditions[] = "g.sub_category_id = :sub_category";
    }
    
    if (!empty($plateforme)) {
        $conditions[] = "g.platform_id = :platform";
    }

    if (!empty($price)) {
        $conditions[] = "g.price <= :price";
    }

    if (!empty($query)) {
        $conditions[] = "g.name LIKE :query";
    }

    if (!empty($conditions)) {
        $sql .= " AND " . implode(" AND ", $conditions);
    }

    $sql .= " ORDER BY g.name";

    $statement = $db->prepare($sql);

    if (!empty($category)) {
        $statement->bindValue(":category", $category);
    }

    if (!empty($sub_category)) {
        $statement->bindValue(":sub_category", $sub_category);
    }

    if (!empty($plateforme)) {
        $statement->bindValue(":platform", $plateforme);
    }

    if (!empty($price)) {
        $statement->bindValue(":price", $price);
    }

    if (!empty($query)) {
        $statement->bindParam(':query', $q, PDO::PARAM_STR);
    }

    $statement->execute();

    $games = $statement->fetchAll(PDO::FETCH_ASSOC);

    return $games;
}


//ancien function searchname
// function SearchNameGame($query) {
//     $db = dbConnectGame();

//     // Utilisation de prepared statements pour éviter les attaques par injection SQL
//     $q = '%' . $query . '%';

//     $statement = $db->prepare('SELECT g.game_id, g.name, p.name AS platform_name, g.price, g.description, g.genre, g.editor, g.alt, g.is_enabled, c.name AS category_name, sc.name AS sub_category_name, g.path
//                                FROM games g
//                                JOIN `plateforms` p ON g.`platform_id` = p.`platform_id`
//                                JOIN categories c ON g.category_id = c.category_id
//                                JOIN sub_categories sc ON g.sub_category_id = sc.sub_category_id
//                                WHERE g.is_enabled = 1 AND g.name LIKE :query
//                                ORDER BY g.game_id DESC');

//     $statement->bindParam(':query', $q, PDO::PARAM_STR); // Lier le paramètre de recherche

//     $statement->execute();

//     $games = $statement->fetchAll(PDO::FETCH_ASSOC);

//     return $games;
// }






