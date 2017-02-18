<html>
	<head>
		<title>Post Status Processed</title>
	</head>
	
	<body>
		<h1>Post Status Process</h1>
			<?php			
			$sql_host = "127.0.0.1";
			$sql_user = "root";
			$sql_pass = "";
			$sql_db   = "test";
			$sql_tble = "assign1";
				
			$connection = @mysqli_connect($sql_host, $sql_user, $sql_pass, $sql_db);
				
				if (!$connection) {
					echo "<p>Connecting to the Database has failed</p>";
				} else {
					if (isset ($_POST["statusCode"])) {
						$statusCode = $_POST["statusCode"];	
						$codePattern = "/^S[0-9]{4}+$/";
							if (!preg_match($codePattern, $statusCode)) {
								$statusCode = null;
							}
					}
					if (isset ($_POST["status"])) {
						$status = $_POST["status"];
						$statusPattern = "/^[a-zA-Z0-9?!,. ]+$/";
							if (!preg_match($statusPattern, $status)) {
								$status = null;
							}
					}
					if (isset ($_POST["date"])) {
						$date = $_POST["date"];
						$datePattern = "/[0-9]{2}\/[0-9]{2}\/[0-9]{2}/";
							if (!preg_match($datePattern, $date)) {
								$date = null;
							}
					}
					$permit = null;
					if (isset ($_POST["permission"])) {
						$permission = $_POST["permission"];
							for ($i=0; $i<count($permission); $i++) {
								$permit .= $permission[$i];
							}
					}
					if (isset ($_POST["shareType"])) {
						$shareType = $_POST["shareType"];
					} else {
						$shareType = null;
					}
					if ($statusCode != null && $status != null && $date != null) {
						$query = "insert into $sql_tble"
							."(statusCode, status, shareType, date, permit)"
								. "values"
									."('$statusCode', '$status', 
									'$shareType', '$date', '$permit')";
						$result = @mysqli_query($connection, $query);
							if(!$result) {
							echo "<p>An error with executing the command ", $query, " has occurred.</p>";
							} else {						
								echo "<p>Your status has been created and saved.</p>";
							}
					} else {
						if ($statusCode == null) {
							echo "<p>Please enter a Status Code! A status code must contain an S followed by 4 numbers e.g. S1234</p>";
						}
						if ($status == null) {
							echo "<p>You must enter a status, it can not be left blank. e.g. Doing my assignment</p>";
						}
						if ($date == null) {
							echo "<p>The date format you entered is incorrect. The correct format is: dd/mm/yy e.g. 02/05/15</p>";
						}
					}
				}
				mysqli_close($connection);
			?>		
		
		<br><a href="poststatusform.php">Return to Form</a>
		<br><a href="index.php">Return to Home Page</a>
	</body>
</html>