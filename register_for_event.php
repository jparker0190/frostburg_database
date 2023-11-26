<?php include 'db.php'; ?>

<!DOCTYPE html>
<html>
<head>
    <title>Register for Event</title>
</head>
<body>
    <h2>Register for an Event</h2>
    <form method="post" action="process_event_registration.php">
        <label for="event_id">Event ID:</label>
        <input type="text" name="event_id"><br><br>

        <label for="attendee_name">Your Name:</label>
        <input type="text" name="attendee_name"><br><br>

        <label for="attendee_email">Your Email:</label>
        <input type="email" name="attendee_email"><br><br>

        <input type="submit" value="Register">
    </form>
</body>
</html>
