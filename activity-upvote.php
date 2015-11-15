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
        $user_id=$_SESSION["user"];
		// Check connection
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}

		//echo "<h2>YEEESSSS</h2>";
		if(isset($_GET["answerid"]))
                    {
                    	echo "<h2>YEEESSSS</h2>";
                    	$ai=$_GET["answerid"];
                    	$answer=$conn->query("select * from answer where answer_id='$ai'")->fetch_assoc();
                    	$qid=$answer["a_question_id"];
                        $name=$answer["answer_name"];
                        $upvs=$answer["no_upvotes"];
                        $upvs+=1;
                        $re=$conn->query("update answer set no_upvotes='$upvs' where answer_id='$ai'");
                        $re2=$conn->query("insert into upvote (u_user_id,u_answer_id) values('$user_id','$ai') ");
                        if($re===false || $re2===false)
                        {
                            echo '<h3>Sorry, an error occured.</h3>';
                        }
                        else
                        {

                            header("Location: question.php?question_id=$qid");

                        }
                    } 
                             
		

		$conn->close();
		?>
	</body>
</html>
