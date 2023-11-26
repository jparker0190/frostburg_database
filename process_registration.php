<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $event_id = $_POST['event_id'];
    $attendee_id = $_POST['attendee_id'];

    $sql = "INSERT INTO Registrations (event_id, attendee_id) VALUES ('$event_id', '$attendee_id')";

    if ($conn->query($sql) === TRUE) {
        echo "Registration successful!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
