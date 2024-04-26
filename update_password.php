<?php
// update_password.php

// Database connection
$servername = "192.168.100.15";
$username = "borne-user";
$password = "PT6cACXrBicY/I-n";
$dbname = "cbs-intranet";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $matricule = $_POST["matricule"];
    $newPassword = $_POST["newPassword"];

    // Update password and set state to "1"
    $sql = "UPDATE rhusers SET password = '$newPassword', state = 1 WHERE matricule = '$matricule'";

    if ($conn->query($sql) === TRUE) {
        echo "success";
    } else {
        echo "error";
    }
}

$conn->close();
?>
