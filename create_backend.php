<!doctype html>
<?php 

$email = $_POST["email"]; //recieves the email
$password = $_POST["password"]; //recieves the password

// creates the connection
$conn = new mysqli("localhost", "user1", "1234" , "project");

// checks the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT ID FROM users WHERE password = '".$password."' AND email = '".$email."'";
$result = $conn->query($sql);

//if that combination is recognised then it returns to home
if ($result->num_rows != 0) {
    header("Location: index.php");
    die();
}else{
   
    $sql = "INSERT INTO users (email, password) VALUES ('".$email."','".$password."')";
    $result = $conn->query($sql);
    
    if ($conn->query($sql) == TRUE){
        $sql = "SELECT ID FROM users WHERE password = '".$password."' AND email = '".$email."'";
        $result = $conn->query($sql);

        //if that combination is recognised then it returns to home
        if ($result->num_rows != 0) {
            echo "<p>transaction complete</p>";}
            header("Location: index.php");
            die();
    
}}
?>