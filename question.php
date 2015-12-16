<?php

    ob_start();

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
    
    $question_id = $_GET['question_id']; 
    $question_id2 = $question_id;
    $user_id = $_SESSION['user'];

  

    $sql = "SELECT * FROM question where question_id = '$question_id'";
    $sql1 = "SELECT * FROM user where user_id = '$user_id'";
    $sql2 = "SELECT * from answer where a_question_id='$question_id'";
    $sql3="SELECT topic_name from topic where topic_id in (SELECT topic_id from topic_question where question_id='$question_id')";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $question2= $result->fetch_assoc();  
    } 

    $result1 = $conn->query($sql1);
    $result2 = $conn->query($sql2);
    $result3= $conn->query($sql3);

    if($result1->num_rows > 0){
        $user_info = $result1->fetch_assoc();
        
        
    }
?> 


<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>NITKuora | <?php echo $question_id; ?></title>
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
                            <form action="activity-search.php" method="post" class="sidebar-form">
                                <div class="input-group">
                                    <input type="text" name="q" class="form-control" placeholder="Search"/>
                                    <span class="input-group-btn">
                                        <input type='submit' name='seach' id='search-btn' value='Search' class="btn btn-flat"/>
                                    </span>
                                </div>

                            </form>                    <!-- /.search form -->
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
                                <span class="label label-warning"></span>
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
                                        $question=$conn->query("select * from question q join answer a on q.question_id=a.a_question_id where a.answer_id = '$a_id'")->fetch_assoc(); 

                                        $us=$conn->query("select name from user where user_id='$user1'")->fetch_assoc();
                                        echo "Your question ".$question["question_name"]." got an answer  ".$answer["answer_name"]." posted by ".$us["name"];
                                                                              
                                     }
                                  
                                     if (! is_null($c_id))
                                     {
                                        $comment=$conn->query("select comment from comment where comment_id='$c_id'")->fetch_assoc();
                                        $answer=$conn->query("select * from answer a join comment c on a.answer_id = c.c_answer_id where comment_id = '$c_id'")->fetch_assoc();

                                        $question=$conn->query("select * from question q join answer a on a.a_question_id = q.question_id join comment c on a.answer_id = c.c_answer_id where comment_id='$c_id'")->fetch_assoc();


                                        $us=$conn->query("select name from user where user_id='$user1'")->fetch_assoc();
                                        $check=$conn->query("select a_user_id from answer where answer_id in (select c_answer_id from comment where comment_id='$c_id')")->fetch_assoc();

                                        if($check['a_user_id']==$user_id)
                                        echo $us["name"]." commented ".$comment["comment"]." on your answer ".$answer["answer_name"]." to the question ".$question["question_name"];
                                        else
                                        echo $us["name"]." commented ".$comment["comment"]." on the answer ".$answer["answer_name"]." to your question ".$question["question_name"];
                                     } 
                                     
                                    echo"</a>";
                                    echo"</li>";
                                  }
                                  
                                }
                                
                    ?>            
                                </ul>
                                </li>
                                        
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
                                     <?php echo '<img src= '.$user_info['picture'].' class="img-circle" alt="User Image"/>';?>
                                    
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
                                        <a href="profile.php" class="btn btn-default btn-flat">Profile</a>
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
                             <?php echo '<img src= '.$user_info['picture'].' class="img-circle" alt="User Image"/>';?>
                                    
                        </div>
                        <div class="pull-left info">
                            <p>Hello, <?php echo $user_info['user_id']; ?> </p>
                        </div>

                    </div>
                    <div>
                       <b> Topics tagged to question</b>  
                        <span> <i class="fa fa-arrow-circle-o-right"></i></span>             
                    </div>
                    <div>
                        <ul style="list-style-type: none">

                            <?php
                            if($result3->num_rows==0)
                                echo"<li><h1>ayyyooo</h1>";
                            if($result3->num_rows>0)
                            {
                                
                                while($to=$result3->fetch_assoc()) 
                                {
                                    echo "<li>";
                                    echo "<a id = '".$to["topic_name"]."'' onclick='markActiveLink(this);'>".$to["topic_name"]."</a>";
                                    echo "</li>";
                                }
                            }
                            ?>
                        </ul>
                    </div>
                 
                   
                </section>
                <!-- /.sidebar -->
            </aside>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
               <section class="content">
                               <img-circle>

                </img-circle>
              <div class="row">  <div class="col-sm-10"> <h3 >
                        <?php echo $question2["question_name"]; ?>
                       
                    </h3></div>
                                      
                     <?php echo '<br><div class="col-sm-2"><a class="btn btn-success" name="answer" onclick="sendQuestion(this);" id="'.$question2["question_name"].'">Answer</a>
                            </div>'; ?>
                </div>
              
                <hr>
                    <?php

                    if($result2->num_rows > 0)
                    {
                    echo "<dl>";
                    while($answer=$result2->fetch_assoc())
                    {
                        $ua=$answer["a_user_id"];
                        $un=$conn->query("select name from user where user_id='$ua'")->fetch_assoc();
                        $ai=$answer["answer_id"];
                        //echo "<h2>'$ai'</h2>";
                        $name=$answer["answer_name"];
                        $upvs=$answer["no_upvotes"];
                        $dovs=$answer["no_downvotes"];
                        
                        echo '<dt class="col-sm-10">';
                        echo"'$name'";
                        echo"</dt>";
                        echo'<dd class="col-sm-10">'.$un["name"]."</dd>";
                        echo '<div class="col-sm-2" > Upvotes:- '.$upvs.' 
                         Downvotes:-'.$dovs;
                        $str="question.php?question_id=".$question_id;
                        //echo "<h2>$str</h2>";
                        $ch=
                        $vcheck=$conn->query("select * from upvote where u_user_id='$user_id' and u_answer_id='$ai'");
                        $vdcheck=$conn->query("select * from downvote where d_user_id='$user_id' and d_answer_id='$ai'");
                        if($vcheck->num_rows==0 && $vdcheck->num_rows==0 )
                        {
                            
                            echo "<a id = '".$ai."'' onclick='upvote(this);''>  <button style='text-align:right;'  name ='up'  class='btn btn-success btn-flat'>UpVote</button></a>";
                            echo "<a id = '".$ai."'' onclick='downvote(this);''>  <button style='text-align:right;'  name ='down'  class='btn btn-success btn-flat'>DownVote</button></a>";

                        }
                        
                       
                        
                        echo '</div>';
                        echo '<div class="col-sm-2"><a class="btn btn-success" name="comment" onclick="sendComment(this);" id="'.$answer["answer_id"].'">View Comments</a>
                            </div>';
                        echo "<br/>";
                        echo "<hr/>";
                        echo "<br> <br> <br> <br> <br> <br>";
                        

                    }
                    echo "</dl>";
                    }
                    echo "<br><br>";
                    
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

            function sendQuestion(el) {   
                var javascriptVariable =  $(el).attr("id");
                window.location.href = "answer.php?question=" + javascriptVariable; 
            }

            function sendComment(el) {   
                var javascriptVariable =  $(el).attr("id");
                window.location.href = "writecomment.php?answer=" + javascriptVariable; 
            }
            function disableup()
            {
                document.getElementById('up').disabled = true;

            }
            function disabledown()
            {
                document.getElementById('down').disabled = true;

            }
            function upvote(el) 
            {   
                
                var javascriptVariable =  $(el).attr("id");
                window.location.href = "activity-upvote.php?answerid=" + javascriptVariable;

            }
            function downvote(el) 
            {   
                
                var javascriptVariable =  $(el).attr("id");
                window.location.href = "activity-downvote.php?answerid=" + javascriptVariable;

            }

             function sendu(el) {   
                var javascriptVariable =  $(el).attr("id");
                window.location.href = "view.php?a_id=" + javascriptVariable; 
            }

            function sendd(el) {   
                var javascriptVariable =  $(el).attr("id");
                window.location.href = "view.php?a_id=" + javascriptVariable; 
            }


        </script>



        <?php
            $conn->close();
        ?>

    </body>
</html>