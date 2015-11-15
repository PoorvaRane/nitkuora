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

		if(isset($_GET["topic_name"]))
		{
			
			$user_id = $_SESSION['user'];
			$topic=$_GET["topic_name"];
			$topic_id=$conn->query("select topic_id from topic where topic_name='$topic'")->fetch_assoc();
			$t_id=$topic_id["topic_id"];
			
			$sql1 = "insert into follower_topic (user_id, topic_id) values('$user_id','$t_id')";
			$result = $conn->query($sql1);
			var_dump($result);

			if($result===true){
				
					echo "SUCCESSFULLY FOLLOWED";
					if(isset($_SESSION["stalk"]))
					header("Location: profile1.php?username=".$_SESSION["stalk"]);
				}
				else
			    {
			    ?>
			        <script type="text/javascript">alert('wrong details');</script>
			        <?php
			    }
			 
			
			
		}
		

		$conn->close();
		?>
	</body>
</html>
