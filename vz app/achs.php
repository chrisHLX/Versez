<?php 
if( isset( $_GET['ajax'])) {

$name;
$realm;


if(isset($_POST['realm']))
{
    $realm = $_POST['realm'];
}

if(isset($_POST['name']))
{
    $name = $_POST['name'];
}


//achs
$blizz_key = '&apikey=4qbgjzsfmcsnes87baa4kfztxrkm423p';
$blizz_url = 'https://us.api.battle.net/wow/character/'.$realm.'/'.$name.'?fields=achievements&locale=en_US';

$c = curl_init($blizz_url . $blizz_key);
curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
//curl_setopt(... other options you want...)

$htmlA = curl_exec($c);

if (curl_error($c))
    die(curl_error($c));

// Get the status code
$status = curl_getinfo($c, CURLINFO_HTTP_CODE);

curl_close($c);

if (!empty($htmlA)) {
     echo $htmlA;
 }

}