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
    $time=date('Y-m-d H:i:s', strtotime('+2 minutes', time()));

 if($roomTypeID!=0 && $diseaseName!="Cured"){
    $req = $bdd->prepare("SELECT COUNT(*) as roomsAvailable FROM room WHERE userID = ? AND roomTypeID = ? AND waitingTime < NOW();");
    $req->execute([$userID,$roomTypeID]);
    $roomsAvailable=$req->fetch()['roomsAvailable'];

    if($roomsAvailable==0){
        $_SESSION["sending_failed"] = true; 
        header("Location:game.php");
    }
    else{
        $req = $bdd->prepare("SELECT roomID FROM room WHERE roomTypeID = ?  AND waitingTime < NOW();");
        $req->execute([$roomTypeID]);
        $roomToUse=$req->fetch()['roomID'];
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
        $req = $bdd->prepare("UPDATE room SET waitingTime = ? WHERE roomID = ?;");
        $req->execute([$time,$roomToUse]);
        $req = $bdd->prepare("UPDATE patient_management SET waitingTime = ? WHERE patientID = ? AND userID = ?;");
        $req->execute([$time,$patientID,$userID]);
        header("Location: game.php");
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
    else if($roomTypeID==0 && $diseaseName!="Cured"){
        $_SESSION["sending_home_failed"] = true; 
        header("Location: game.php"); 
    }
?>
