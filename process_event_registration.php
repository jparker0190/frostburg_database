<?php
include 'db.php'; // Include your database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $event_id = $_POST['event_id'];
    $attendee_name = $_POST['attendee_name'];
    $attendee_email = $_POST['attendee_email'];

    // Check if the attendee exists by email
    $check_attendee_sql = "SELECT attendee_id FROM Attendees WHERE attendee_email = '$attendee_email'";
    $result = $conn->query($check_attendee_sql);

    if ($result->num_rows > 0) {
        // Attendee already exists, fetch their ID
        $row = $result->fetch_assoc();
        $attendee_id = $row['attendee_id'];
    } else {
        // Attendee doesn't exist, insert them into the Attendees table
        $insert_attendee_sql = "INSERT INTO Attendees (attendee_email) VALUES ('$attendee_email')";
        if ($conn->query($insert_attendee_sql) === TRUE) {
            $attendee_id = $conn->insert_id; // Get the ID of the inserted attendee
        } else {
            echo "Error: " . $insert_attendee_sql . "<br>" . $conn->error;
            exit(); // Exit if there's an error inserting the attendee
        }
    }

    // Register attendee for the event in the Registrations table
    $register_sql = "INSERT INTO Registrations (event_id, attendee_id) VALUES ('$event_id', '$attendee_id')";
    if ($conn->query($register_sql) === TRUE) {
        echo "Registration successful!";
    } else {
        echo "Error: " . $register_sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
