<!doctype html>
<?php

    function generateRandomString($length = 32) { //generates a random 32 length string that is then used as a cookie
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'; 
        $charactersLength = strlen($characters); 
        $randomString = ''; 
        
        for ($i = 0; $i < $length; $i++) { 
            $randomString .= $characters[rand(0, $charactersLength - 1)]; 
        }   
        return $randomString; }

    function cookies(){ //sets the cookie to a random string and returns the cookie
        global $cookie_name;
        $cookie_name = "sessionID";
        $cookie_value = generateRandomString();
        setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "","", true);
        return($cookie_value);
    }?> 
<html>

<?php $email = $_POST["email"]; //recieves the email?> 
<br>
<?php $password = $_POST["password"]; //recieves the password?> 
<br>
        
<?php
    echo $email;
    echo $password;
    $servername = "localhost";
    $username = "user1";
    $dbname = "project";
    // creates the connection
    $conn = new mysqli($servername, $username, "1234" , $dbname);
    // checks the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    //sees if that password and email combination is recognised    
    $sql = "SELECT ID FROM users WHERE password = '".$password."' AND email = '".$email."'";
    $result = $conn->query($sql);
    //if that combination isn't recognised then it returns to home
    if ($result->num_rows == 0) {
        header("Location: index.php");
        die();
    }else{            
        
    //sets the cookie
    $user_cookie = cookies();
    $sql = ("UPDATE users set cookie = '".$user_cookie."' where email = '".$email."'"); //puts the cookie into the database
    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
        
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
        }
        
    $conn->close();
    header("Location: home.php");
    die();
    }

?>