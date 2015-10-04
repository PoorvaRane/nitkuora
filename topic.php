<!DOCTYPE html>
<html>
    <body>
        <?php
        
        // $servername = "localhost";
        // $username = "root";
        // $password = "password";
        // $dbname = "nitkuora";

        // // Create connection
        // $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        echo "done";

        $sql = "SELECT topic_name FROM topic";
        $result = $conn->query($sql);
        //$result=array($result);
        //var_dump($result);
        $topic_list = array();
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                array_push($topic_list, $row["topic_name"]);
                //echo $row["topic_name"];
            }
        } else {
            echo "0 results";
        }
        echo "<br><br>";
        var_dump($topic_list);
        $conn->close();
        ?> 
    </body>
</html>