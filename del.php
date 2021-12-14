<!doctype html>
<link rel="stylesheet" href="styles.css">


<html>
    <?php
        $ID = $_POST["ID"];
        // creates the connection
        $conn = new mysqli("localhost", "user1", "1234" , "project");
       
        // checks the connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } else{
            echo "<p>successful connection</p>";
        }
        $sql = "DELETE FROM lessons WHERE ID = '".$ID."'";
        $result = $conn->query($sql);
        
        if ($conn->query($sql) == TRUE){
            echo "<p>transaction complete</p>";
            header("Location: editdb.php");
            die();}  
    ?>
</html>