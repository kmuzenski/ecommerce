<?php
session_start();
if(session_destroy())
{
echo "you have been logged out";
}
?>

<!DOCTYPE html>
<html>
<?php require_once('header.php'); ?>
<body>
<?php require_once('nav.php'); ?>
<br><br><br><br><br><br>

<p>You have been logged out<br><br>
<a href="index.php">home</a><br><br>
<a href="loginpage.php">login</a><br><br>
</p>


<?php require_once('footer.php'); ?>
</body>
</html>
