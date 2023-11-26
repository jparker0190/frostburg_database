<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $event_name = $_POST['event_name'];
    $event_description = $_POST['event_description'];
    $event_date = $_POST['event_date'];
    $event_location = $_POST['event_location'];
    $organizer_id = 1; // Assuming coordinator's ID for demonstration

    $sql = "INSERT INTO Events (event_name, event_description, event_date, event_location, event_organizer_id) VALUES ('$event_name', '$event_description', '$event_date', '$event_location', '$organizer_id')";

    if ($conn->query($sql) === TRUE) {
        echo "Event created successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
