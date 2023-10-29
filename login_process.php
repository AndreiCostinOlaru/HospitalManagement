<?php
session_start();
    $username = $_POST["username"];
    $password = $_POST["password"];

    $bdd = new PDO("mysql:host=localhost;dbname=hospital;charset=utf8", "root", "");
    $req = $bdd->prepare("SELECT userID FROM user WHERE username = ? AND password = ?;");
    $req->execute([$username,$password]);
    $data = $req->fetch(); 

    if ($data) {
        $_SESSION["username"] = $username;
        $_SESSION["userID"]=$data['userID'];
        header("Location: menu.php"); 
    } else {
        $_SESSION["login_failed"] = true;
        header("Location: index.php"); 
    }

?>
