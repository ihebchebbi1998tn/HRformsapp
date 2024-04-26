<?php

require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

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
        // Send the email
        $mail->send();
        return true;
    } catch (Exception $e) {
        $errorDetails = $e->getMessage();
        error_log('Failed to send SMS: ' . $errorDetails);
        return $errorDetails; 
    }
}

if (isset($_GET['recipientPhoneNumber']) && isset($_GET['smsMessage'])) {
    $recipientPhoneNumber = $_GET['recipientPhoneNumber'];
    $smsMessage = $_GET['smsMessage'];

    $error = sendSMS($recipientPhoneNumber, $smsMessage);

    if ($error === true) {
        header("Location: {$_SERVER['HTTP_REFERER']}?success=2");
    } else {
        echo 'Échec de l\'envoi du SMS. Veuillez réessayer plus tard. Détails de l\'erreur: ' . $error;
    }
} else {
    echo 'Le numéro de téléphone du destinataire et le message SMS sont requis.';
}
?>
