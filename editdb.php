<!doctype html>
<link rel="stylesheet" href="styles.css">
<html>
    <h1>Edit</h1>
<?php 

$conn = new mysqli("localhost", "user1", "1234", "project");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} //else{
  //  echo "<p>Successful db connection</p>";
// }

$sql = "SELECT lessons.ID, lessons.instrument, teacher.name, teacher.contact_email, location.location FROM lessons, teacher, location WHERE lessons.teacherid = teacher.ID AND lessons.locationid = location.ID";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
    
    //prints the table
    echo "<table><tr><th>Name</th><th>Intstrument</th><th>Email</th><th>Location</th><th>Delete</th><th>Modify</th></tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>".$row["name"]."</td><td>".$row["instrument"]."</td><td>".$row["contact_email"]."</td><td>".$row["location"]."</td><td><form action= 'del.php' method = 'post'><input type='hidden' name = 'ID' value='".$row["ID"]."'><input type='submit' value=''></form></td><td><form action= 'mod.php' method = 'post'><input type='hidden' name = 'ID' value='".$row["ID"]."'><input type='submit' value=''></form></td>";
    }?>

<?php
    echo"</table>";
} else {
    echo "0 results";
}
?> 
<h2>Add</h2>
<form action="add.php" method = "post">
Teacher name: <input type="text" name="name"><br>
Insrument: <input type="text" name="instrument"><br>
Email: <input type="text" name="email"><br>
Location: <input type="text" name="location"><br>
<input type="submit" value="Add"><br>
</form>
</html>