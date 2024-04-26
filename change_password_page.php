<?php
session_start(); // Start the session

if (!isset($_SESSION['loggedInUser'])) {
    // Redirect to the login page if the user is not logged in
    header("Location: login.php");
    exit();
}

$loggedInUser = $_SESSION['loggedInUser'];

$servername = "192.168.100.15";
$username = "borne-user";
$password = "PT6cACXrBicY/I-n";
$dbname = "cbs-intranet";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $newPassword = $_POST["newPassword"];
    $confirmPassword = $_POST["confirmPassword"];
    
    // Validate passwords
    if ($newPassword != $confirmPassword) {
        echo '<div class="alert alert-danger" role="alert">Les mots de passe ne correspondent pas!</div>';
    } else {
        // Update the user's password in the database
        $sql = "UPDATE rhusers SET password = '$newPassword', state = '1' WHERE matricule = '" . $loggedInUser['matricule'] . "'";
        if ($conn->query($sql) === TRUE) {
            echo '<div class="alert alert-success" role="alert">Mot de passe changé avec succès!</div>';
            // Redirect to the dashboard or any other page
            echo "<script>setTimeout(function(){ window.location.href = 'attestationsalaire.php'; }, 1500);</script>";
        } else {
            echo '<div class="alert alert-danger" role="alert">Erreur lors du changement de mot de passe: ' . $conn->error . '</div>';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
  <title>Changer le mot de passe</title>
  <style>
    body {
      background-color: #f8f9fa;
    }
    .change-password-container {
      max-width: 540px;
      margin: 120px auto;
      background-color: #ffffff;
      border-radius: 12px;
      padding: 36px;
      box-shadow: 0 0 18px rgba(0,0,0,0.2);
    }
    .change-password-heading {
      text-align: center;
      margin-bottom: 36px;
      font-size: 28.8px;
    }
    .form-group {
      margin-bottom: 36px;
    }
    .form-group label {
      font-weight: bold;
      font-size: 21.6px;
    }
    .form-control {
      border-radius: 9.6px;
      font-size: 19.2px;
    }
    .btn-change-password {
      width: 100%;
      font-size: 21.6px;
    }
  </style>
</head>
<body>

<div class="container change-password-container">
  <h2 class="change-password-heading">Changer le mot de passe</h2>
  <form id="changePasswordForm" method="POST">
    <div class="form-group">
      <label for="newPassword">Nouveau mot de passe</label>
      <input type="password" class="form-control" id="newPassword" name="newPassword" required>
    </div>
    <div class="form-group">
      <label for="confirmPassword">Confirmer le mot de passe</label>
      <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" required>
    </div>
    <button type="submit" class="btn btn-primary btn-change-password">Changer le mot de passe</button>
  </form>
 
</div>

</body>
</html>
