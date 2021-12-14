<!doctype html>

<?php
$cookie_name = "sessionID";
if(!isset($_COOKIE[$cookie_name])) {
    echo "Cookie named sessionID is not set!";
} else {
     echo "Cookie sessionID is set!<br>";
     echo "Value is: " . $_COOKIE[$cookie_name];
   }
?>

<html>
    <?php
        // creates the connection
        $conn = new mysqli("localhost", "user1", "1234" , "project");
       
        // checks the connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } else{
            echo "<p>successful connection</p>";
        }
        $sql = "UPDATE users set cookie = NULL WHERE cookie = '".$_COOKIE[$cookie_name]."'";
        $result = $conn->query($sql);
        
        if ($conn->query($sql) == TRUE){
            echo "<p>transaction complete</p>";
            header("Location: index.php");
            die();}  
    ?>
</html>