<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['event_id'])) {
    $event_id = $_POST['event_id'];

    
    $delete_registrations_sql = "DELETE FROM Registrations WHERE event_id = '$event_id'";
    if ($conn->query($delete_registrations_sql) === TRUE) {
       
        $delete_event_sql = "DELETE FROM Events WHERE event_id = '$event_id'";
        if ($conn->query($delete_event_sql) === TRUE) {
           
            echo "<script>alert('Event deleted successfully!');</script>";
            echo "<script>window.location = 'all_events.php';</script>";
        } else {
            echo "Error deleting event: " . $conn->error;
        }
    } else {
        echo "Error deleting associated registrations: " . $conn->error;
    }
} else {
    echo "Invalid request";
}

$conn->close();
?>
