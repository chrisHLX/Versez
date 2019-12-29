<?php

$realms = file('realms.txt');
$realm_array = array_filter(array_map('trim', $realms));

echo json_encode($realm_array);


