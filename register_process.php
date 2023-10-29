<?php

    $username = $_POST["username"];
    $password = $_POST["password"];
    $hospital = $_POST["hospital"];
    $budget = 1000;

    $bdd = new PDO("mysql:host=localhost;dbname=hospital;charset=utf8", "root", "");
    $req = $bdd->prepare("INSERT INTO user (username, password, hospitalName, budget) VALUES (?, ?, ?, ?);");

    if ($req->execute([ $username,$password, $hospital, $budget])) {
        header("Location: index.php"); 
    } else {
        echo "Registration failed. Please try again.";
    }
?>
