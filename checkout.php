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


<table class="table table-striped table-bordered">
<thead>
<tr>
<h3>Customer Information</h3>
</tr>
</thead>

<br><br>
<tbody>
<?php

	$user = new UserCrud($_SESSION['uid']);
	foreach ($user->read() as $row) { 
	echo '<p>Name: </p>'.$row['username'].'<br>';
	echo '<p>Address: </p>'.$row['email'].'';	
}

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
<br><br>
<h3> Payment Information</h3>
<br><br>

<?php
	echo '<form method="POST" action="confirmOrder.php">';
	echo '<input type="hidden" name="id" value="' . $_SESSION['id'] . '">';
	 $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT `creditcard`.`id`, `creditcard`.`name` FROM `creditcard` WHERE `creditcard`.`id` IN (SELECT `user_creditcard`.`credit_FK` FROM `user_creditcard` WHERE `user_creditcard`.`user_FK` = ?)";
        $q = $pdo->prepare($sql);
        $q->execute(array($_SESSION['uid']));
        $credit = $q->fetchAll(PDO::FETCH_ASSOC);
        echo "<select method ='POST' name='credit_FK'>";
        foreach ($credit as $row) {
        echo "<option value='" . $row['id'] . "'>" . $row['name'] . "</option>";
        }
        echo "</select>";

?>
<br><br>


<?php
echo "<br>";
echo '<input type="submit" value="Confirm Order">';
echo '</form>';
?>
</div>
</div>

<br><br>
<?php require_once('footer.php');
?>

</body>
</html>
