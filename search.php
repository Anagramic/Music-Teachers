<!doctype html>
<link rel="stylesheet" href="styles.css">
<html>
    <h1>Search</h1>
<?php 
$qir = $_POST["qir"]; //recieves the quirey 
$field = $_POST["field"]; //recieves the field

$conn = new mysqli("localhost", "user1", "1234", "project");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} //else{
  //  echo "<p>Successful db connection</p>";
// }

$sql = "SELECT lessons.instrument, teacher.name, teacher.contact_email, location.location FROM lessons, teacher, location WHERE lessons.teacherid = teacher.ID AND lessons.locationid = location.ID AND ".$field." LIKE '%".$qir."%'";
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
?> 
<h2>Filters</h2>
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
<a href="home.php"> Home </a>
</html>