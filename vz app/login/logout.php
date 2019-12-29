<?php
session_start();

session_destroy();

echo "you've been logged out. <a href='index.php'>click</a> here to return";

