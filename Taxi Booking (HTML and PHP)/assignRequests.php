<!--
Created by Antonie Chau
AUT ID: 1305095
PHP code for assigning taxis to requests.
Validates the connection modifying the database.
-->
<?php
	require_once('sqlinfo.inc.php');
	$connection = @mysqli_connect($sql_host, $sql_user, $sql_pass, $sql_db);
	
	if (!$connection) {
		echo "<p>Database connection failure</p>";
	} else {		
		$bookingNumber = $_POST["bookID"];		
		$queryOne = "SELECT * FROM $sql_tble WHERE bookingNumber LIKE $bookingNumber";
        $resultOne = mysqli_query($connection, $queryOne) or die("sql error");
		if ($row = mysqli_fetch_row($resultOne) == 0) {
			echo "<p>The booking request #$bookingNumber does not exist!";
		} else {
			while ($row = mysqli_fetch_row($resultOne)) {
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
			$queryTwo = "UPDATE $sql_tble set status = 'assigned' WHERE bookingNumber LIKE '$bookingNumber'";
			$resultTwo = mysqli_query($connection, $queryTwo) or die("sql error");
			if(!$resultTwo) {
			echo "<p>Something is wrong with ",	$queryTwo, "</p>";
			} else {
				echo "<p>Booking request #$bookingNumber has been assigned a taxi.</p>";				
			}
		}
		mysqli_close($connection);
	}
?>