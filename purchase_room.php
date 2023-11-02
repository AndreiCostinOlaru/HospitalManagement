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
    $capacity = $data['capacity'];
    $req_docs = $data['num_doctors'];
    $req_nurses = $data['num_nurses'];
    $req_janitors = $data['num_janitors'];

    $rreq = $bdd->prepare("SELECT COUNT(*) AS rooms FROM room WHERE roomTypeID = ?;");
    $rreq->execute([$roomTypeID]);
    $rooms=$rreq->fetch()['rooms'];

    $rreq = $bdd->prepare("SELECT COUNT(*) AS rooms FROM room;");
    $rreq->execute([]);
    $allRooms=$rreq->fetch()['rooms'];


    $username = $_SESSION['username'];
    $breq = $bdd->prepare("SELECT budget FROM user WHERE username = ?;");
    $breq->execute([$username]);
    $budget = $breq->fetch()['budget'];

    switch($description){
        case "Consulting Room": $doc="General Practitioner"; $nurse="General Nurse Practitioner"; break;
        case "Operating Room": $doc="Surgeon"; $nurse="Operating Room Nurse";break;
        case "Delivery Room": $doc="Obstetrician"; $nurse="Obstetrical Nurse";break;
        case "Emergency Room": $doc=" Emergency Physician"; $nurse="Emergency Room Nurse";break;
        case "Isolation Room": $doc="Infectious Disease Specialist"; $nurse=" Infection Control Nurse.";break;
        case "Pediatric Room": $doc="Pediatrician"; $nurse="Pediatric Nurse";break;
        case "Psychiatric Room": $doc="Psychiatrist"; $nurse="Psychiatric Nurse";break;
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
        $dreq = $bdd->prepare("SELECT COUNT(*) AS doctor_count FROM staff WHERE userID = ? AND staffTypeID=?;");
        $dreq->execute([$_SESSION['userID'], $doctor_type]);
        $doctors = $dreq->fetch()['doctor_count'];
        $nreq = $bdd->prepare("SELECT COUNT(*) AS nurse_count FROM staff WHERE userID = ? AND staffTypeID=?;");
        $nreq->execute([$_SESSION['userID'],$nurse_type]);
        $nurses = $nreq->fetch()['nurse_count'];
        $jreq = $bdd->prepare("SELECT COUNT(*) AS janitor_count FROM staff WHERE userID = ? AND staffTypeID=?;");
        $jreq->execute([$_SESSION['userID'],$janitor]);
        $janitors = $jreq->fetch()['janitor_count'];

        if ($doctors-$req_docs>=$rooms && $nurses-$req_nurses>=$rooms && $janitors*5-$req_janitors>=$allRooms) {
            $budget = $budget - $price;

            $updateBudgetQuery = $bdd->prepare("UPDATE user SET budget = ? WHERE userID = ?;");
            $updateBudgetQuery->execute([$budget, $_SESSION['userID']]);

            $insertRoomQuery = $bdd->prepare("INSERT INTO room (roomTypeID, userID, availability) VALUES (?, ?, ?);");
            $insertRoomQuery->execute([$roomTypeID, $_SESSION['userID'], $capacity]);

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
