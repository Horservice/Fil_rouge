<?php
//Model/Plateforms.php

function dbConnectPlateforms(){
    try{
        $db = new PDO('mysql:host=localhost;dbname=fil_rouge;charset=utf8','root','');
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $db;
    } catch (PDOException $e) {
        throw new Exception('Erreur de connexion à la base de données : ' . $e->getMessage());
    }
}

function ShowPlateforms(){
    try {
        $db = dbConnectPlateforms(); // Connexion à la base de données
        $req = $db->query("SELECT `platform_id`, `name` FROM `plateforms`");
        return $req->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        throw new Exception('Erreur lors de la récupération des plateformes : ' . $e->getMessage());
    }
}
