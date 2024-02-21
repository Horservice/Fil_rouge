<?php
//controllers/login.php
// require_once('../model/login.php');


function login(){

    
    require_once('../model/db_connect.php');
    
    $db = dbConnect();
    
    
    $msg = "";
    
    if(isset($_POST['submit'])){
    
    
    
        if (!isset($_POST['username']) || empty($_POST['username'])
        || (!isset($_POST['password']) || empty($_POST['password']))){
    
            $msg="Merci de remplir les champ !";
        } else { 
    
            $username = htmlspecialchars($_POST['username']);
            $password = htmlspecialchars($_POST['password']);
                                                            
            $req = $db->prepare("SELECT * FROM admin WHERE username = :username");
            $req->bindParam(':username', $username);
            $req->execute();
    
            if ($req->rowCount() > 0 ) {    
    
                $data = $req->fetchAll();   
                echo"error ?";
                if (password_verify($password, $data[0]["password"])) {
    
                    
                    $_SESSION['lastname'] = $data[0]['lastname']; 
                    $_SESSION['firstname'] = $data[0]['firstname']; 
                    $_SESSION['avatar'] = $data[0]['avatar']; 
                    $_SESSION['role'] = $data[0]['role']; 
    
    
                    header("Location: index.php");
                    echo"teste1";
    
                } else {
                    echo"teste2";
    
    
    
                }
    
                if (!password_verify($password, $data[0]["password"])) {
    
    
                    $msg='username ou mots de passe incorrect';
    
    
                }
    
            } else {
            
                $msg='username ou mots de passe incorrect';
                
            }
        }
    }

    require_once('../view/login.php');
}