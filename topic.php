<?php

    session_start();
    
    $servername = "localhost";
    $username = "root";
    $password = "password";
    $dbname = "nitkuora";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    //Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    echo "done";

    $topic_name = $_GET['topic_name']; 
    $user_id = $_SESSION['user'];

    $sql1 = "SELECT * FROM user where user_id = '$user_id'";
    $sql = "SELECT * FROM topic where topic_name = '$topic_name'";
    $sql2 = "SELECT topic_name FROM topic WHERE topic_id IN (SELECT topic_id from follower_topic WHERE user_id = '$user_id')";
    $sql3 = "SELECT * FROM question WHERE question_id IN (SELECT question_id from topic_question WHERE topic_id IN (SELECT topic_id from topic WHERE topic_name = '$topic_name'))";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $topic= $result->fetch_assoc();  
        echo "var_dump <br>";
        var_dump($topic);
    } 

    $result1 = $conn->query($sql1);
    $result2 = $conn->query($sql2);
    $result3 = $conn->query($sql3);

    if($result1->num_rows > 0){
        $user_info = $result1->fetch_assoc();
        if($result2->num_rows > 0){
            $topic_list = array();
            while($row = $result2->fetch_assoc()) {
                array_push($topic_list, $row);
            }
        }
    }
?> 


<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>NITKuora | <?php echo $topic_name; ?></title>
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
            <a href="index.html" class="logo">
                <!-- Add the class icon to your logo image or logo icon to add the margining -->
                NITKuora
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <div class="navbar-right">
                    <ul class="nav navbar-nav">
                        <!-- Messages: style can be found in dropdown.less-->
                        <li>
                        <!-- search form -->
                            <form action="#" method="get" class="sidebar-form">
                                <div class="input-group">
                                    <input type="text" name="q" class="form-control" placeholder="Search..."/>
                                    <span class="input-group-btn">
                                        <button type='submit' name='seach' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
                                    </span>
                                </div>
                            </form>
                    <!-- /.search form -->
                        </li>
                        <li>
                        <a href="write.php">
                        <i class="fa fa-pencil"></i>
                        </a>
                        </li>
                        <!-- Notifications: style can be found in dropdown.less -->
                        <li class="dropdown notifications-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-warning"></i>
                                <span class="label label-warning">10</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="header">You have 10 notifications</li>
                                <li>
                                    <!-- inner menu: contains the actual data -->
                                    <ul class="menu">
                                        <li>
                                            <a href="#">
                                                <i class="ion ion-ios7-people info"></i> 5 new members joined today
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <i class="fa fa-warning danger"></i> Very long description here that may not fit into the page and may cause design problems
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <i class="fa fa-users warning"></i> 5 new members joined
                                            </a>
                                        </li>

                                        <li>
                                            <a href="#">
                                                <i class="ion ion-ios7-cart success"></i> 25 sales made
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <i class="ion ion-ios7-person danger"></i> You changed your username
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="footer"><a href="#">View all</a></li>
                            </ul>
                        </li>
                        

                        <!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="glyphicon glyphicon-user"></i>
                                <span> <?php echo $user_info['name']; ?> <i class="caret"></i></span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header bg-light-blue">
                                    <img src="img/avatar3.png" class="img-circle" alt="User Image" />
                                    <p>
                                        <?php
                                            echo $user_info['name']; 
                                            echo "<br>";
                                            echo $user_info['bio'];
                                        ?>
                                        <!-- <small>Member since Nov. 2012</small> -->
                                    </p>
                                </li>

                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="index.html" class="btn btn-default btn-flat">Home</a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="login.html" class="btn btn-default btn-flat">Sign out</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="left-side sidebar-offcanvas">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel -->
                    <div class="user-panel">
                        <div class="pull-left image">
                            <img src="img/avatar3.png" class="img-circle" alt="User Image" />
                        </div>
                        <div class="pull-left info">
                            <p>Hello, <?php echo $user_info['user_id']; ?> </p>
                        </div>

                    </div>
                    <div>
                       <b> Topics Following </b>  
                        <span> <i class="fa fa-arrow-circle-o-right"></i></span>             
                    </div>
                    <div>
                        <ul style="list-style-type: none">

                            <?php
                                foreach ($topic_list as $topicName) {
                                    echo var_dump($topicName["topic_name"]);
                                    echo "<br>";
                                    echo "<li>";
                                    echo "<a href='topic.php' id = '".$topicName["topic_name"]."'' onclick='markActiveLink(this);'>".$topicName["topic_name"]."</a>";
                                    echo "</li>";
                                }
                            ?>
                        </ul>
                    </div>
                   
                   
                </section>
                <!-- /.sidebar -->
            </aside>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
               <!-- Main content -->
                <section class="content-header">
                <img-circle>

                </img-circle>
                    <h1>
                        <?php echo $topic["topic_name"]; ?>
                       
                    </h1>
                    <br>
                    <p>
                        <?php echo $topic["topic_description"]; 
                            echo "<br>";
                        ?> 

                    </p>
                    
                </section>
                <section class="content">

                <?php
                    if ($result3->num_rows > 0) {
                        // output data of each row
                        while($row = $result3->fetch_assoc()) {
                            echo "<div>".$row["question_name"]."</div>";
                        }
                    }
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

        <script type="text/javascript">
            function markActiveLink(el) {   
                var javascriptVariable =  $(el).attr("id");
                window.location.href = "topic.php?topic_name=" + javascriptVariable; 
            }
        </script>



        <?php
            $conn->close();
        ?>

    </body>
</html>