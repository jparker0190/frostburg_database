<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['registration_id'])) {
    $registration_id = $_POST['registration_id'];


    $delete_registration_sql = "DELETE FROM Registrations WHERE registration_id = '$registration_id'";
    if ($conn->query($delete_registration_sql) === TRUE) {
        header("Location: index.php");
        exit(); 
    } else {
        echo "Error deleting registration: " . $conn->error;
    }
} else {
    echo "Invalid request";
}

$conn->close();
?>
