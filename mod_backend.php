<!doctype html>

<html>
    <?php
        $ID = $_POST["ID"];
        $name = $_POST["name"];
        $email = $_POST["email"];
        $location = $_POST["location"];
        $instrument = $_POST["instrument"];

        // creates the connection
        $conn = new mysqli("localhost", "user1", "1234" , "project");
       
        // checks the connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } else{
            echo "<p>successful connection</p>";
        }
        $sql = "SELECT ID FROM teacher WHERE name = '".$name."' AND contact_email = '".$email."'";
        $result = $conn->query($sql);
        
        if ($result->num_rows == 0) {
            global $teacherid;
            $sql = "INSERT INTO teacher (name,contact_email) VALUES ('".$name."','".$email."')";
            $result = $conn->query($sql);
            $sql = "SELECT LAST_INSERT_ID()";
            $teacherid = $conn->query($sql);
        }else{
            global $teacherid;
            $row = $result->fetch_assoc();
            $teacherid = $row['ID'];
        }

        $sql = "SELECT ID FROM location WHERE location = '".$location."'";
        $result = $conn->query($sql);

        if ($result->num_rows == 0) {
            global $locationid;
            $sql = "INSERT INTO location (location) VALUES ('".$location."')";
            $result = $conn->query($sql);
            $sql = "SELECT LAST_INSERT_ID()";
            $locationid = $conn->query($sql);
        } else{
            global $locationid;
            $row = $result->fetch_assoc();
            $locationid = $row['ID'];
        }
        echo "id";
        echo $ID;
        echo "<br>";
        echo "teach";
        echo $teacherid;
        echo "<br>";
        echo "location";
        echo $locationid;
        echo "<br>";
        echo "instrument";
        echo $instrument;
        echo "<br>";

        $sql = "UPDATE lessons set teacherid = '".$teacherid."', locationid = '".$locationid."', instrument = '".$instrument."' WHERE ID = '".$ID."'";     
        $result = $conn->query($sql);
        if ($conn->query($sql) == TRUE){
            echo "<p>transaction complete</p>";
            header("Location: editdb.php");
            die();
        }

        header("Location: editdb.php");
        die();
        
    ?>
</html>