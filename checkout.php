<?php require_once('database.php');
	require_once('session.php');
	require_once('crud.php');
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
</div>

<br><br><br><br>




<h3>Customer Information</h3>
<br><br>
<?php

	$user = new UserCrud($_SESSION['uid']);
	$info = $user->read(); 
	echo '<form method="POST" action="confirmOrder.php">';
	echo '<input type="hidden" name="id" value="' . $info['id'] . '">';
	echo ''.$info['username'].'';
	echo ''.$info['email'].'';	

?>

<br><br>
<h3>Shipping Information</h3>
<br><br>

<?php

	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "SELECT `address`.`id`, `address`.`street` FROM `address` WHERE `address`.`id` IN (SELECT `user_address`.`address_FK` FROM `user_address` WHERE `user_address`.`user_FK` = ?)";
	$q = $pdo->prepare($sql);
	$q->execute(array($_SESSION['uid']));
	$address = $q->fetchAll(PDO::FETCH_ASSOC);
	echo "<select method ='POST' name='address_FK'>";
	foreach ($address as $row) {
	echo "<option value='" . $row['id'] . "'>" . $row['street'] . "</option>";
	}
	echo "</select>";
?>


<?php
echo '<input type="submit" value="Confirm Order">';
echo '</form>';
?>
</div>
</div>

<?php require_once('footer.php');
?>

</body>
</html>
