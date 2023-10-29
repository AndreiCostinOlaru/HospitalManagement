<?php
session_start();
    $username = $_SESSION['username'];
    $userID= $_SESSION['userID'];
    $staffID = $_POST['staffTypeID']; // You should have an input field in the modal to select the staff to hire
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];

    $bdd = new PDO("mysql:host=localhost;dbname=hospital;charset=utf8", "root", "");
    $req = $bdd->prepare("SELECT salary FROM staff_type WHERE staffTypeID = ?;");
    $req->execute([$staffID]);
    $cost = $req->fetch()['salary'];
    $budget=$_SESSION['budget']-$cost;
    if($budget>=0){
    $_SESSION['budget']=$budget;

    $req = $bdd->prepare("UPDATE user SET budget= ? WHERE userID= ?;");
    $req->execute([$budget,$userID]);

    $req = $bdd->prepare("INSERT INTO staff (first_name, last_name, level , staffTypeID, userID) VALUES (?,?,?,?,?);");
    $req->execute([$first_name, $last_name, 0, $staffID, $userID]);
    
    header("Location: game.php");
    }
    else {
        $_SESSION["hire_failed"] = true;
        header("Location: game.php");
    } 
?>
