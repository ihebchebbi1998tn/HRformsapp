<!DOCTYPE html>
<html lang="en">
<head>
  <title>Display Selected Information</title>
</head>
<body>

<?php
require_once('db_connection.php');

if (isset($_GET['id']) && isset($_GET['update']) && isset($_GET['userColumn']) && isset($_GET['traiteparColumn']) && isset($_GET['table'])) {
    $id = $_GET['id'];
    $updateColumn = urldecode($_GET['update']);
    $userColumn = urldecode($_GET['userColumn']);
    $traiteparColumn = urldecode($_GET['traiteparColumn']);
    $table = urldecode($_GET['table']);

    // Prevent SQL Injection
    $sqlUpdate = "UPDATE `$table` SET `$updateColumn` = 'Rejetée', `$traiteparColumn` = ?, `updated_at` = NOW() WHERE `id` = ?";
    
    $stmt = $conn->prepare($sqlUpdate);
    if ($stmt) {
        $stmt->bind_param("ss", $userColumn, $id);
        $stmt->execute();

        if ($conn->affected_rows > 0) {
            echo "<ul>";
            echo "<li>ID: $id</li>";
            echo "<li>Column 6: $updateColumn</li>";
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
