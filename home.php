<!doctype html>
<link rel="stylesheet" href="styles.css">

<?php
//tests if the cookie is set
$cookie_name = "sessionID";
if(!isset($_COOKIE[$cookie_name])) {
    echo "Cookie named sessionID is not set!";
    header("Location: index.php");
    die();
} //else {
 // echo "Cookie sessionID is set!<br>";
  //echo "Value is: " . $_COOKIE[$cookie_name];
//}
?>

<html>
    <body>
        <?php
        // Create connection
        $conn = new mysqli("localhost", "user1", "1234", "project");

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } //else{
          //  echo "<p>Successful db connection</p>";
       // }?>
        <h1>Home page</h1>
        <?php
        //gets the email that matches the cookie
        $sql = "SELECT email FROM users WHERE cookie = '".$_COOKIE["sessionID"]."'";
        $result = $conn->query($sql);
        $row =  $result->fetch_assoc();
        //if that cookie isn't associated with any user it returns them to the front login page
        if ($row["email"] == "") {
            header("Location: index.php");
            die();
        }
        ?>
        <br>
        <br>
        
        <form action="search.php" method = "post">
        Search: <input type="text" name="qir">
        
        <label for="field">Choose a field:</label>
        <select name="field" id="field"> 
            <option value="teacher.name">Teacher name</option>
            <option value="lessons.instrument">Instrument</option>
            <option value="teacher.contact_email">Teacher Email</option>
            <option value="location.location">Location</option>
            
        </select>
        <input type="submit" value="Search">
        </form>
        <br>
        <?php
        //gets all the informtaion in the linked tables and displays it
        $sql = "SELECT lessons.instrument, teacher.name, teacher.contact_email, location.location FROM lessons, teacher, location WHERE lessons.teacherid = teacher.ID AND lessons.locationid = location.ID";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            // output data of each row
            
            //prints the table
            echo "<table><tr><th>Name</th><th>Intstrument</th><th>Email</th><th>Location</th></tr>";
            while($row = $result->fetch_assoc()) {
                echo "<tr><td>".$row["name"]."</td><td>".$row["instrument"]."</td><td>".$row["contact_email"]."</td><td>".$row["location"]."</td></tr>";
            }
            echo"</table>";
        } else {
            echo "0 results";
        }
        echo "<a href='editdb.php'>Edit</a><br>";
        echo "<br><br><br>";
        echo "<h3>Acount</h3>";

        $sql = "SELECT email FROM users WHERE cookie = '".$_COOKIE[$cookie_name]."'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            echo "<p>You are logged in as ".$row["email"]."</p>";
        } else {
            echo "0 results";}
        echo "<a href='logout.php'> Log Out Acount </a><br>";
        echo "<a href='delete.php'> Delete Acount </a>";
        $conn->close();
        ?>
    </body>
</html>