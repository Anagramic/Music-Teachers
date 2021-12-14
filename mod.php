<!doctype html>


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
        
        $sql = "SELECT lessons.instrument, teacher.name, teacher.contact_email, location.location FROM lessons, teacher, location WHERE lessons.teacherid = teacher.ID AND lessons.locationid = location.ID AND lessons.ID = '".$ID."'";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        
        echo "<form action='mod_backend.php' method = 'post' > ";
        echo "Teacher name: <input type='text' name='name' value = '".$row['name']."'><br>";
        echo "Insrument: <input type='text' name='instrument' value = '".$row['instrument']."'><br>";
        echo "Email: <input type='text' name='email' value = '".$row['contact_email']."'><br>";
        echo "Location: <input type='text' name='location' value = '".$row['location']."'><br>";
        echo "Location: <input type='hidden' name='ID' value = '".$ID."'>";
        echo "<input type='submit' value='Apply changes'><br>";
        echo "</form>";
    ?>
</html>