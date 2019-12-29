<?php
echo '<h1>Register</h1>';
//form data
$submit = strip_tags($_POST['submit']);
$fullname = strip_tags($_POST['fullname']);
$username = strip_tags($_POST['username']);
$password = strip_tags($_POST['password']);
$repeatpassword = strip_tags($_POST['repeatpassword']);
$date = date("Y-m-d");

if ($submit) {  
    if ($fullname&&$username&&$password&&$repeatpassword) {
        //encrypt password
       
        
        
        if ($password==$repeatpassword) {
            //check char length of username and fullname
            if (strlen($username)>25||strlen($fullname)>25) {
                echo "length of username of fullname is too long";
            } else {
                //check password length
                if (strlen($password)>25||strlen($password)<6) {
                    echo "password must be between 6 and 25 characters";
                } else {
                     $password = md5($password);
                     $repeatpassword = md5($password);
                    echo "success";
                    
                    //open our database
                    $conn = new mysqli("localhost", "cl56-v-er53z-9", "876VZSJxsTF87oop", "cl56-v-er53z-9");
                    $queryreg = $conn->query("
                            INSERT INTO users VALUES ('','$fullname','$username','$password','$repeatpassword');
                            ");
                    die("You have been registered! Retunr to login <a href='index.php'>page</a>");
                }
            }
        }  else {
            echo "passwords dont match";
        }       
    } else {
        echo "please fill in <b>all</b> fields";
    }
    
}
?>
<html>
<form action='register.php' method='POST'>
        <table>
            <tr>
                <td>Your Full Name:</td>
                <td><input type='text' name='fullname' value='<?php echo $fullname; ?>'/>
            </tr>
            <tr>
                <td>Choose a username:</td>
                <td><input type='text' name='username' value='<?php echo $username; ?>'/>
            </tr>
            <tr>
                <td>Choose a password:</td>
                <td><input type='password' name='password'/>
            </tr>
            <tr>
                <td>Repeat a password:</td>
                <td><input type='password' name='repeatpassword'/>
            </tr>
        </table>
    <p>
        <input type='submit' name='submit' value='register'></input>
    </p>
</form>
</html>
        
        