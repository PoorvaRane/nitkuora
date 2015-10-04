<!DOCTYPE html>
<html>
    <body>
		<?php

		$servername = "localhost";
		$username = "root";
		$password = "password";
		$dbname = "nitkuora";

		// Create connection
		$conn = new mysqli($servername, $username, $password, $dbname);
		// Check connection
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}

		if(isset($_POST['submit']))
		{
			$fullname = $_POST['name'];
			$user_id = $_POST['user_id'];
			$email = $_POST['email'];
			$password =  $_POST['password'];
			$bio =  $_POST['user_bio'];
			$topic = $_POST['topic'];

			$topic_length = count($topic);

			$sql = "INSERT INTO user (user_id, name, email, password, bio, no_topics_followed) VALUES ('$user_id', '$fullname','$email','$password','$bio','$topic_length')";

			$result = $conn->query($sql);

			if($result === TRUE)
			{
				echo "YOUR REGISTRATION IS SUCCESSFUL";
			}
		}
		

		$conn->close();
		?>
	</body>
</html>
