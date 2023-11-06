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
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h2 class="card-title">Welcome to the Game</h2>
                        
                        <?php
                            $userID = $_SESSION['userID'];
                            $username = $_SESSION['username'];
                            $bdd = new PDO("mysql:host=localhost;dbname=hospital;charset=utf8", "root", "");
                            $req = $bdd->prepare("SELECT budget FROM user WHERE userID = ?;");
                            $req->execute([$userID]);
                            $budget = $req->fetch()['budget'];
                            $_SESSION['budget']=$budget;
                        ?>
                        
                        <p>Welcome, <?php echo $username; ?>!</p>
                        <p>Your Budget: $<?php echo $budget; ?></p>
                        <button class="btn btn-success p-2 flex-fill" data-bs-toggle="modal" data-bs-target="#hireStaffModal">Hire Staff</button>
                        <button class="btn btn-info p-2 flex-fill" data-bs-toggle="modal" data-bs-target="#displayHiredStaffModal">Display Hired Staff</button>
                        <button class="btn btn-success p-2 flex-fill" data-bs-toggle="modal" data-bs-target="#purchaseRoomModal">Purchase Room</button>
                        <button class="btn btn-info p-2 flex-fill" data-bs-toggle="modal" data-bs-target="#displayRoomsModal">Display Rooms</button>
                        <form method="post" style="display:inline;" class="p-2 flex-fill">
                            <button class="btn btn-success p-2 flex-fill float-end" style="width:46px;" type="submit" name="refreshButton" value="Refresh"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-clockwise" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M8 3a5 5 0 1 0 4.546 2.914.5.5 0 0 1 .908-.417A6 6 0 1 1 8 2v1z"/>
  <path d="M8 4.466V.534a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384L8.41 4.658A.25.25 0 0 1 8 4.466z"/>
</svg></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center mt-4">
            <div class="col-md-6">
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
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="purchase_room.php" method="POST">
                        <div class="form-group">
                            <label for="room_type">Select Room Type:</label>
                            <select name="roomTypeID" class="form-control">
                                <?php
                                $req = $bdd->prepare("SELECT * FROM room_type;");
                                $req->execute();
                                while($data = $req->fetch()) {
                                    echo '<option value="' . $data['roomTypeID'] . '">'
                                        . $data["description"] . ' - Cost: $' . $data["price"] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-success">PURCHASE</button>
                        
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
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
