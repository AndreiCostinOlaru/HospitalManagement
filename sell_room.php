<?php
session_start();
$roomID = $_POST['room_id'];
$sellAmount = $_POST['sell_amount'];
$userID=$_SESSION['userID'];

$bdd = new PDO("mysql:host=localhost;dbname=hospital;charset=utf8", "root", "");
$budget=$_SESSION['budget']+$sellAmount;
$_SESSION['budget']=$budget;
$ureq = $bdd->prepare("UPDATE user SET budget= ? WHERE userID= ?;");
$ureq->execute([$budget,$userID]);
$dreq = $bdd->prepare("DELETE FROM room WHERE roomID=?;");
$dreq->execute([$roomID]);
header("Location: game.php");
?>