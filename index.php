<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css">
    <title>Event Management System</title>
    <style>
        /* Your CSS styles here */
        table {
            border-collapse: collapse;
            width: 80%;
            margin: 20px auto;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Welcome to the Event Management System</h1>

    <div class="container">
        <h2>Create an Event</h2>
        <p><a href="create_event.php" class="button">Create Event</a></p>
    </div>

    <br><br>
	
	<div class="container">
        <h2>View All Events</h2>
        <p><a href="all_events.php" class="button">All Events</a></p>
    </div>

    <br><br>

    <div class="container">
    <h2>Available Events</h2>

    <?php
    // Database connection
    include 'db.php';

    // Handle event registration form submission
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['attendee_email'])) {
        $event_id = $_POST['event_id'];
        $attendee_email = $_POST['attendee_email'];
        $attendee_name = $_POST['attendee_name'];
        // Check if the attendee exists by email
        $check_attendee_sql = "SELECT attendee_id FROM Attendees WHERE attendee_email = '$attendee_email'";
        $result = $conn->query($check_attendee_sql);

        if ($result->num_rows > 0) {
            // Attendee already exists, fetch their ID
            $row = $result->fetch_assoc();
            $attendee_id = $row['attendee_id'];
        } else {
            // Attendee doesn't exist, insert them into the Attendees table with name and email
            $insert_attendee_sql = "INSERT INTO Attendees (attendee_name, attendee_email) VALUES ('$attendee_name', '$attendee_email')";
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
            echo "<script>alert('Registration successful!');</script>";
            // Redirect to the index page to refresh and avoid resubmission
            echo "<script>window.location = 'index.php';</script>";
        } else {
            echo "Error: " . $register_sql . "<br>" . $conn->error;
        }
    }

    // Fetch available events from the Events table
    $sql = "SELECT * FROM Events";
    $result = $conn->query($sql);

    // Display available events in a table
    if ($result->num_rows > 0) {
        echo '<table>';
        echo '<tr>';
        echo '<th>Event Name</th>';
        echo '<th>Description</th>';
        echo '<th>Date</th>';
        echo '<th>Location</th>';
        echo '<th>Registered Attendees</th>';
        echo '<th>Register</th>';
        echo '</tr>';
        while ($row = $result->fetch_assoc()) {
            echo '<tr>';
            echo '<td>' . $row['event_name'] . '</td>';
            echo '<td>' . $row['event_description'] . '</td>';
            echo '<td>' . $row['event_date'] . '</td>';
            echo '<td>' . $row['event_location'] . '</td>';
            echo '<td>';

            // Fetch attendees registered for this event
            $event_id = $row['event_id'];
            $attendees_sql = "SELECT Registrations.registration_id, Attendees.attendee_name, Attendees.attendee_email
                              FROM Registrations
                              INNER JOIN Attendees ON Registrations.attendee_id = Attendees.attendee_id
                              WHERE Registrations.event_id = '$event_id'";
            $attendees_result = $conn->query($attendees_sql);
            
            if ($attendees_result->num_rows > 0) {
                while ($attendee = $attendees_result->fetch_assoc()) {
                    echo '<p>Name: ' . $attendee['attendee_name'] . ', Email: ' . $attendee['attendee_email'] . '<input class="delete_button"type="submit" value="Delete Attendee"></p>';
                    echo '<form method="post" action="delete_attendee.php">';
                    echo '<input type="hidden" name="event_id" value="' . $event_id . '">';
                    echo '<input type="hidden" name="registration_id" value="' . $attendee['registration_id'] . '">';
                    echo '</form>';
                }
            } else {
                echo 'No attendees registered.';
            }
            echo '</td>';

            // Registration form button
            echo '<td>';
            echo '<form method="post" action="index.php">';
            echo '<input type="hidden" name="event_id" value="' . $row['event_id'] . '">';
            echo '<input type="text" name="attendee_name" placeholder="Your name" required><br>';
            echo '<input type="email" name="attendee_email" placeholder="Your Email" required><br>';
            echo '<input type="submit" value="Register">';
            echo '</form>';
            echo '</td>';
            echo '</tr>';
        }
        echo '</table>';
    } else {
        echo '<p>No events available.</p>';
    }

    $conn->close();
    ?>
    </div>
</body>
</html>
