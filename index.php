<?php require_once('session.php'); ?>


<!DOCTYPE html>
<html lang="en">

<head>
<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
</head>
<body>


<?php require_once('nav.php'); ?>
<br><br><br><br><br><br>



<h1>Home Page</h1>
<br><br><br><br>

<div>
<?php
          if ($loggedin) {
            echo "You are logged in.";
            echo '<form method="POST" action="update.php">';
            echo '<input type="submit" value="update">';
            echo '</form>';
	    echo '<a href="logout.php">logout</a>';
          
          } else {
            echo "You are logged out.";
          }
        ?>

</div>
<br><br><br><br><br>


<?php require_once('footer.php'); ?>
  </body>
</html>
