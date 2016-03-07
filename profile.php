<?php
require_once('session.php');
?>
<!DOCTYPE html>
<html>
<head>
<title>Your Profile Page</title>
<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
</head>
<body>
<?php require_once('nav.php'); ?>
<br><br><br><br><br><br>



<div id="profile">
<b id="welcome">Welcome : <i><?php echo $_SESSION['username']; ?></i></b>
<b id="logout"><a href="logout.php">Log Out</a></b><br><br>
<a href="update.php">update</a>
</div>
</body>
</html>
