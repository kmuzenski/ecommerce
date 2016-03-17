<?php
require_once('session.php');
?>
<!DOCTYPE html>
<html>

<?php require_once('header.php'); ?>
<body>
<?php require_once('nav.php'); ?>
<br><br><br><br><br><br>



<div id="profile">
<b id="welcome">Welcome : <i><?php echo $_SESSION['username']; ?></i></b>
<b id="logout"><a href="logout.php">Log Out</a></b><br><br>
</div>
</body>
</html>
