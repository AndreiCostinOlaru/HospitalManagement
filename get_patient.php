<?php
    session_start();
    $bdd = new PDO("mysql:host=localhost;dbname=hospital;charset=utf8", "root", "");
    $nreq = $bdd->prepare("SELECT COUNT(*) FROM patient WHERE userID=? AND atHospital=0;");
    $nreq->execute([$_SESSION['userID']]);
    $ndata = $nreq->fetchColumn();
    if($ndata==0){
        echo '<script>alert("There are no more patients.");</script>';
    }
    else {
    $randomNumber = rand(1, $ndata);
    $req = $bdd->prepare("SELECT * FROM patient WHERE userID=? AND atHospital=0;");
    $req->execute([$_SESSION['userID']]);
    for ($i = 1; $i <= $randomNumber; $i++) {
    $data = $req->fetch();
    }
    $currentDateTime = date("Y-m-d H:i:s");
    $req = $bdd->prepare("UPDATE patient SET atHospital=1, atHospitalTime=?  WHERE patientID=? AND atHospital=0;");
    $req->execute([$currentDateTime, $data['patientID']]);
    }
    header('Location: game.php');
?>