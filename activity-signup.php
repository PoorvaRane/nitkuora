
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>NITKuora| Home</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- bootstrap 3.0.2 -->
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- Morris chart -->
        <link href="css/morris/morris.css" rel="stylesheet" type="text/css" />
        <!-- jvectormap -->
        <link href="css/jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
        <!-- fullCalendar -->
        <link href="css/fullcalendar/fullcalendar.css" rel="stylesheet" type="text/css" />
        <!-- Daterange picker -->
        <link href="css/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
        <!-- bootstrap wysihtml5 - text editor -->
        <link href="css/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="css/AdminLTE.css" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="skin-blue">
        <!-- header logo: style can be found in header.less -->
        <header class="header">
            <a href="index.php" class="logo">
                <!-- Add the class icon to your logo image or logo icon to add the margining -->
                NITKuora
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                
                
                       
            </nav>
        </header>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="left-side sidebar-offcanvas">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel -->
                   
                </section>
                <!-- /.sidebar -->
            </aside>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
               <!-- Main content -->
                <section class="content">
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
			
			$fullname = $_POST['name'];
			$user_id = $_POST['user_id'];
			$email = $_POST['email'];
			$password =  $_POST['password'];
			$bio =  $_POST['user_bio'];
			$topic = $_POST['topic'];
            if ($_FILES["fileToUpload"]["error"] > 0)
            {
              echo "Error: " . $_FILES["fileToUpload"]["error"] . "<br>";
            }
            else
              {
                

            }
            $image_dir= 'C:\xampp1\htdocs\nitkuora\nitkuora\img\\';
                $image_dir1= 'img/';
                move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $image_dir. $_FILES['fileToUpload']['name']);
                $image = $image_dir1. $_FILES['fileToUpload']['name'];
			$topic_length = count($topic);

			$sql1 = "SELECT * FROM user where user_id = '$user_id'";
			$check = $conn->query($sql1);

			if($check->num_rows > 0){
				echo "Sorry, this user id already exists.";
			}

			else{
				$sql2 = "INSERT INTO user (user_id, name, email, password, picture, bio, no_topics_followed) VALUES ('$user_id', '$fullname','$email','$password','$image','$bio','$topic_length')";
				$result = $conn->query($sql2);

				if($result === TRUE)
				{
					echo '<p>YOUR REGISTRATION IS SUCCESSFUL <br></p>
					<br/> <a href="login.html">Click here to login </a><br/> ';
				}else{
                    echo $conn->error;
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
                 </section>
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->

    


        <!-- jQuery 2.0.2 -->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
        <!-- jQuery UI 1.10.3 -->
        <script src="js/jquery-ui-1.10.3.min.js" type="text/javascript"></script>
        <!-- Bootstrap -->
        <script src="js/bootstrap.min.js" type="text/javascript"></script>
        <!-- Morris.js charts -->
        <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
        <script src="js/plugins/morris/morris.min.js" type="text/javascript"></script>
        <!-- Sparkline -->
        <script src="js/plugins/sparkline/jquery.sparkline.min.js" type="text/javascript"></script>
        <!-- jvectormap -->
        <script src="js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js" type="text/javascript"></script>
        <script src="js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js" type="text/javascript"></script>
        <!-- fullCalendar -->
        <script src="js/plugins/fullcalendar/fullcalendar.min.js" type="text/javascript"></script>
        <!-- jQuery Knob Chart -->
        <script src="js/plugins/jqueryKnob/jquery.knob.js" type="text/javascript"></script>
        <!-- daterangepicker -->
        <script src="js/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
        <!-- Bootstrap WYSIHTML5 -->
        <script src="js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
        <!-- iCheck -->
        <script src="js/plugins/iCheck/icheck.min.js" type="text/javascript"></script>

        <!-- AdminLTE App -->
        <script src="js/AdminLTE/app.js" type="text/javascript"></script>
        
        <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
        <script src="js/AdminLTE/dashboard.js" type="text/javascript"></script>     
        
        <!-- AdminLTE for demo purposes -->
        <script src="js/AdminLTE/demo.js" type="text/javascript"></script>

    </body>
</html>