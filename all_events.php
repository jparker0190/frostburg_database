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
    <h1>Focused Event View</h1>
	<div class="container"><h3> All events are listed below. Use the sorting buttons to find what you're looking for. <h3></div>
	
	 <?php
    // Database connection
    include 'db.php'; 
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
        echo '<th>Delete Event</th>'; 
        echo '</tr>';
        
        while ($row = $result->fetch_assoc()) {
            echo '<tr>';
            echo '<td>' . $row['event_name'] . '</td>';
            echo '<td>' . $row['event_description'] . '</td>';
            echo '<td>' . $row['event_date'] . '</td>';
            echo '<td>' . $row['event_location'] . '</td>';
            

            echo '<td>';
            echo '<form method="post" action="delete_event.php">';
            echo '<input type="hidden" name="event_id" value="' . $row['event_id'] . '">';
            echo '<input type="submit" value="Delete">';
            echo '</form>';
            echo '</td>';
            
            echo '</tr>';
        }
        
        echo '</table>';
    } else {
        echo '<div class="container"> <p>No events available.</p> </div>';
    }
    echo '<div class="container"><a class="button" href="index.php">Back</a><div>';
    $conn->close();
    ?>
	
</body>
</html>	
