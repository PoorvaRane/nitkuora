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
        $user_id=$_SESSION["user"];
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}

		if(isset($_GET["answerid"]))
                    {
                    	$ai=$_GET["answerid"];
                    	$answer=$conn->query("select * from answer where answer_id='$ai'")->fetch_assoc();
                    	$qid=$answer["a_question_id"];
                        $name=$answer["answer_name"];
                        $downvs=$answer["no_downvotes"];
                        $downvs+=1;
                        $re=$conn->query("update answer set no_downvotes='$downvs' where answer_id='$ai'");
                        $re2=$conn->query("insert into downvote (d_user_id,d_answer_id) values('$user_id','$ai') ");
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
