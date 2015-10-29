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

     $username = $_GET['username']; 
    $user_id = $_SESSION['user'];
    $sql1 = "SELECT * FROM user where user_id = '$user_id'";
    $sql2 = "SELECT topic_name FROM topic WHERE topic_id IN (SELECT topic_id from follower_topic WHERE user_id = '$user_id')";
    $sql3 = "SELECT * FROM user where user_id = '$username'";
    $sql4 = "SELECT topic_name FROM topic WHERE topic_id IN (SELECT topic_id from follower_topic WHERE user_id = '$username')";
    $sql5 = "SELECT * FROM follower_following where user1_id = '$username'";
    $sql6 = "SELECT * FROM follower_following where user2_id = '$username'";
    $result1 = $conn->query($sql1);
    $result2 = $conn->query($sql2);
    $result3 = $conn->query($sql3);
    $result4 = $conn->query($sql4);
    $result5 = $conn->query($sql5);
    $result6 = $conn->query($sql6);
    if($result3->num_rows > 0){
            $newuser_info = $result3->fetch_assoc();
            
        }
    if($result4->num_rows > 0){
            $newtopic_list = array();
            while($row1 = $result4->fetch_assoc()) {
                array_push($newtopic_list, $row1);
            }
        }
         if($result5->num_rows > 0){
            $newfollowers_list = array();
            while($newfollowers = $result5->fetch_assoc()) {
                array_push($newfollowers_list, $newfollowers);
            }
        }
        if($result6->num_rows > 0){
            $newfollowing_list = array();
            while($newfollowing = $result6->fetch_assoc()) {
                array_push($newfollowing_list, $newfollowing);
            }
        }



    if($result1->num_rows > 0){
        $user_info = $result1->fetch_assoc();
        if($result2->num_rows > 0){
            $topic_list = array();
            while($row = $result2->fetch_assoc()) {
                array_push($topic_list, $row);
            }
        }
    } else {
        header("Location: login.html");
        ?>
        <script type="text/javascript">alert('Please login');</script>
        <?php
    }
?>


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
                            <form action="activity-search.php" method="get" class="sidebar-form">
                                <div class="input-group">
                                    <input type="text" name="q" class="form-control" placeholder="Search"/>
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
                            <?php 
                           # $notif=$conn->query("select * from audit where user2_id='$user_id' or user1_id in (select a_user_id from answer where a_question_id in (select question_id from question where q_user_id='$user_id')) or user1_id in (select c_user_id from comment where c_answer_id in (select answer_id from answer where a_user_id='$user_id')) or user1_id in (select c_user_id from comment where c_answer_id in (select answer_id from answer where a_question_id in (select question_id from question where q_user_id='$user_id'))) ");
                             $notif=$conn->query("select * from audit where user2_id='$user_id' or answer_id in (select answer_id from answer where a_question_id in (select question_id from question where q_user_id = '$user_id')) or comment_id in (select comment_id from comment where c_answer_id in (select answer_id from answer where a_user_id='$user_id'))  or comment_id in (select comment_id from comment where c_answer_id in (select answer_id from answer where a_question_id in (select question_id from question where q_user_id='$user_id'))) ");
                          /* 
                             while($no=$notif->fetch_assoc())
                             {
                                echo "u1: ".$no["user1_id"]." u2 ".$no["user2_id"]." qid ".$no["question_id"]. " aid ".$no["answer_id"]." cid ".$no["comment_id"]."\n";
                             }
*/
                            ?>
                            <ul class="dropdown-menu">
                                <li class="header">Notifications</li>
                                
                                <li>
                                <!-- inner menu: contains the actual data -->
                                <ul class="menu">
                                <?php

                                if($notif->num_rows==0)
                                {
                                    echo"<li>";
                                    echo"<a href='#'>";
                                    echo "<i class='ion ion-ios7-people info'></i>" ;
                                    echo "You have none.";
                                    echo"</a>";
                                    echo"</li>";
                                }
                                if ($notif->num_rows>0)
                                {

                                   
                                  while($no=$notif->fetch_assoc())
                                  { 

                                    $user1=$no["user1_id"];
                                    $user2=$no["user2_id"];
                                    $q_id=$no["question_id"];
                                    $a_id=$no["answer_id"];
                                    $t_id=$no["topic_id"];
                                    $c_id=$no["comment_id"];
                            
                                    echo"<li>";
                                    echo"<a href='#'>";
                                    echo "<i class='ion ion-ios7-people info'></i>" ;

                                    if (! is_null($user2))
                                     {
                                        $user1_name=$conn->query("select name from user where user_id='$user1'")->fetch_assoc();
                                        echo $user1_name["name"]." now follows you";
                                     } 
                                  
                                     if (! is_null($a_id))
                                     {
                                        
                                        $answer=$conn->query("select answer_name from answer where answer_id='$a_id'")->fetch_assoc();
                                        $question=$conn->query("select question_name from question where question_id in (select a_question_id from answer where answer_id='$a_id')")->fetch_assoc();
                                        $us=$conn->query("select name from user where user_id='$user1'")->fetch_assoc();
                                        echo "Your question ".$question["question_name"]." got an answer  ".$answer["answer_name"]." posted by ".$us["name"];
                                                                              
                                     }
                                  
                                     if (! is_null($c_id))
                                     {
                                        $comment=$conn->query("select comment_name from comment where comment_id='$c_id'")->fetch_assoc();
                                        $answer=$conn->query("select answer_name from answer where answer_id in (select c_answer_id from comment where comment_id='$c_id')")->fetch_assoc();
                                        $question=$conn->query("select question_name from question where question_id in (select a_question_id from answer where answer_id in (select c_answer_id from comment where comment_id='$c_id'))")->fetch_assoc();
                                        $us=$conn->query("select name from user where user_id='$user1'")->fetch_assoc();
                                        $check=$conn->query("select a_user_id from answer where answer_id in (select c_answer_id from comment where comment_id='$c_id')")->fetch_assoc();
                                        if($check['user_id']==$user_id)
                                        echo $us["name"]." commented ".$comment["comment_name"]." on your answer ".$answer["answer_name"]." to the question ".$question["question_name"];
                                        else
                                        echo $us["name"]." commented ".$comment["comment_name"]." on the answer ".$answer["answer_name"]." to your question ".$question["question_name"];
                                     } 
                                     
                                    echo"</a>";
                                    echo"</li>";
                                  }
                                  
                                }
                                
                    ?>            
                                </ul>
                                </li>
                                        
                            </ul>
                    
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
                                   
                                        <?php
                                            echo $user_info['name']; 
                                            echo "<br>";
                                            echo $user_info['bio'];
                                        ?>
<!--                                         <small>Member since Nov. 2012</small> -->

                                </li>

                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="profile.html" class="btn btn-default btn-flat">Profile</a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="logout.php?logout" class="btn btn-default btn-flat">Sign out</a>
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
                            <p>Hello, <?php echo $user_info['user_id'];  ?></p>
                        </div>
                    </div>
                   <div>
                       <b> Topics Following </b>  
                        <span> <i class="fa fa-arrow-circle-o-right"></i></span>             
                    </div>
                    <div>
                        <ul style="list-style-type: none">

                            <?php
                                foreach ($topic_list as $topic) {
                                    echo "<li>";
                                    echo "<a href='topic.php' id = '".$topic["topic_name"]."'' onclick='markActiveLink(this);'>".$topic["topic_name"]."</a>";
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
                <section class="content">
                     <img-circle>

                </img-circle>
                <div class="col-md-8">
                    <h1>
                        <?php echo $newuser_info["name"]; 
                        
                        ?>
                       
                    </h1>
                </div>

                <div class="col-md-2">
                </div>

                <div class="col-md-2">
                    <br>
                    <a class="btn btn-success btn-flat">Follow</a>
                </div>   
                <hr>
                <br>
                <br>
                    <?php echo "<div class='col-md-12'> Bio: ".$newuser_info["bio"] ."</div>"; 
                     echo "<br>";?>
                     <br />
                     <row>
                    <ul style="list-style-type: none">
                        <div class="col-md-4">
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="glyphicon glyphicon-globe"></i>
                                <span>Topics Following <i class="caret"></i></span>
                            </a>
                            <ul class="dropdown-menu bg-light-blue">
                                <!-- User image -->
                                <li class="user-header bg-light-blue">
                                    <ul style="list-style-type: none">
                            <?php
                                echo "<table>";
                                foreach ($newtopic_list as $newtopic) {
                                    
                                    echo "<tr>";
                                    echo "<td> <a href='topic.php'  style='color:#FFFFFF; text-align:left;' id = '".$newtopic["topic_name"]."'' onclick='markActiveLink(this);'>".$newtopic["topic_name"]."</a> </td>";
                                    echo '<form action="'.$_SERVER['PHP_SELF'].'" method="post">
                                        <td> <button style="text-align:right;" name ="'.$newtopic["topic_name"].'" class="btn btn-success btn-flat">Follow</button> </td>
                                        </form>
                                    ';
                                    if(isset($_POST[$newtopic["topic_name"]])){
                                        $temp = $newtopic["topic_name"];
                                        echo $temp;
                                    }
                                    echo "</tr>";
                                }
                                    echo "</table>";
                            ?>

                                    </ul>
                                    
                                </li>
                               
                            </ul>
                        </li>
                    </div>
                    <div class="col-md-4">
                         <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="glyphicon glyphicon-user"></i>
                                <span>Followers <i class="caret"></i></span>
                            </a>
                            <ul class="dropdown-menu bg-light-blue">
                                <!-- User image -->
                                <li class="user-header bg-light-blue">
                                    <ul style="list-style-type: none">
                            <?php
                                echo "<table>";
                                foreach ($newfollowers_list as $newfollower) {
                                    echo "<tr>";
                                    echo "<td> <a style='color:#FFFFFF; text-align:left;' id = '".$newfollower["user2_id"]."'' onclick='markActiveLink(this);'>".$newfollower["user2_id"]."</a> </td>";
                                    echo '
                                        <td> <button style="text-align:right;" name ="'.$newfollower["user2_id"].'" class="btn btn-success btn-flat">Follow</button> </td>
                                    ';
                                    echo "</tr>";
                                }
                                    echo "</table>";
                            ?>

                                    </ul>
                                    
                                </li>
                               
                            </ul>
                        </li>
                        </div>
                        <div class="col-md-4">
                         <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="glyphicon glyphicon-user"></i>
                                <span>Following <i class="caret"></i></span>
                            </a>
                            <ul class="dropdown-menu bg-light-blue">
                                <!-- User image -->
                                <li class="user-header bg-light-blue">
                                    <ul style="list-style-type: none">
                            <?php
                                echo "<table>";
                                foreach ($newfollowing_list as $newfollowing) {
                                    
                                    echo "<tr>";
                                    echo "<td> <a  style='color:#FFFFFF; text-align:left;' id = '".$newfollowing["user1_id"]."'' onclick='markActiveLink1(this);'>".$newfollowing['user1_id']."</a> </td>";
                                    echo '
                                        <td> <button style="text-align:right;" name ="'.$newfollowing["user1_id"].'" class="btn btn-success btn-flat">Follow</button> </td>
                                    ';
                                    
                                    echo "</tr>";
                                }
                                    echo "</table>";
                            ?>

                                    </ul>
                                    
                                </li>
                            </ul>
                        </li>
                               </div>
                        </ul>
                    </row>
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