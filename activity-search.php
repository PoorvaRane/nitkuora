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

		if(isset($_POST['seach']))
		{

			echo "<h2>YES1</h2>";
			$user_id = $_SESSION["user"];
			$search=$_POST["q"];

			$sql1 = "SELECT * FROM question where question_name = '$search'";
			$sql2= "SELECT * FROM user where name = '$search' or user_id='$search'";
			$sql3="SELECT * FROM topic where topic_name = '$search'";

			$result1=$conn->query($sql1);
			$result2=$conn->query($sql2);
			$result3=$conn->query($sql3);

			
			

		echo "<ul style='list-style-type: none'>";

            if($result1->num_rows>0)
            {	
	            while($ques=$result1->fetch_assoc()) 
	            {
	                echo "<li>";
	                echo "<a id = '".$ques["question_id"]."'' onclick='question(this);'>".$ques["question_name"]."</a>";
	                echo "</li>";
	            }
			}            

			if($result2->num_rows>0)
            {	
	            while($us=$result2->fetch_assoc()) 
	            {
	                echo "<li>";
	                echo "<a id = '".$us["user_id"]."'' onclick='user(this);'>".$us["name"]."</a>";
	                echo "</li>";
	            }
			}   

			if($result3->num_rows>0)
            {	
	            while($to=$result3->fetch_assoc()) 
	            {
	                echo "<li>";
	                echo "<a id = '".$to["topic_id"]."'' onclick='topic(this);'>".$to["topic_name"]."</a>";
	                echo "</li>";
	            }
			}   



        echo "</ul>";
			    
			 
			
			
		}
		

		$conn->close();
		?>
	</body>
</html>
<script>
function question(el) {   
                var javascriptVariable =  $(el).attr("id");
                window.location.href = "question.php?question_id=" + javascriptVariable; 
            }
function user(el) {   
                var javascriptVariable =  $(el).attr("id");
                window.location.href = "profile1.php?username=" + javascriptVariable; 
            }
function topic(el) {   
                var javascriptVariable =  $(el).attr("id");
                window.location.href = "topic.php?topic_name=" + javascriptVariable; 
            }
</script>