<html>
	<head>
		<title>Search Status Processed</title>
	</head>
	
	<body>
		<h1>Status Information</h1>		
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
					$search = $_GET["search"];					
						if (empty ($_GET["search"])) {
							echo "<p>You did not enter anything to search.</p>";
					} else {					
						echo "<p>Results for: ", $search, "</p>";					
						$query = "select * from $sql_tble where status like '$search'";
						$result = mysqli_query($connection, $query);
						
						if (!$result) {
							echo "<p>An error with executing the command ", $query, " has occurred.</p>";
						} else {
							if (mysqli_num_rows($result)==0) {
								echo "<p>Your search has resulted in no matches.</p>";
							} else {
								echo "<table border=\"2\">";
									
								while ($row = mysqli_fetch_assoc($result)) {
									echo "<tr>";
									echo "<td>Status: ", $row["status"], "</td>";
									echo "<td>StatusCode: ", $row["statusCode"], "</td>";
									echo "<td>Share: ", $row["shareType"], "</td>";
									echo "<td>Date: ", $row["date"], "</td>";
									echo "<td>Permission: ", $row["permit"], "</td>";
									echo "</tr>";
								}
							}
						}
						echo "</table>";
					}
				}	
				mysqli_close($connection);
			?>	
		<br><a href="searchstatusform.php">Search again</a>
		<br><a href="index.php">Return to Home Page</a>
	</body>
</html>