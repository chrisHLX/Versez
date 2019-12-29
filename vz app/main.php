<?php

if( isset( $_GET['ajax'])) {

$name;
$realm;
$search = '';
$html;

if(isset($_POST['name']))
{
    $name = $_POST['name'];
    $search .= $name;
}

if(isset($_POST['realm']))
{
    $realm = $_POST['realm'];
    $search .= $realm;
    
}



// Create connection
//Adding search feature
$conn = new mysqli("localhost", "cl56-v-er53z-9", "876VZSJxsTF87oop", "cl56-v-er53z-9");
$querysearch = $conn->query("
                            INSERT INTO searches VALUES ('$search','', '$name','$realm')
                            ");
$queryadd = $conn->query("UPDATE searches SET times_searched=times_searched + 1 WHERE search_id='$search'");


$blizz_key = '&apikey=4qbgjzsfmcsnes87baa4kfztxrkm423p';
$blizz_url = 'https://us.api.battle.net/wow/character/'.$realm.'/'.$name.'?fields=pvp&locale=en_US';
 
$c = curl_init($blizz_url . $blizz_key);
curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
//curl_setopt(... other options you want...)

$html = curl_exec($c);

if (curl_error($c))
    die(curl_error($c));

// Get the status code
$status = curl_getinfo($c, CURLINFO_HTTP_CODE);

curl_close($c);



//$html =array('Working Version:  ', 'https://us.api.battle.net/wow/character/barthilas/Mordoyd?fields=pvp&locale=en_US&apikey=4qbgjzsfmcsnes87baa4kfztxrkm423p');
//$html2 =array('Non Working Version:  ', 'https://us.api.battle.net/wow/character/barthilas/Mordoyd?fields=pvp&locale=en_US&apikey=' , $blizz_key);

 if (!empty($html)) {
     echo $html;
 }

} 