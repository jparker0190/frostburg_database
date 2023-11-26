<?php include 'db.php'; ?>

<!DOCTYPE html>
<html>
<head>
    <title>Event Registration</title>
</head>
<body>
    <h2>Register for an Event</h2>
    <form method="post" action="process_registration.php">
        <label for="event_id">Event ID:</label>
        <input type="text" name="event_id"><br><br>

        <label for="attendee_id">Attendee ID:</label>
        <input type="text" name="attendee_id"><br><br>

        <input type="submit" value="Register">
    </form>
</body>
</html>
