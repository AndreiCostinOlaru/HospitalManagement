<?php
session_start();
$staffID = $_POST['staff_id'];
$fireAmount = $_POST['upgrade_amount'];
$userID=$_SESSION['userID'];

$bdd = new PDO("mysql:host=localhost;dbname=hospital;charset=utf8", "root", "");
$req = $bdd->prepare("SELECT level FROM staff WHERE userID= ? AND staffID=?;");
$req->execute([$userID,$staffID]);
$level= $req->fetch()['level'];
if($level==2){
    $_SESSION["upgrade_failed"] = true; 
    header("Location:game.php");
}
else{
    $budget=$_SESSION['budget']-$fireAmount;
    $_SESSION['budget']=$budget;
    $level+=1;
    $req = $bdd->prepare("UPDATE user SET budget= ? WHERE userID= ?;");
    $req->execute([$budget,$userID]);
    $req = $bdd->prepare("UPDATE staff SET level= ? WHERE userID= ? AND staffID=?;");
    $req->execute([$level,$userID,$staffID]);
    header("Location: game.php");
}
?>