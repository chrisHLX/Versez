<html>
<?php
session_start();
?>
<?php if (isset($_SESSION['username'])) : ?>
    <h1> Welcome <?php $_SESSION['username']; ?></h1>
    <p>please enter special code to verify your bnet account:</p>
    <form action="verify-bnet.php" method="POST">
        <input type="text" name="special_code"/>
        <input type="submit" name="verify_submit" value="verify"/>
    </form>
<?php else : ?>
    <?php die("you must be logged in to access this page"); ?>
<?php endif; ?>
</html>