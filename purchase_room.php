<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $roomTypeID = $_POST["roomTypeID"];
    
    $bdd = new PDO("mysql:host=localhost;dbname=hospital;charset=utf8", "root", "");

    $req = $bdd->prepare("SELECT * FROM room_type WHERE roomTypeID = ?;");
    $req->execute([$roomTypeID]);
    $data=$req->fetch();
    $price = $data['price'];
    $description=$data['description'];
    $req_docs = $data['num_doctors'];
    $req_nurses = $data['num_nurses'];
    $req_janitors = $data['num_janitors'];

    $rreq = $bdd->prepare("SELECT COUNT(*) AS rooms FROM room WHERE roomTypeID = ? AND userID=?;");
    $rreq->execute([$roomTypeID,$_SESSION['userID']]);
    $rooms=$rreq->fetch()['rooms'];

    $rreq = $bdd->prepare("SELECT COUNT(*) AS rooms FROM room WHERE userID=?;");
    $rreq->execute([$_SESSION['userID']]);
    $allRooms=$rreq->fetch()['rooms'];


    $username = $_SESSION['username'];
    $breq = $bdd->prepare("SELECT budget FROM user WHERE username = ?;");
    $breq->execute([$username]);
    $budget = $breq->fetch()['budget'];

    switch($description){
        case "Consulting Room": $doc="General Practitioner"; $nurse="General Nurse Practitioner"; break;
        case "Operating Room": $doc="Surgeon"; $nurse="Operating Room Nurse";break;
        case "Radiology Room": $doc="Radiologist"; $nurse="Radiology Nurse";break;
        case "Isolation Room": $doc="Infectious Disease Specialist"; $nurse="Infection Control Nurse";break;
        case "Psychiatric Room": $doc="Psychiatrist"; $nurse="Psychiatric Nurse";break;
        case "Physiotherapy Room": $doc="Physiotherapist"; $nurse="General Nurse Practitioner";break;
        case "Neurology Room": $doc="Neurologist"; $nurse="Neurology Nurse";break;
        case "ICU Room": $doc="Intensivist"; $nurse="Intensive Care Nurse";break;
        case "Endoscopy Room": $doc="Endoscopist"; $nurse="Endoscopy Nurse";break;
        case "Ultrasound Room": $doc="Ultrasound Technician"; $nurse="Ultrasound Nurse";break;
        case "Pharmacy Room": $doc="General Practitioner"; $nurse="Pharmacy Nurse";break;
    }
    $janitor= "Janitor";
    $req = $bdd->prepare("SELECT staffTypeID FROM staff_type WHERE description = ?;");
    $req->execute([$doc]);
    $doctor_type=$req->fetch()['staffTypeID'];
    $req = $bdd->prepare("SELECT staffTypeID FROM staff_type WHERE description = ?;");
    $req->execute([$nurse]);
    $nurse_type=$req->fetch()['staffTypeID'];
    $req = $bdd->prepare("SELECT staffTypeID FROM staff_type WHERE description = ?;");
    $req->execute([$janitor]);
    $janitor=$req->fetch()['staffTypeID'];
    if ($budget >= $price) {
        $dreq = $bdd->prepare("SELECT COUNT(*) AS doctor_count, SUM(level) as doctor_level FROM staff WHERE userID = ? AND staffTypeID=?;");
        $dreq->execute([$_SESSION['userID'], $doctor_type]);
        $doctorsData = $dreq->fetch();
        $doctors=$doctorsData['doctor_count'];
        $levelDoc=$doctorsData['doctor_level'];
        $nreq = $bdd->prepare("SELECT COUNT(*) AS nurse_count, SUM(level) as nurse_level FROM staff WHERE userID = ? AND staffTypeID=?;");
        $nreq->execute([$_SESSION['userID'],$nurse_type]);
        $nurseData = $nreq->fetch();
        $nurses=$nurseData['nurse_count'];
        $levelNurse=$nurseData['nurse_level'];
        $jreq = $bdd->prepare("SELECT COUNT(*) AS janitor_count, SUM(level) as janitor_level FROM staff WHERE userID = ? AND staffTypeID=?;");
        $jreq->execute([$_SESSION['userID'],$janitor]);
        $janitorData = $jreq->fetch();
        $janitors=$janitorData['janitor_count'];
        $levelJanitor=$janitorData['janitor_level'];
    
        if ($doctors-$req_docs+$levelDoc>=$rooms && $nurses-$req_nurses+$levelNurse>=$rooms && $janitors*5-$req_janitors+$levelJanitor>=$allRooms) {
            $budget = $budget - $price;

            $updateBudgetQuery = $bdd->prepare("UPDATE user SET budget = ? WHERE userID = ?;");
            $updateBudgetQuery->execute([$budget, $_SESSION['userID']]);

            $insertRoomQuery = $bdd->prepare("INSERT INTO room (roomTypeID, userID) VALUES (?, ?);");
            $insertRoomQuery->execute([$roomTypeID, $_SESSION['userID']]);

            header("Location: game.php"); 
        } else {
            $_SESSION["purchase_failed"] = true;
            header("Location: game.php"); 
        }
    } else {
        $_SESSION["purchase_failed"] = true;
        header("Location: game.php"); 
    }
}
?>
