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
		echo"hi";
		// Check connection
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}

		if(isset($_GET["userid"]))
		{
			
			$user_id = $_SESSION['user'];
			$topic=$_GET["userid"];
			
			
			$sql1 = "insert into follower_following (user1_id, user2_id) values('$user_id','$topic')";
			$result = $conn->query($sql1);

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
