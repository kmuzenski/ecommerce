<?php require_once('database.php');
	require_once('session.php');
	require_once('crud.php');
	Database::connect();
	?>

<!DOCTYPE html>
<html>
<?php require_once('header.php'); ?>

<body>
<?php require_once('nav.php'); ?>
<br><br><br><br><br><br>



<div class="container">
<div class="row">
<h1>Verify your information</h1>
<br><br><br><br>
<h3>Customer Information</h3>
<br><br>

<?php

	$user = new UserCrud($_SESSION['uid']);
	$check = $user->read();

	echo '<form method="POST" action="confirmOrder.php">';
	echo '<input type="hidden" name="id" value="' . $check['id'] . '">';
	echo ''.$check['username'].'';	
	echo '<br>';
	echo ''.$check['email'].'';

	?>


<?php
echo '<input type="submit" value="Confirm Order">';
echo '</form>';
?>

</div>
 </div>


<?php require_once('footer.php');
Database::disconnect();
?>

</body>
</html>
