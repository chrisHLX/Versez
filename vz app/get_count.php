<?php
$url = 'https://www.facebook.com/shabbyandchichuntervalley/likes';
$url_test = 'http://stackoverflow.com/questions/18884821/enable-ssl-connection-for-https-in-curl-php-header-blank';
$c = curl_init($url);
curl_setopt($c, CURLOPT_RETURNTRANSFER, true); // returns the info on a page
//curl_setopt($c, CURLOPT_SSL_VERIFYPEER, false); //disable ssl verification (useful when on local host)
//curl_setopt($c,CURLOPT_FOLLOWLOCATION,true); // follow 302 redirects
//curl_setopt(... other options you want...)

$html = curl_exec($c);

if (curl_error($c))
    die(curl_error($c));

// Get the status code
$page = curl_getinfo($c, CURLINFO_HTTP_CODE);

curl_close($c);

echo $page;
echo $html;

