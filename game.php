<!DOCTYPE html>
<html>
<head>
    <title>Game</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="game.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Baloo&display=swap" rel="stylesheet">
</head>
<script>
    function setStaffId(staffId, salary) {
        document.getElementById("staffIdInput").value = staffId;
        document.getElementById("fireAmount").innerHTML = salary/2;
        document.getElementById("fireInput").value = salary/2;
        $('#fireStaffModal').modal('show');
    }

    function setStaffIdUpgrade(staffId, salary) {
        document.getElementById("staffIdInputUpgrade").value = staffId;
        document.getElementById("upgradeAmount").innerHTML = salary/2;
        document.getElementById("upgradeInput").value = salary/2;
        $('#upgradeStaffModal').modal('show');
    }

    function setRoomId(roomId, price) {
    document.getElementById("roomIdInput").value = roomId;
    document.getElementById("sellAmount").innerHTML = price / 2;
    document.getElementById("sellInput").value = price / 2;
    $('#sellRoomModal').modal('show');
}
   

    function setPatient(patientID, firstName,lastName,disease,diseaseID,waitingTime) {
        let argument=firstName+" "+lastName;
        let avatarURL = "https://api.dicebear.com/7.x/avataaars/svg?size=150&style=circle&seed=" + encodeURIComponent(argument) + ".svg";
        document.getElementById("avatar").src=avatarURL;
        document.getElementById("firstName").innerHTML="First Name: "+ firstName;
        document.getElementById("lastName").innerHTML ="Last Name: " + lastName;
        if(!disease){
            disease="Unknown";
        }
        document.getElementById("disease").innerHTML="Disease: "+ disease;
        document.getElementById("patientIDInput").value = patientID;
        document.getElementById("diseaseIDInput").value = diseaseID;
        if(waitingTime>0 && waitingTime<=120000){
            document.getElementById("timer").style.display = "block";
            document.getElementById("timer").innerHTML ="Waiting Time: " + Math.round(waitingTime/1000) +" s";
            document.getElementById("sendPatientButton").disabled = true;
            document.getElementById("disease").innerHTML="Disease: ...";
        }
        else if(waitingTime>864000000000000){
        }
        else{
            document.getElementById("disease").innerHTML="Disease: "+ disease;
            document.getElementById("timer").style.display = "none";
            document.getElementById("sendPatientButton").disabled = false;
        }
        $('#displayPatientModal').modal('show');
}
    
</script>
<body class="bg-light" style="height: 90%">
    <?php
      session_start();
      $_SESSION['initial']="true";
      if (isset($_SESSION["hire_failed"]) && $_SESSION["hire_failed"]) {
        echo "<script>alert('Not enough funds to hire the staff.');</script>";
        $_SESSION["hire_failed"] = false;
    }
    if (isset($_SESSION["purchase_failed"]) && $_SESSION["purchase_failed"]) {
        echo "<script>alert('Purchase failed.');</script>";
        $_SESSION["purchase_failed"] = false;
    }
    if (isset($_SESSION["sending_failed"]  ) && $_SESSION["sending_failed"]) {
        echo "<script>alert('Could not send patient at the moment.');</script>";
        $_SESSION["sending_failed"]   = false;
    }
    if (isset($_SESSION["patient_failed"]  ) && $_SESSION["patient_failed"]) {
        echo '<script>alert("There are no more patients.");</script>';
        $_SESSION["patient_failed"]   = false;
    }
    if (isset($_SESSION["upgrade_failed"]  ) && $_SESSION["upgrade_failed"]) {
        echo '<script>alert("Staff already has maximum level.");</script>';
        $_SESSION["upgrade_failed"]   = false;
    }
    if (isset($_SESSION["sending_home_failed"]  ) && $_SESSION["sending_home_failed"]) {
        echo '<script>alert("Cannot send patient home. They are not cured!");</script>';
        $_SESSION["sending_home_failed"]   = false;
    }
    ?>
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-7">
                <div class="card">
                    <div class="card-body">
                        <h2 class="card-title">Theme Hospital</h2>
                        
                        <?php
                            $userID = $_SESSION['userID'];
                            $username = $_SESSION['username'];
                            $bdd = new PDO("mysql:host=localhost;dbname=hospital;charset=utf8", "root", "");
                            $req = $bdd->prepare("SELECT budget FROM user WHERE userID = ?;");
                            $req->execute([$userID]);
                            $budget = $req->fetch()['budget'];
                            $_SESSION['budget']=$budget;
                        ?>
                        
                        <span> Welcome, <?php echo $username; ?>!</span>
                        <a class="btn btn-primary p-2 flex-fill float-end" style="width:46px;" href="menu.php">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-house" viewBox="0 0 16 16">
                                <path d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L2 8.207V13.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5V8.207l.646.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.707 1.5ZM13 7.207V13.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V7.207l5-5 5 5Z"/>
                            </svg>
                        </a>
                        <p>Your Budget: $<?php echo $budget; ?></p>
                        <button class="btn btn-success p-2 flex-fill" data-bs-toggle="modal" data-bs-target="#hireStaffModal">Hire Staff</button>
                        <button class="btn btn-info p-2 flex-fill" data-bs-toggle="modal" data-bs-target="#displayHiredStaffModal">Display Hired Staff</button>
                        <button class="btn btn-success p-2 flex-fill" data-bs-toggle="modal" data-bs-target="#purchaseRoomModal">Purchase Room</button>
                        <button class="btn btn-info p-2 flex-fill" data-bs-toggle="modal" data-bs-target="#displayRoomsModal">Display Rooms</button>              
                        <form method="post" style="display:inline;" class="p-2 flex-fill">
                            <button class="btn btn-success p-2 flex-fill float-end" style="width:46px;" type="submit" name="refreshButton" value="Refresh">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-clockwise" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M8 3a5 5 0 1 0 4.546 2.914.5.5 0 0 1 .908-.417A6 6 0 1 1 8 2v1z"/>
                                    <path d="M8 4.466V.534a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384L8.41 4.658A.25.25 0 0 1 8 4.466z"/>
                                </svg>
                            </button>
                        </form>
                        <span class="float-end">&nbsp;</span>
                        <button class="btn btn-success p-2 flex-fill float-end" style="width:46px;" data-bs-toggle="modal" data-bs-target="#displayStatistics">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clipboard-data" viewBox="0 0 16 16">
                                <path d="M4 11a1 1 0 1 1 2 0v1a1 1 0 1 1-2 0v-1zm6-4a1 1 0 1 1 2 0v5a1 1 0 1 1-2 0V7zM7 9a1 1 0 0 1 2 0v3a1 1 0 1 1-2 0V9z"/>
                                <path d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1h1a1 1 0 0 1 1 1V14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V3.5a1 1 0 0 1 1-1h1v-1z"/>
                                <path d="M9.5 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5h3zm-3-1A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3z"/>
                            </svg>
                        </button>         
                        
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center mt-4">
            <div class="col-md-7">
                <div class="card" style="overflow-y: auto; max-height: 67vh">
                    <div class="card-body">
                        <div class="container text-center">
                            <?php
                            $patientFetched = false;
                            $req = $bdd->prepare("SELECT * FROM patient_management pm INNER JOIN patient p ON pm.patientID=p.patientID INNER JOIN disease d ON pm.diseaseID=d.diseaseID WHERE userID=? ORDER BY atHospitalTime DESC;");
                            $req->execute([$_SESSION['userID']]);
                            echo '<div class="d-flex flex-wrap">';
                            echo '<a class="btn p-2 flex-fill align-self-center" href=get_patient.php><svg xmlns="http://www.w3.org/2000/svg" width="54" height="54" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                            <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                            </svg> New Patient</a>';    
                            while ($data = $req->fetch()) {
                                if (isset($_POST['refreshButton']) || $_SESSION['initial']="true") {
                                $_SESSION['initial']="false";
                                $firstName = $data['firstName'];
                                $lastName = $data['lastName'];
                                $patientID = $data['patientID'];
                                $diseaseID = $data['diseaseID'];
                                $disease = $data['name'];
                                $waitingTime = (strtotime($data['waitingTime']) - time()) * 1000;
                                echo '<button type="button" style="margin: 5px;
                                background-color: #95ccc5;" class="btn p-2 flex-fill" onclick="setPatient(' . $patientID . ', \'' . $firstName . '\', \'' . $lastName . '\', \'' . $disease . '\', \'' . $diseaseID . '\', \'' . $waitingTime . '\')"><img src="https://api.dicebear.com/7.x/avataaars/svg?size=64&style=circle&seed=' .
                                urlencode($data['firstName'] . ' ' . $data['lastName']) . '.svg" alt="avatar" />' . $firstName . ' ' . $lastName . '</button>';
                                $patientFetched = true;
                            }
                        }
                            echo '</div>';
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="hireStaffModal" tabindex="-1" aria-labelledby="hireStaffModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="hireStaffModalLabel">Hire Staff</h5>
                </div>
                <div class="modal-body">
                    <form action="hire_staff.php" method="POST">
                        <div class="form-group">
                            <label for="first_name">First Name:</label>
                            <input type="text" name="first_name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="last_name">Last Name:</label>
                            <input type="text" name="last_name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="staff_type">Select Staff Type:</label>
                            <select name="staffTypeID" class="form-control">
                                <?php
                                $req = $bdd->prepare("SELECT * FROM staff_type;");
                                $req->execute();
                                while($data = $req->fetch()) {
                                    echo '<option value="' . $data['staffTypeID'] . '">'
                                        . $data["description"] . ' - Salary: $' . $data["salary"] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-success">HIRE</button>
                        
                    </form>
                </div>

                <div class="modal-footer">
                     <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="displayHiredStaffModal" tabindex="-1" aria-labelledby="displayHiredStaffModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="displayHiredStaffModalLabel">Hired Staff</h5>
                </div>
                <div class="modal-body">
                    <ul style="list-style: none">
                        <?php
                        $staffFetched=false;
                        $req = $bdd->prepare("SELECT * FROM staff WHERE userID=?;");
                        $req->execute([$_SESSION['userID']]);
                        while ($data = $req->fetch()) {
                            $sreq = $bdd->prepare("SELECT salary FROM staff_type st INNER JOIN staff s ON st.staffTypeID=s.staffTypeID WHERE s.staffID=?;");
                            $sreq->execute([$data['staffID']]);
                            $sdata = $sreq->fetch();
                            if($data){
                            $treq = $bdd->prepare("SELECT description FROM staff_type st INNER JOIN staff s ON st.staffTypeID=s.staffTypeID WHERE s.staffID=?;");
                            $treq->execute([$data['staffID']]);
                            $tdata = $treq->fetch();
                            echo '<li>' . $data["first_name"] . ' ' . $data["last_name"] . ' | '. $tdata['description'] .'
                                    <button type="button" class="btn" onclick="setStaffIdUpgrade('.$data['staffID'].','. $sdata['salary'] .')">Upgrade</button>
                                    <button type="button" class="btn btn-danger" onclick="setStaffId('.$data['staffID'].','. $sdata['salary'] .')">Fire</button>
                            </li>';
                            $staffFetched = true;
                            }
                        }
                        if(!$staffFetched){
                            echo "<li>No staff to show.</li>";
                        }
                        ?>
                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

<div class="modal fade" id="displayStatistics" tabindex="-1" aria-labelledby="displayStatisticsModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="displayStatisticsModalLabel">Statistics</h5>
            </div>
            <div class="modal-body">
                <ul style="list-style: none">
                    <?php
                    $staffFetched=false;
                    $req = $bdd->prepare("SELECT * FROM staff WHERE userID=?;");
                    $req->execute([$_SESSION['userID']]);
                    while ($data = $req->fetch()) {
                        $sreq = $bdd->prepare("SELECT salary FROM staff_type st INNER JOIN staff s ON st.staffTypeID=s.staffTypeID WHERE s.staffID=?;");
                        $sreq->execute([$data['staffID']]);
                        $sdata = $sreq->fetch();
                        if($data){
                        $treq = $bdd->prepare("SELECT description FROM staff_type st INNER JOIN staff s ON st.staffTypeID=s.staffTypeID WHERE s.staffID=?;");
                        $treq->execute([$data['staffID']]);
                        $tdata = $treq->fetch();
                        echo '<li>' . $data["first_name"] . ' ' . $data["last_name"] . ' | '. $tdata['description'] .'
                                <button type="button" class="btn" onclick="setStaffIdUpgrade('.$data['staffID'].','. $sdata['salary'] .')">Upgrade</button>
                                <button type="button" class="btn btn-danger" onclick="setStaffId('.$data['staffID'].','. $sdata['salary'] .')">Fire</button>
                        </li>';
                        $staffFetched = true;
                        }
                    }
                    if(!$staffFetched){
                        echo "<li>No staff to show.</li>";
                    }
                    ?>
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="upgradeStaffModal" tabindex="-1" aria-labelledby="upgradeStaffModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="upgradeStaffModalLabel">Upgrade Staff</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to upgrade this staff member?</p>
                <p>You will have to pay $<span id="upgradeAmount"></span> to upgrade this staff member.</p>
                <form action="upgrade_staff.php" method="POST">
                    <input type="hidden" name="staff_id" id="staffIdInputUpgrade">
                    <input type="hidden" name="upgrade_amount" id="upgradeInput">
                    <button type="submit" class="btn btn-danger">Confirm Upgrade</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="fireStaffModal" tabindex="-1" aria-labelledby="fireStaffModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="fireStaffModalLabel">Fire Staff</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to fire this staff member?</p>
                <p>You will receive $<span id="fireAmount"></span> for firing this staff member.</p>
                <form action="fire_staff.php" method="POST">
                    <input type="hidden" name="staff_id" id="staffIdInput">
                    <input type="hidden" name="fire_amount" id="fireInput">
                    <button type="submit" class="btn btn-danger">Confirm Fire</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="purchaseRoomModal" tabindex="-1" aria-labelledby="purchaseRoomModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="purchaseRoomModalLabel">Purchase Room</h5>
                </div>
                <div class="modal-body">
                    <form action="purchase_room.php" method="POST">
                        <div class="form-group">
                            <label for="room_type">Select Room Type:</label>
                            <select name="roomTypeID" class="form-control">
                                <?php
                                $req = $bdd->prepare("SELECT * FROM room_type;");
                                $req->execute();
                                $doc="doc";
                                $nurse="nurse";
                                while($data = $req->fetch()) {
                                    echo '<option value="' . $data['roomTypeID'] . '">'
                                        . $data["description"] . ' - Cost: $' . $data["price"] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-success">PURCHASE</button> 
                        <button class="btn btn-success" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-question-square" viewBox="0 0 16 16">
                        <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
                        <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286zm1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94z"/>
                        </svg>
                        </button>
                        </p>
                        <div class="collapse" id="collapseExample">
                            <h5>Requirements:</h5>
                            Consulting Room:<br> &emsp;1 General Practitioner + 1 General Nurse Practitioner;<br>
                            Operating Room:<br> &emsp;1 Surgeon + 2 Operating Room Nurse;<br>
                            Radiology Room:<br> &emsp;1 Radiologist + 2 Radiology Nurse;<br>
                            Isolation Room:<br> &emsp;2 Infectious Disease Specialist + 2 Infection Control Nurse;<br>
                            Psychiatric Room:<br> &emsp;1 Psychiatrist + 3 Psychiatric Nurse;<br>
                            Physiotherapy Room:<br> &emsp;3 Physiotherapist + 1 General Nurse Practitioner;<br>
                            Neurology Room:<br> &emsp;1 Neurologist + 1 Neurology Nurse;<br>
                            ICU Room:<br> &emsp;2 Intensivist + 3 Intensive Care Nurse;<br>
                            Endoscopy Room:<br> &emsp;1 Endoscopist + 2 Endoscopy Nurse;<br>
                            Ultrasound Room:<br> &emsp;1 Ultrasound Technician + 2 Ultrasound Nurse;<br>
                            Pharmacy Room:<br> &emsp;1 Pharmacy Nurse;<br>                   
                        </div>
                    </form>
                </div>

                <div class="modal-footer">
                     <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="displayRoomsModal" tabindex="-1" aria-labelledby="displayRoomsModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="displayRoomsModalLabel">Owned Rooms</h5>
            </div>
            <div class="modal-body">
                <ul style="list-style: ordered">
                    <?php
                    $req = $bdd->prepare("SELECT * FROM room WHERE userID=?;");
                    $req->execute([$_SESSION['userID']]);
                    while ($data = $req->fetch()) {
                        $sreq = $bdd->prepare("SELECT price,description FROM room_type rt INNER JOIN room r ON rt.roomTypeID=r.roomTypeID WHERE r.roomID=?;");
                        $sreq->execute([$data['roomID']]);
                        $sdata = $sreq->fetch();
                        echo '<li> Type: ' . $sdata["description"] . ' - Cost: ' . $sdata["price"] . '
                         <button type="button" class="btn btn-danger" onclick="setRoomId('.$data['roomID'].','.$sdata['price'].')">Sell</button>
                        </li>';
                    }
                    ?>
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="sellRoomModal" tabindex="-1" aria-labelledby="sellRoomModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="sellRoomModalLabel">Sell Room</h5>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to sell this room?</p>
                <p>You will receive $<span id="sellAmount"></span> for selling this room.</p>
                <form action="sell_room.php" method="POST">
                    <input type="hidden" name="room_id" id="roomIdInput">
                    <input type="hidden" name="sell_amount" id="sellInput">
                    <button type="submit" class="btn btn-danger">Confirm Sale</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="displayPatientModal" tabindex="-1" aria-labelledby="displayPatientModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="displayPatientModalLabel">Patient Information</h5>
            </div>
            <div class="modal-body">
                <img id="avatar" alt="avatar" />
                <h5 id="firstName"></h5>
                <h5 id="lastName"></h5>
                <h5 id='disease'></h5>
                <h5 id='timer'></h5>
                <form action="send_patient.php" method="POST">
                    <select class="form-control" name="sendPatientRoom">
                        <?php
                            $req = $bdd->prepare("SELECT DISTINCT description,r.roomTypeID FROM room r INNER JOIN room_type rt ON r.roomTypeID=rt.roomTypeID WHERE userID=? AND r.waitingTime < NOW();");
                            $req->execute( [$_SESSION["userID"]]);
                            while($data = $req->fetch()) {
                                echo '<option value="' . $data['roomTypeID'] . '">'. $data["description"] .'</option>';      
                            }
                            echo '<option value="0">Home</option>';
                        ?>
                    
                    </select>
                    <input type="hidden" name="patientID" id="patientIDInput">
                    <input type="hidden" name="diseaseID" id="diseaseIDInput">
                    <br>
                    <button type="submit" id="sendPatientButton" class="btn">Send Patient</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="patientCloseButton" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
 </body>
</html>
