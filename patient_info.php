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
<body class="bg-light">
    <?php
      session_start();
    ?>
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">                        
                    <?php
                    $bdd = new PDO("mysql:host=localhost;dbname=hospital;charset=utf8", "root", "");
                    if (isset($_GET['patientID'])) {
                        $patientID = $_GET['patientID'];

                        $req = $bdd->prepare("SELECT * FROM patient WHERE PatientID = ?;");
                        $req->execute([$patientID]);
                        $data = $req->fetch();

                        if ($data) {
                            echo '<h1>Patient Information</h1>';
                            echo '<img src="https://api.dicebear.com/7.x/avataaars/svg?size=150&style=circle&seed=' . 
                                urlencode($data['firstName'] .' '. $data['lastName']) . '.svg" alt="avatar" />';
                            echo '<h5>First Name: ' . $data['firstName'] . '</h5>';
                            echo '<h5>Last Name: ' . $data['lastName'] . '</h5>';
                        } else {
                            echo 'Patient not found.';
                        }
                    } else {
                        echo 'Invalid request.';
                    }
                    ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
