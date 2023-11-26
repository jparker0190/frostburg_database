<?php
// Database connection
include 'db.php'; // Include your database connection file

// Process event creation form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $event_name = $_POST['event_name'];
    $event_description = $_POST['event_description'];
    $event_date = $_POST['event_date'];
    $event_location = $_POST['event_location'];

    // Sanitize inputs and perform necessary validations

    // Insert event details into the Events table
    $sql = "INSERT INTO Events (event_name, event_description, event_date, event_location) 
            VALUES ('$event_name', '$event_description', '$event_date', '$event_location')";

    if ($conn->query($sql) === TRUE) {
        echo "Event created successfully!";
        // Redirect to a success page or back to the index page
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Create Event</title>
</head>
<body>
    <h2>Create an Event</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="event_name">Event Name:</label>
        <input type="text" name="event_name" required><br><br>

        <label for="event_description">Event Description:</label>
        <textarea name="event_description" required></textarea><br><br>

        <label for="event_date">Event Date:</label>
        <input type="date" name="event_date" required><br><br>

        <label for="event_location">Event Location:</label>
        <input type="text" name="event_location" required><br><br>

        <input type="submit" value="Create Event">
    </form>
</body>
</html>
