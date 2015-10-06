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
			
			$user_id = $_POST['user_id'];
			$password =  $_POST['password'];

			$sql1 = "SELECT * FROM user where user_id = '$user_id'";
			$result = $conn->query($sql1);

			if($result->num_rows > 0){
				$check = $result->fetch_assoc();
				if($password == $check["password"]){
					$_SESSION['user'] = $check['user_id'];
					echo "SUCCESSFULLY LOGGED IN";
					header("Location: index.php");
				}
				else
			    {
			    ?>
			        <script type="text/javascript">alert('wrong details');</script>
			        <?php
			    }
			 
			}
			else{
				?>
				<script type="text/javascript">alert('Sorry, this User ID does not exist.');</script>
				<?php
			}
		}
		

		$conn->close();
		?>
	</body>
</html>
