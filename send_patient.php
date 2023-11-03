<?php
    session_start();

    $patientID = $_POST["patientID"];
    $diseaseID= $_POST["diseaseID"];
    $roomTypeID= $_POST["sendPatientRoom"];
    $userID= $_SESSION['userID'];
    $bdd = new PDO("mysql:host=localhost;dbname=hospital;charset=utf8", "root", "");
    $req = $bdd->prepare("SELECT roomTypeID, name FROM disease WHERE diseaseID = ?;");
    $req->execute([$diseaseID]);
    $data=$req->fetch();
    $diseaseName=$data['name'];
    $roomTypeNeeded=$data['roomTypeID'];
    $req = $bdd->prepare("SELECT COUNT(*) as diseases FROM disease;");
    $req->execute([]);
    $diseases=$req->fetch()['diseases'];

 if($roomTypeID!=0 && $diseaseName!="Cured"){
    $req = $bdd->prepare("SELECT COUNT(*) as roomsAvailable FROM room WHERE userID = ? AND roomTypeID= ? AND inUse=?;");
    $req->execute([$userID,$roomTypeID,0]);
    $roomsAvailable=$req->fetch()['roomsAvailable'];

    if($roomsAvailable==0){
        $_SESSION["sending_failed"] = true; 
        header("Location:game.php");
    }
    else{
        $req = $bdd->prepare("SELECT roomID FROM room WHERE roomTypeID = ? AND inUse=?;");
        $req->execute([$roomTypeNeeded,0]);
        $roomToUse=$req->fetch()['roomID'];
        $req = $bdd->prepare("UPDATE room SET inUse = 1 WHERE roomID = ?;");
        $req->execute([$roomToUse]);
        if($roomTypeID==$roomTypeNeeded){
            if($diseaseName=="Unknown"){
               $diseaseID=rand(3,$diseases);
            }
            else{
                $diseaseID=2;//Cured
            }
            $req = $bdd->prepare("UPDATE patient_management SET diseaseID = ? WHERE patientID = ? AND userID = ?;");
            $req->execute([$diseaseID,$patientID,$userID]);
        }
        $req = $bdd->prepare("UPDATE room SET inUse = 0 WHERE roomID = ?;");
        $req->execute([$roomToUse]);
    }
}
    else if($roomTypeID==0 && $diseaseName=="Cured"){
        $req = $bdd->prepare("DELETE FROM patient_management WHERE patientID=? AND userID=?;");
        $req->execute([$patientID,$userID]);
        $req = $bdd->prepare("SELECT budget FROM user WHERE userID = ?;");
        $req->execute([$userID]);
        $budget=$req->fetch()['budget'];
        $budget += 150;
        $req = $bdd->prepare("UPDATE user SET budget=? WHERE userID = ?;");
        $req->execute([$budget,$userID]);
    }
   header("Location: game.php"); 

?>
