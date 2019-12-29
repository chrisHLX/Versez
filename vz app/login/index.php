<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <form action="login.php" method="POST">
            <input type='text' style='display:none;' name='not-used'>
            Username: <input type="text" name="username" placeholder=""></br>
            <input type='passowrd' style='display: none;' name='not-used'>
            Password: <input type="password" name="password" placeholder=""></br>
            <input type="submit" value="log in"> 
        </form>
        <p>
            <a href="register.php">Register Here</a>
        </p>
    </body>
</html>
