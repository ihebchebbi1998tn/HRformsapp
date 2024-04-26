<!DOCTYPE html>
<html lang="en">
<head>
  <title>Display Selected Information</title>
</head>
<body>

<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'vendor/autoload.php';

function sendSMS($recipientPhoneNumber, $smsMessage) {
    $mail = new PHPMailer(true);
    try {
        $mail->SMTPAuth = true;
        $mail->isSMTP();
        $mail->Host = '192.168.100.11';
        $mail->Username = 'webmaster';
        $mail->Password = 'q21grT8EFT';
        $mail->Port = 1125;
        $mail->setFrom('Webmaster@cliniquebeausejour.tn', 'Borne CBS-RH');
        $mail->addAddress($recipientPhoneNumber . '@sms.ngtrend.com', 'Recipient Name');
        $mail->isHTML(false);
        $mail->Subject = '';
        $mail->Body = $smsMessage;
        $mail->CharSet = 'UTF-8';
        $mail->Encoding = 'base64';
        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );
        $mail->send();
        return true;
    } catch (Exception $e) {
        return false;
    }
}

require_once('db_connection.php');

if (isset($_GET['id']) && isset($_GET['update']) && isset($_GET['userColumn']) && isset($_GET['traiteparColumn']) && isset($_GET['table']) && isset($_GET['smstext'])) {
    $id = $_GET['id'];
    $updateColumn = urldecode($_GET['update']);
    $userColumn = urldecode($_GET['userColumn']);
    $traiteparColumn = urldecode($_GET['traiteparColumn']);
    $table = urldecode($_GET['table']);
    $smstext = urldecode($_GET['smstext']);

    // Prevent SQL Injection
    $sqlUpdate = "UPDATE `$table` SET `$updateColumn` = 'Traité', `$traiteparColumn` = ?, `updated_at` = NOW() WHERE `id` = ?";
    
    // Prepare and execute the statement
    $stmt = $conn->prepare($sqlUpdate);
    if ($stmt) {
        $stmt->bind_param("ss", $userColumn, $id);
        $stmt->execute();

        // Check if the update was successful
        if ($conn->affected_rows > 0) {
            // SMS sending
            if (isset($_GET['tel']) && $_GET['tel'] !== "NO") {
                $recipientPhoneNumber = urldecode($_GET['tel']);
                sendSMS($recipientPhoneNumber, $smstext);
            }

            // Output results
            echo "<ul>";
            echo "<li>ID: $id</li>";
            echo "<li>Column 13: {$_GET['tel']}</li>"; 
            echo "<li>Column 6: $updateColumn</li>";
            echo "<li>Column 14: $smstext</li>";
            echo "<li>Table: $table</li>";
            echo "</ul>";

            // Redirect to a specific location
            header("Location: {$_SERVER['HTTP_REFERER']}?success=1");
            exit; // Make sure to exit after redirection
        } else {
            echo "Error: Failed to update the record.";
        }
    } else {
        echo "Error: " . $conn->error;
    }
} else {
    echo "<p>No selected information found or missing parameters.</p>";
}

$conn->close();
?>

</body>
</html>
