<!DOCTYPE html>
<html>
    <body>
		<?php

		session_start();
		
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
			
			$question = $_POST['question'];
			$topic = $_POST['topic'];
			$user = $_SESSION['user'];

			$topic_length = count($topic);

			$sql2 = "INSERT INTO question (question_name, q_user_id, no_topic) VALUES ('$question', '$user','$topic_length')";
			$result = $conn->query($sql2);

			if($result === TRUE){
				echo "YOUR QUESTION WAS SUCCESSFULLY POSTED. <br>";
			}
		}
		

		$conn->close();
		?>
	</body>
</html>
