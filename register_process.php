<?php

    $username = $_POST["username"];
    $password = $_POST["password"];
    $hospital = $_POST["hospital"];

    $bdd = new PDO("mysql:host=localhost;dbname=hospital;charset=utf8", "root", "");
    $req = $bdd->prepare("INSERT INTO user (username, password, hospitalName) VALUES (?, ?, ?);");

    if ($req->execute([ $username,$password, $hospital])) {
        header("Location: index.php"); 
    } else {
        echo "Registration failed. Please try again.";
    }
?>
