<?php require_once('session.php'); ?>


<!DOCTYPE html>
<html>
<?php require_once('header.php'); ?>
<body>


<?php require_once('nav.php'); ?>
<br><br><br><br><br><br>


<center>
<h1>Welcome Home &nbsp;<i><?php echo $_SESSION['username']; ?></i>
</h1>
</center>
<br><br><br><br>











<br><br><br><br><br>

<b id="logout"><a href="logout.php">Log Out</a></b><br><br>
<?php require_once('footer.php'); ?>
  </body>
</html>
