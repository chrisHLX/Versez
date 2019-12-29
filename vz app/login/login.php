<?php
//start the session
session_start();

//take user input
$username = filter_input(INPUT_POST, 'username');
$password = filter_input(INPUT_POST, 'password');

// Create connection
    $conn = new mysqli("localhost", "cl56-v-er53z-9", "876VZSJxsTF87oop", "cl56-v-er53z-9");

// Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    echo "Connected successfully <br>";
    

//if there is user input
if ($username && $password) {
    
    //check the database if the username exists
    $rows = $conn->query("SELECT * FROM users WHERE username='$username'");
    $row_count = $rows->num_rows;
    
    //if the username exists do the following
    if ($row_count != 0) {
        echo "Welcome $username <br>";
        
        while ($userRow = $rows->fetch_assoc()) {
            $dbusername = $userRow['username'];
            $dbpassword = $userRow['password'];
        }
        
        //check the password
        if ($username==$dbusername&&md5($password)==$dbpassword) {
            echo "you're in! <br><a href='member.php'>Click</a> here to enter the memeber page";
            $_SESSION['username']=$dbusername;
        } else {
            echo "incorrect password";
        }
        
    }
    
    //if the username doesnt exist
    else {
        die("That User Does Not Exist");
    }
    
    
} else {
    die("please enter a username and a password");
}

