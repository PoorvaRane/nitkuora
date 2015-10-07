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
			$topic_id_list = array();

			$sql = "INSERT INTO question (question_name, q_user_id, no_topic) VALUES ('$question', '$user','$topic_length')";

			$sql3 = "SELECT question_id FROM question WHERE question_name = '$question' AND q_user_id to be continued ";

			foreach ($topic as $topicName) {
				$sql1 = "SELECT topic_id FROM topic WHERE topic_name = '$topicName'";
				$result1 = $conn->query($sql1);
				array_push($topic_id_list, $result1->fetch_assoc());
			}

			for($i=0;$i<$topic_length;$i++){

				$sql2 = "INSERT INTO topic_question (topic_id, question_id) VALUES ('$topic_id_list[$i]', '' ) "; 

			}

			

			$result = $conn->query($sql);

			if($result === TRUE){
				echo "YOUR QUESTION WAS SUCCESSFULLY POSTED. <br>";
			}
		}
		

		$conn->close();
		?>
	</body>
</html>
