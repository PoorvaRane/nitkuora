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

			$sql3 = "SELECT question_id FROM question WHERE question_name = '$question' ";

			$result3 = $conn->query($sql3);

			if ($result3->num_rows > 0) {
				echo "This question already exists.";
			}
			else {
				$result = $conn->query($sql);
				$result3 = $conn->query($sql3);				
				$temp1 =  $result3->fetch_assoc();
				$question_id = $temp1["question_id"];
				
				foreach ($topic as $topicName) {
					$sql1 = "SELECT topic_id FROM topic WHERE topic_name = '$topicName'";
					$result1 = $conn->query($sql1);
					$temp = $result1->fetch_assoc();
					array_push($topic_id_list, $temp["topic_id"]);
				}

				for($i=0;$i<$topic_length;$i++){

					$sql2 = "INSERT INTO topic_question (topic_id, question_id) VALUES ('$topic_id_list[$i]', '$question_id' ) "; 

					$result2 = $conn->query($sql2);

				}

				if($result === TRUE and $result2 === TRUE){
					echo "YOUR QUESTION WAS SUCCESSFULLY POSTED. <br>";
				}
			}

		}

		$conn->close();
		?>
	</body>
</html>
