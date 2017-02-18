<!--
Created by Antonie Chau
AUT ID: 1305095
PHP code for adding the booking request into the database
Validates the connection, then inputs all the data and outputs whether it was successful or not
-->
<?php
require_once('sqlinfo.inc.php');
$connection = @mysqli_connect($sql_host, $sql_user, $sql_pass, $sql_db);		
	if (!$connection) {
		echo "<p>Database connection failure</p>";
	} else {
		$custName = $_POST["name"];
		$conNumber = (int)$_POST["phone"];
		$streetAdd = (string)$_POST["streetAdd"];
		$destSub = $_POST["destSuburb"];
		$pickupDateTime = $_POST["puDateTime"];
		$pickupDate = $_POST["puDate"];
		$pickupTime = $_POST["puTime"];
		$status = "unassigned";
		$query = "INSERT into $sql_tble" . "(customerName, contactphone, pickupAddress, destinationSuburb, pickupDateTime, status)" 
		. "values" . "('$custName', '$conNumber', '$streetAdd', '$destSub', '$pickupDateTime', '$status')";		
		$result = @mysqli_query($connection, $query);
		$bookingID = mysqli_insert_id($connection);		
	if(!$result) {
		echo "<p>Something is wrong with ",	$query, "</p>";
	} else {
		echo "<p>Thank you! Your booking reference number is $bookingID.
			You will be picked up in front of your provided address at '$pickupTime' on '$pickupDate'.</p>";		
	}		
	}
	mysqli_close($connection);
?>