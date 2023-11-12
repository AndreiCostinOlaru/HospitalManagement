<!DOCTYPE html>
<html>
<head>
    <title>Menu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="menu.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Baloo&display=swap" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body justify-content-center">
                        <div class="d-flex justify-content-center">
                        <?php
                            session_start();
                            $userID = $_SESSION['userID'];
                            $bdd = new PDO("mysql:host=localhost;dbname=hospital;charset=utf8", "root", "");
                            $req = $bdd->prepare("SELECT hospitalName FROM user WHERE userID = ?;");
                            $req->execute([$userID]);
                            $hospitalName = $req->fetch()['hospitalName'];
                            $_SESSION['hospitalName']=$hospitalName;
                            echo '<h1 class="card-title">Welcome to ' . $hospitalName . '!</h1>'
                        ?>
                        </div>
                        <br>
                        <div class="d-flex justify-content-center">
                        <a href="game.php" class="btn btn-primary p-2 align-items-center flex-fill buton">START</a>
                        </div>
                        <br>
                        <div class="d-flex  justify-content-center">
                        <button class="btn btn-info p-2 align-items-center flex-fill buton" data-bs-toggle="modal" data-bs-target="#rulesModal">RULES</button>
                        </div>
                        <br>
                        <div class="d-flex justify-content-center">
                        <a href="logout.php" class="btn btn-danger p-2 align-items-center flex-fill buton">LOG OUT</a>
                        </div>
                        <br>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="rulesModal" tabindex="-1" aria-labelledby="rulesModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="rulesModalLabel">Game Rules</h5>
                </div>
                <div class="modal-body fs-5">
                    <ul>
                        <li>Treating patients of their illnesses is the core concept of this game</li>
                        <li>Your hospital needs to be equipped with the right staff for each diesease</li>
                        <li>But in order to treat diseases, you hospital needs the right rooms containing the right equipment for the specialised staff to use</li>
                        <li>In order to buy a room you must make sure to have the corresponding staff for it</li>
                        <li>Each room might require a different number of doctors and nurses</li>
                        <li>There are also janitors, each of them being assigned to five rooms</li>
                        <li>Each staff member has a level attribute, and by increasing their level, the user will be able to assign them to one more room</li>
                        <li>The maximum staff level is 2</li>
                        <li>Once you have the right rooms required to treat the diferrent illnesses, you will need to figure out by yourself where to send your patients</li>
                        <li>After sending a patient to a room you will have to wait for 2 minutes</li>
                        <li>Sending a patient to the right rooms will cure them, but sending them to the wrong room will take away $50</li>
                        <li>Once a patient is cured, they can be sent home and the budget will increase by $200</li>
                        <li>You can fire staff and by doing so you will receive half of their salary</li>
                        <li>You can sell rooms, which will give you back half of their price</li>
                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
