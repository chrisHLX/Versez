<?php
session_start();

$special_code = strip_tags($_POST['special_code']);

if($_SESSION['username']) {
    $conn = new mysqli("localhost", "cl56-v-er53z-9", "876VZSJxsTF87oop", "cl56-v-er53z-9");
    $check_bnet = $conn->query("SELECT cname FROM characters WHERE id='$special_code'");
    
    if($check_bnet->num_rows) {
        $cname = $check_bnet->fetch_array();
        echo "your character: ".$cname[0];
    } else {
        die("sorry you have entered the wrong code");
    }
    
} else {
    die("you must be logged in to access this page");
}