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

		$ans = $_GET["a_id"];


		$sql = "select * from upvoters";
		$result = $conn->query($sql);

		if($result->num_rows > 0){
			echo "<h1> The upvoters for this answer are </h1>";
			echo "<ul style='list-style-type:none;'>";
			while($temp = $result->fetch_assoc()){
				echo "<li>".$temp['name']."</li>";
			}
		}

		$conn->close();


?>