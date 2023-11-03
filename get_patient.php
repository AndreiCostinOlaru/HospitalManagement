<?php
    session_start();
    $bdd = new PDO("mysql:host=localhost;dbname=hospital;charset=utf8", "root", "");
    $nreq = $bdd->prepare("SELECT COUNT(*) as patients FROM patient_management WHERE userID=?;");
    $nreq->execute([$_SESSION['userID']]);
    $ndata = $nreq->fetch()['patients'];

    
    $nreq = $bdd->prepare("SELECT COUNT(*) as patients FROM patient;");
    $nreq->execute([]);
    $pdata = $nreq->fetch()['patients'];

    if($ndata==$pdata){
        $_SESSION["patient_failed"] = true; 
        header("Location:game.php");
    }
    else {
        $randomPatient = rand(1, $pdata);
        $disease=1;
        $req = $bdd->prepare("SELECT COUNT(*) as patients FROM patient_management WHERE userID=? AND patientID=?;");
        $req->execute([$_SESSION['userID'],$randomPatient]);
        $data = $req->fetch()['patients'];
        if($data==0){
            $currentDateTime = date("Y-m-d H:i:s");
            $req = $bdd->prepare("INSERT INTO patient_management (patientID, userID, diseaseID) VALUES (?,?,?);");
            $req->execute([$randomPatient,$_SESSION['userID'],$disease]);
            }
        else{
            header('Location: get_patient.php');
        }
}
   header('Location: game.php');

?>