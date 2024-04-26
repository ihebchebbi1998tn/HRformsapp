<?php
session_start(); // Start the session

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
    $password = $_POST["password"];

    $sql = "SELECT * FROM rhusers WHERE matricule = '$matricule' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        if ($user['state'] == "0") {
            $_SESSION['loggedInUser'] = $user; // Store the user's information in the session
            header("Location: change_password_page.php"); // Redirect to change password page
            exit();
        } else {
            // Redirect to attestationdesalaire.php
            echo '<div class="alert alert-success" role="alert">Connexion réussie!</div>';
            echo "<script>localStorage.setItem('loggedInUser', JSON.stringify(" . json_encode($user) . "));</script>";
            echo "<script>setTimeout(function(){ window.location.href = 'attestationsalaire.php'; }, 1500);</script>";
        }
    } else {
        echo '<div class="alert alert-danger" role="alert">Matricule ou mot de passe incorrect!</div>';
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
  <title>Connexion</title>
  <style>
    body {
      background-color: #f8f9fa;
    }
    .login-container {
      max-width: 540px;
      margin: 120px auto;
      background-color: #ffffff;
      border-radius: 12px;
      padding: 36px;
      box-shadow: 0 0 18px rgba(0,0,0,0.2);
    }
    .login-heading {
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
    .form-check-label {
      font-size: 19.2px;
    }
    .btn-login {
      width: 100%;
      font-size: 21.6px;
    }
  </style>
</head>
<body>

<div class="container login-container">
  <h2 class="login-heading">Connexion</h2>
  <form id="loginForm" method="POST">
    <div class="form-group">
      <label for="matricule">Matricule</label>
      <input type="text" class="form-control" id="matricule" name="matricule" required>
    </div>
    <div class="form-group">
      <label for="password">Mot de passe</label>
      <input type="password" class="form-control" id="password" name="password" required>
    </div>
    <button type="submit" class="btn btn-primary btn-login"><i class="fas fa-sign-in-alt"></i> Connexion</button>
  </form>
 
</div>
<script src="https://kit.fontawesome.com/a076d05399.js"></script>

</body>
</html>
