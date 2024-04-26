<?php
$servername = "192.168.100.15";
$username = "borne-user";
$password = "PT6cACXrBicY/I-n";
$dbname = "cbs-intranet";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
