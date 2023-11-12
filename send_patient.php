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
        $req = $bdd->prepare("SELECT roomID FROM room WHERE roomTypeID = ? AND userID = ?  AND waitingTime < NOW();");
        $req->execute([$roomTypeID, $userID]);
        $roomToUse=$req->fetch()['roomID'];
        if($roomTypeID==$roomTypeNeeded){
            if($diseaseName=="Unknown"){
               $diseaseID=rand(3,$diseases);
            }
            else if($diseaseName=="Appendicitis" || $diseaseName=="Benign Tumor" || $diseaseName=="Crohns Disease" || $diseaseName=="Kidney Stones"){
                $aux1=rand(1,100);
                if($aux1<=20){
                    $diseaseID=16;
                }
                else{
                    $aux2=rand(1,100);
                    if($aux2<=20){
                        $diseaseID=12;
                    }
                    else{
                        $diseaseID=2;
                    }
                }
            }
            else if($diseaseName=="Suspecting Kidney Infection" || $diseaseName=="Suspecting Kidney Stones"){
                $aux=rand(1,100);
                if($aux<=50){
                    $diseaseID=23;
                }
                else{
                    $diseaseID=24;
                }
            }
            else if($diseaseName=="Suspecting Gastrointestinal Condition"){
                $aux=rand(1,100);
                if($aux<=75){
                    $diseaseID=22;
                }
                else{
                    $diseaseID=2;
                }
            }
            else if($diseaseName=="Suspecting Crohns Disease"){
                $aux=rand(1,100);
                if($aux<=75){
                    $diseaseID=21;
                }
                else{
                    $diseaseID=22;
                }
            }
            else if($diseaseName=="Suspecting Bone Fracture"){
                $aux=rand(1,100);
                if($aux<=75){
                    $diseaseID=11;
                }
                else{
                    $diseaseID=2;
                }
            }
            else if($diseaseName=="Suspecting Tumor"){
                $aux=rand(1,100);
                if($aux<=50){
                    $diseaseID=4;
                }
                else if($aux>50 && $aux<80){
                    $diseaseID=24;
                }
                else{
                    $diseaseID=2;
                }
            }
            else if($diseaseName=="Trauma"){
                $aux=rand(1,100);
                if($aux<=75){
                    $diseaseID=2;
                }
                else{
                    $diseaseID=9;
                }
            }
            else{
                $diseaseID=2;//Cured
            }
            $req = $bdd->prepare("UPDATE patient_management SET diseaseID = ? WHERE patientID = ? AND userID = ?;");
            $req->execute([$diseaseID,$patientID,$userID]);
        }
        else{
            $_SESSION["send_wrong_room"] = true;
            $req = $bdd->prepare("SELECT * FROM user WHERE userID = ?;");
            $req->execute([$userID]);
            $data=$req->fetch();
            $budget=$data['budget'];
            $mistakes=$data['mistakes'];
            $budget -= 50;
            $mistakes += 1;
            $req = $bdd->prepare("UPDATE user SET budget=?, mistakes=? WHERE userID = ?;");
            $req->execute([$budget,$mistakes,$userID]);
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
        $req = $bdd->prepare("SELECT * FROM user WHERE userID = ?;");
        $req->execute([$userID]);
        $data=$req->fetch();
        $budget=$data['budget'];
        $patients_cured=$data['patients_cured'];
        $budget += 300;
        $patients_cured+=1;
        $req = $bdd->prepare("UPDATE user SET budget=?, patients_cured=? WHERE userID = ?;");
        $req->execute([$budget,$patients_cured,$userID]);
    }
    else if($roomTypeID==0 && $diseaseName!="Cured"){
        $_SESSION["sending_home_failed"] = true; 
    }
    header("Location: game.php"); 
?>
