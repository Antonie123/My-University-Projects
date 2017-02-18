<html>
	<head>
		<title>Status Posting System</title>
	</head>
	
	<body>
		<h1>Status Posting System</h1>
			<form action="poststatusprocess.php" method="post">		
			<label>Status Code (required): <input type="text" name="statusCode" placeholder="e.g. S1234 (Only 4 digits)"></label>
			<br><label>Status (required): <input type="text" name="status" placeholder="e.g. Doing my assignment!"></label>
			<p><label>Share: <input type="Radio" name="shareType" value="Public">Public
			<input type="Radio" name="shareType" value="Friends">Friends
			<input type="Radio" name="shareType" value="Only Me">Only Me</label></p>
			<label>Date: <input type="text" name="date" value="<?php echo date('d/m/y');?>"></label>
			<p><label>Permission Type: <input type="checkbox" name="permission[]" value="Like">Allow Like
			<input type="checkbox" name="permission[]" value="Comment">Allow Comment
			<input type="checkbox" name="permission[]" value="Share">Allow Share</label></p>
			<input type="submit" value="Post">
			<input type="reset" value="Reset">
		</form>
			<a href="index.php">Home</a>
	</body>
</html>