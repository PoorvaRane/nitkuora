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

			$sql1 = "SELECT * FROM user where user_id = '$user_id'";
			$check = $conn->query($sql1);

			if($check->num_rows > 0){
				echo "Sorry, this user id already exists.";
			}

			else{
				$sql2 = "INSERT INTO user (user_id, name, email, password, bio, no_topics_followed) VALUES ('$user_id', '$fullname','$email','$password','$bio','$topic_length')";
				$result = $conn->query($sql2);

				if($result === TRUE)
				{
					echo "YOUR REGISTRATION IS SUCCESSFUL <br>";
				}
				
				for($i = 0; $i < count($topic); $i++){
					$sql3 = "SELECT topic_id from topic WHERE topic_name='$topic[$i]'";
					$topic_id = $conn->query($sql3);
					$tem = $topic_id->fetch_assoc();
					$temp = $tem["topic_id"];
					$sql4 = "INSERT INTO follower_topic (user_id, topic_id) VALUES ('$user_id', '$temp')";
					$conn->query($sql4);
				}
			}

		}
		

		$conn->close();
		?>
	</body>
</html>
