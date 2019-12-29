<?php

if( isset($_GET['ajax'])) {
    
    $name;
    $realm;
    
    if (isset($_POST['name'])) {
        $name = $_POST['name'];
    }

    if (isset($_POST['realm'])) {
        $realm = $_POST['realm'];
    }
    
    $comment_id = $name.$realm;
    
    $conn = new mysqli("localhost", "cl56-v-er53z-9", "876VZSJxsTF87oop", "cl56-v-er53z-9");
    
    $comments_query = $conn->query("SELECT vz_comments FROM comments WHERE character_id='$comment_id'");
    
    //$comments_array = $comments_query->fetch_all();
    
    while ($row = $comments_query->fetch_assoc()) {
        echo "<p style='margin-bottom: 5px;'>".$row['vz_comments']."</p>";
       
    }
    
}

