<!DOCTYPE html>
<html>
<head>
    <title>Game</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</head>
<body class="bg-light">
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h2 class="card-title">Welcome to the Game</h2>
                        
                        <?php
                        session_start();

                            $username = $_SESSION['username'];
                            $bdd = new PDO("mysql:host=localhost;dbname=hospital;charset=utf8", "root", "");
                            $req = $bdd->prepare("SELECT budget FROM user WHERE username = ?;");
                            $req->execute([$username]);
                            $budget = $req->fetch()['budget'];
                        ?>
                        
                        <p>Welcome, <?php echo $username; ?>!</p>
                        <p>Your Budget: $<?php echo $budget; ?></p>
                        <!-- Hire Staff Modal -->
                        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#hireStaffModal">HIRE</button>
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
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?php
                         $req = $bdd->prepare("SELECT * FROM staff_type;");
                         $req->execute();
                         while($data=$req->fetch()) {
                            echo '<ul>
                                    <li>
                                        ' . $data["description"] . ' - Salary: $' . $data["salary"] . '
                                        <form action="hire_staff.php" method="POST">
                                            <input type="hidden" name="staff_id" value="$data[staffTypeID]">
                                            <button type="submit" class="btn btn-success">HIRE</button>
                                        </form>
                                    </li>
                                  </ul>';
                         }
                    ?>
                </div>
                <div class="modal-footer">
                     <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
