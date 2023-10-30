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

    function setRoomId(roomId, price) {
    console.log("setRoomId function called");
    document.getElementById("roomIdInput").value = roomId;
    document.getElementById("sellAmount").innerHTML = price / 2;
    document.getElementById("sellInput").value = price / 2;
    $('#sellRoomModal').modal('show');
}

</script>
<body class="bg-light">
    <?php
      session_start();
      if (isset($_SESSION["hire_failed"]) && $_SESSION["hire_failed"]) {
        echo "<script>alert('Not enough funds to hire the staff.');</script>";
        $_SESSION["hire_failed"] = false;
    }
    if (isset($_SESSION["purchase_failed"]) && $_SESSION["purchase_failed"]) {
        echo "<script>alert('Purchase failed.');</script>";
        $_SESSION["purchase_failed"] = false;
    }


    ?>
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h2 class="card-title">Welcome to the Game</h2>
                        
                        <?php
                            $username = $_SESSION['username'];
                            $bdd = new PDO("mysql:host=localhost;dbname=hospital;charset=utf8", "root", "");
                            $req = $bdd->prepare("SELECT budget FROM user WHERE username = ?;");
                            $req->execute([$username]);
                            $budget = $req->fetch()['budget'];
                            $_SESSION['budget']=$budget;
                        ?>
                        
                        <p>Welcome, <?php echo $username; ?>!</p>
                        <p>Your Budget: $<?php echo $budget; ?></p>
                        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#hireStaffModal">Hire Staff</button>
                        <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#displayHiredStaffModal">Display Hired Staff</button>
                        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#purchaseRoomModal">Purchase Room</button>
                        <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#displayRoomsModal">Display Rooms</button>
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
                <ul>
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
                <ul>
                    <?php
                    $req = $bdd->prepare("SELECT * FROM room WHERE userID=?;");
                    $req->execute([$_SESSION['userID']]);
                    while ($data = $req->fetch()) {
                        $sreq = $bdd->prepare("SELECT price,description FROM room_type rt INNER JOIN room r ON rt.roomTypeID=r.roomTypeID WHERE r.roomID=?;");
                        $sreq->execute([$data['roomID']]);
                        $sdata = $sreq->fetch();
                        echo '<li>Room number: ' . $data["roomID"] . ' - Type: ' . $sdata["description"] . ' - Cost: ' . $sdata["price"] . '
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
 </body>
</html>
