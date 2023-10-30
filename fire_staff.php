<?php
session_start();
$staffID = $_POST['staff_id'];
$fireAmount = $_POST['fire_amount'];
$userID=$_SESSION['userID'];

$bdd = new PDO("mysql:host=localhost;dbname=hospital;charset=utf8", "root", "");
$budget=$_SESSION['budget']+$fireAmount;
$_SESSION['budget']=$budget;
echo $budget;
$ureq = $bdd->prepare("UPDATE user SET budget= ? WHERE userID= ?;");
$ureq->execute([$budget,$userID]);
$dreq = $bdd->prepare("DELETE FROM staff WHERE staffID=?;");
$dreq->execute([$staffID]);
header("Location: game.php");
?>