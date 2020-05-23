<?php

// if there is not existing user start to save user information 
if(!isset($_SESSION)){
    
    session_start();
}

// error messages
$login_error="";

// connect to db
try {
    $db = new PDO("mysql:host=localhost;dbname=emu_register", "root", "");
    // set the PDO error mode to exception
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    //echo "Connected successfully";
    }
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }

// login control
if(isset($_POST['login_button'])){
    $user_id= $_POST['user_id'];
    $password= $_POST['password'];
    
    //print_r($_POST);
    $register= $db->prepare("SELECT * FROM users WHERE user_id=:user_id and password=:password");
    $register->execute(array('user_id'=>$user_id,'password'=>$password));
    $mission=$register->fetch(PDO::FETCH_ASSOC);
        if($user_id==$mission['user_id'] AND $password==$mission['password']){
            $_SESSION["user_id"] = $mission["user_id"];
            header('Location:index.php');
        }
        else
        {
             $login_error="Incorrect ID or Password";
        }
    
   }





?>
