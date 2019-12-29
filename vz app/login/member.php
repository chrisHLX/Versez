<?php
session_start();

if (isset($_SESSION['username'])){
    echo "welcome ".$_SESSION['username']."!<br><a href='logout.php'>logout here</a>";
    $conn = new mysqli("localhost", "cl56-v-er53z-9", "876VZSJxsTF87oop", "cl56-v-er53z-9");
    
    $uniqueID = $_SESSION['username'];
    
    $newQuery = $conn->query("SELECT name FROM users WHERE username='$uniqueID'");
    
    $search_results = $conn->query("SELECT * FROM searches");
    
    while ($row = $search_results->fetch_assoc()) {
        echo "<br>Character Name: " . $row['character_name'];
        echo "<br>";
        echo "Character Realm: " . $row['character_realm'];
        echo "<br>";
        echo "Times Searched: " . $row['times_searched'];
        echo "<br><br><br>";
    }
    
 
    
    $user_profile = $newQuery->fetch_array();
    
    echo "<br> Fullname: ".$user_profile[0];
    
    echo "<br><a href='bnet.php'>Verify Bnet</a>";
    

    
} else {
    die("You must be logged in");
}