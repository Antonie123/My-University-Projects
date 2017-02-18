<!--
Created by Antonie Chau
AUT ID: 1305095
PHP code for showing all the booking request in the database.
Validates the connection before echoing the results.
-->
<?php
	require_once('sqlinfo.inc.php');
	$connection = @mysqli_connect($sql_host, $sql_user, $sql_pass, $sql_db);
	
	if (!$connection) {
		echo "<p>Database connection failure</p>";
	} else {
		$query = "SELECT * FROM $sql_tble WHERE status = 'unassigned'";
        $result = mysqli_query($connection, $query) or die("sql error");                    
		while ($row = mysqli_fetch_array($result)) {
			echo "<p></p>";
			echo "<table border='2'><tr>";
			echo "<td>Booking ID: </td>";
			echo "<td>Customer Name: </td>";
			echo "<td>Contact Phone: </td>";
			echo "</tr><tr>";
			echo "<td><center>" . $row["bookingNumber"] . "</center></td>";
			echo "<td><center>" . $row["customerName"] . "</center></td>";
			echo "<td><center>" . $row["contactPhone"] . "</center></td>";
			echo "</tr><tr>";
			echo "<td>Pickup Suburb: </td>";
			echo "<td>Destination Suburb: </td>";
			echo "<td>Pick-up Date/Time: </td>";
			echo "</tr><tr>";			
			echo "<td><center>" . $row["pickupAddress"] . "</center></td>";
			echo "<td><center>" . $row["destinationSuburb"] . "</center></td>";
			echo "<td><center>" . $row["pickupDateTime"] . "</center></td>";
			echo "</table>";
		}
		mysqli_close($connection);
	}
?>