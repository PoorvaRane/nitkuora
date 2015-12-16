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
			
			$answer = $_POST['answer'];
			$user = $_SESSION['user'];
			$current_question = $_SESSION['current_question'];
			//var_dump($current_question);

			$sql1 = "SELECT * FROM question WHERE question_name = '$current_question' ";
			$result1 = $conn->query($sql1);

			$temp1 = $result1->fetch_assoc();
			$question_id = $temp1["question_id"];

			$sql2 = "INSERT INTO answer (answer_name, a_question_id, a_user_id) VALUES ('$answer', '$question_id','$user')";
			$result2 = $conn->query($sql2);

			if($result2 === TRUE){
				echo "Answer posted!";
			}else{
				echo $conn->error;
			}
			}

		$conn->close();
		?>
	</body>
</html>
