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
	<p> All events are listed below. Use sorting buttons to find what you're looking for <p>
	
	 <?php
    // Database connection
    include 'db.php'; // Include your database connection file // Fetch available events from the Events table
    $sql = "SELECT * FROM Events";
    $result = $conn->query($sql);
	//$sort = $_GET['sort']; 
	
	
 
if (isset($_GET['sort'])) {

	if ($_GET['sort'] == 'name')
				{
					$sql .= " ORDER BY event_name";
				}
				elseif ($_GET['sort'] == 'desc')
				{
					$sql .= " ORDER BY event_description";
				}
				elseif ($_GET['sort'] == 'date')
				{
					$sql .= " ORDER BY event_date";
				}
				elseif($_GET['sort'] == 'loc')
				{
					$sql .= " ORDER BY event_location";
				}

				$result = $conn->query($sql);
}  
    // Display available events in a table
    if ($result->num_rows > 0) {
        echo '<table>';
        echo '<tr>';
        echo '<th><a href="all_events.php?sort=name">Sort By Event Name:</a></th>';
        echo '<th><a href="all_events.php?sort=desc">Sort By Event Description:</a></th>';
        echo '<th><a href="all_events.php?sort=date">Sort By Event Date:</a></th>';
        echo '<th><a href="all_events.php?sort=loc">Sort By Event Location:</a></th>';
        echo '</tr>';
        while ($row = $result->fetch_assoc()) {
            echo '<tr>';
            echo '<td>' . $row['event_name'] . '</td>';
            echo '<td>' . $row['event_description'] . '</td>';
            echo '<td>' . $row['event_date'] . '</td>';
            echo '<td>' . $row['event_location'] . '</td>';
          
		}
		
			
		
	}else {
        echo '<p>No events available.</p>';
}
$conn->close();	
	?>
	
</body>
</html>	
