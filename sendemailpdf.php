<?php
require 'vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

$pdfContent = '';
$successMessage = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $pdfFile = $_FILES['pdf_file']['tmp_name'];

    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->Host       = 'smtp.office365.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'iheb.chebbi@lcieducation.net';
    $mail->Password   = 'Azerty123';
    $mail->SMTPSecure = 'tls';
    $mail->Port       = 587;

    $mail->setFrom('iheb.chebbi@lcieducation.net', 'Born rh');
    $mail->addAddress('iheb.chebbi@cliniquebeausejour.tn', 'Nom du Destinataire');

    $mail->isHTML(true);
    $mail->Subject = 'Votre fiche de paie';
    $mail->Body    = '<p>Veuillez trouver ci-joint le document demandé.</p>';
    $mail->AltBody = 'Version texte brut du courriel';

    $mail->addAttachment($pdfFile, 'document.pdf');

    try {
        $mail->send();
        $successMessage = '<div class="alert alert-success mt-3" role="alert">Le courriel a été envoyé avec succès .</div>';
    } catch (Exception $e) {
        $successMessage = '<div class="alert alert-danger mt-3" role="alert">Erreur : ' . $mail->ErrorInfo . '</div>';
    }

    $pdfContent = base64_encode(file_get_contents($pdfFile));
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Envoi de Courriel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="pdf_file" class="form-label">Choisissez le fichier PDF :</label>
                <input type="file" class="form-control" id="pdf_file" name="pdf_file" accept=".pdf" onchange="readPDF(this)" required>
            </div>
            <button type="submit" class="btn btn-primary">Envoyer le Courriel</button>
        </form>
        <br>
        <?php
        echo $successMessage;

        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($pdfContent)) {
            echo '<div class="mt-4"><iframe src="data:application/pdf;base64,'. $pdfContent . '" width="100%" height="600px"></iframe></div>';
        }
        ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function readPDF(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    var iframe = document.getElementById('pdfViewer');
                    if (!iframe) {
                        iframe = document.createElement('iframe');
                        iframe.id = 'pdfViewer';
                        iframe.width = '100%';
                        iframe.height = '600px';
                        document.querySelector('.container').appendChild(iframe);
                    }
                    iframe.src = e.target.result;
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
</body>
</html>
