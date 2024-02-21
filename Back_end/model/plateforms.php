<?php
//model/plateforms.php

function dbConnectPlateforms(){

    try{
        $db = new PDO ('mysql:host=localhost;dbname=fil_rouge;charset=utf8','root','');
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $db;
    } catch (PDOException $e) {
        throw new Exception('Erreur de connexion à la base de données : ' . $e->getMessage());
    }

}



function ShowPlateforms(){

    $db = dbConnectPlateforms();
    $req = $db->query("SELECT platform_id ,name FROM plateforms");
    $plateforms = [];
    while (($row = $req->fetch())) {
        $platefrom = [
        'platform_id' => $row['platform_id'],
        'name' => $row['name'],
        ];
        $plateforms[] = $platefrom;
        }
        return $plateforms;    
}


function SelectPlateforms(){

    $db = dbConnectPlateforms();
    $req = $db->query("SELECT platform_id ,name FROM plateforms");
    $plateforms = [];
    while (($row = $req->fetch())) {
        $platefrom = [
        'platform_id' => $row['platform_id'],
        'name' => $row['name'],
        ];
        $plateforms[] = $platefrom;
        }
        return $plateforms;    
}




function AddPlateforms(){

    $name = htmlspecialchars($_POST['name']);
    $db = dbConnectPlateforms();
    $req = $db->prepare('INSERT INTO plateforms(name) VALUES (:name)');
    $req->bindValue(':name', $name, PDO::PARAM_STR);
    $req->execute();
    $req = true;
    return $req;

}



function getPlateforms($id) {
    try {
        $db = dbConnectPlateforms();
        $id = strval($id);
        $statement = $db->prepare("SELECT platform_id, name FROM `plateforms` WHERE platform_id = :platform_id");
        $statement->bindParam(':platform_id', $id, PDO::PARAM_INT);
        $statement->execute();

        $result = $statement->fetch(PDO::FETCH_ASSOC);

        $statement->closeCursor();

        return $result;
    } catch (PDOException $e) {
        throw new Exception('Erreur lors de la récupération de l\'ID : ' . $e->getMessage());
    }
}

function UpdatePlateforms($id, $name) {
    $db = dbConnectPlateforms();
    $req = $db->prepare('UPDATE plateforms SET name = :name WHERE platform_id = :platform_id');
    $req->bindValue(':name', $name, PDO::PARAM_STR);
    $req->bindValue(':platform_id', $id, PDO::PARAM_INT);
    $success = $req->execute();
    return $success;
}


function DeletePlateforms($id){


    $id = strval($_GET['id']);

    $db = dbConnectPlateforms();    
    $req = $db->prepare('DELETE FROM plateforms WHERE platform_id = :platform_id');
    $req->bindValue(':platform_id', $id, PDO::PARAM_INT);
    $success = $req->execute();
    return $success;


}
