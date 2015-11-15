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
			
			$comment = $_POST['comment'];
			$user = $_SESSION['user'];
			$current_answer = $_SESSION['current_answer'];

			$sql1 = "SELECT answer_id FROM answer WHERE answer_name = '$current_answer' ";
			$result1 = $conn->query($sql1);
			$temp1 = $result1->fetch_assoc();
			$answer_id = $temp1["answer_id"];

			$sql2 = "INSERT INTO comment (comment, c_answer_id, c_user_id) VALUES ('$comment', '$current_answer','$user')";

			$result2 = $conn->query($sql2);

			if($result2 === TRUE){
				echo "Comment posted!";
				echo $current_answer;
			}
		}

		$conn->close();
		?>
	</body>
</html>
