<?php
include 'db.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['event_id']) && isset($_POST['registration_id'])) {
    $event_id = $_POST['event_id'];
    $registration_id = $_POST['registration_id'];


    $delete_attendee_sql = "DELETE FROM Registrations WHERE event_id = '$event_id' AND registration_id = '$registration_id'";
    if ($conn->query($delete_attendee_sql) === TRUE) {
        echo "<script>alert('Attendee deleted successfully!');</script>";
        echo "<script>window.location = 'index.php';</script>"; 
    } else {
        echo "Error deleting attendee: " . $conn->error;
    }
} else {
    echo "Invalid request";
}

$conn->close();
?>
