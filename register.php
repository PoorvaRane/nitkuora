<!DOCTYPE html>
<html class="bg-black">
    <head>
        <meta charset="UTF-8">
        <title>NITKuora | Sign Up</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- bootstrap 3.0.2 -->
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="css/AdminLTE.css" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="bg-black">

        <div class="form-box" id="login-box">
            <div class="header">Sign Up</div>
            <form action="activity-signup.php" method="post">
                <div class="body bg-gray">
                    <div class="form-group">
                        <input type="text" id = "name" name="name" class="form-control" placeholder="Full name"/>
                    </div>
                    <div class="form-group">
                        <input type="text" id = "user_id" name="user_id" class="form-control" placeholder="User ID"/>
                    </div>
                    <div class="form-group">
                        <input type="email" name="email" class="form-control" placeholder="E-mail id"/>
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" class="form-control" placeholder="Password"/>
                    </div>
                     <div class="form-group">
                        <input type="password" name="password2" class="form-control" placeholder="Retype password"/>
                    </div>
                    <div class="form-group">
                        <label for="bio">About Me:</label>
                        <textarea id="user_bio" name="user_bio" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="bio">Profile Picture:</label>
                        <input type="file" name="fileToUpload" id="fileToUpload" />
                    </div>
                    <div class="form-group">
                        <label>Select the topics that you want to follow:</label><br>
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

								$sql = "SELECT topic_name FROM topic";
								$result = $conn->query($sql);

								if ($result->num_rows > 0) {
									// output data of each row
									while($row = $result->fetch_assoc()) {
										echo "<input type='checkbox' id=".$row["topic_name"]." value=".$row["topic_name"]." name='topic[]'>".$row["topic_name"]."<br>";
									}
								} else {
									echo "0 results";
								}
								$conn->close();
							?> 
                    </div>
                    
                <div class="footer">                   

                    <button type="submit" class="btn bg-blue btn-block" name="submit">Sign me up</button>

                    <a href="login.html" class="text-center">I already have an account</a>
                </div>
            </form>

                    </div>


        <!-- jQuery 2.0.2 -->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="../../js/bootstrap.min.js" type="text/javascript"></script>

    </body>
</html>




