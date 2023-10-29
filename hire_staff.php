<?php
session_start();

if (isset($_SESSION['username'])) {
    // Handle the hiring process here
    $username = $_SESSION['username'];
    $staffID = $_POST['staffID']; // You should have an input field in the modal to select the staff to hire

    // Connect to the database
    $bdd = new PDO("mysql:host=localhost;dbname=hospital;charset=utf8", "root", "");
    $req = $bdd->prepare("SELECT cost FROM staffType WHERE id = (SELECT staffTypeID FROM staff WHERE staffID= ?;);");
    $req->execute([$staffID]);
    $cost = $req->fetch()['budget'];

    // Query the cost of the selected staff from the stafftype database
    $query = ;
    
    $stmt = $db->prepare($query);
    $stmt->bind_param("i", $staffID);
    $stmt->execute();
    $stmt->bind_result($staffCost);
    $stmt->fetch();
    $stmt->close();

    // Query the user's current budget
    $query = "SELECT budget FROM users WHERE username = ?";
    $stmt = $db->prepare($query);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->bind_result($budget);
    $stmt->fetch();

    // Check if the user has enough budget to hire the staff
    if ($budget >= $staffCost) {
        // Deduct the cost from the user's budget
        $newBudget = $budget - $staffCost;

        // Update the user's budget in the database
        $query = "UPDATE users SET budget = ? WHERE username = ?";
        $stmt = $db->prepare($query);
        $stmt->bind_param("is", $newBudget, $username);
        $stmt->execute();
        $stmt->close();

        // Insert the hired staff into the staff database
        $query = "INSERT INTO staff (username, staff_id) VALUES (?, ?)";
        $stmt = $db->prepare($query);
        $stmt->bind_param("si", $username, $staffID);
        $stmt->execute();
        $stmt->close();
        
        header("Location: game.php");
    } else {
        echo "Not enough budget to hire the staff.";
    }

    $db->close();
} else {
    echo "Please log in.";
}
?>
