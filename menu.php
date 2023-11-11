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
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="rulesModalLabel">Game Rules</h5>
                </div>
                <div class="modal-body">
                    <p>Rule 1: ...</p>
                    <p>Rule 2: ...</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
