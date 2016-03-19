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
<table class="table table-striped table-bordered">
<thead>
<tr>
<p>info</p>
</tr>
</thead>
<tbody>
<?php

	$user = new UserCrud($_SESSION['uid']);
	foreach ($user->read() as $row) {
	echo '<tr>';
	echo '<form method="POST" action="confirmOrder.php">';
	echo '<input type="hidden" name="id" value="' . $row['id'] . '">';
	echo '<td>'.$row['username'].'</td>';	
	echo '<td>'.$row['email'].'</td>';
	}
	echo '</tr>';		

	echo '<br>';
	echo '<br>';
	
	$address = new UserAddress($_SESSION['uid']);
	foreach ($address->read() as $row2) {

	echo '<tr>';
	echo '<inpute type="hidden" name="id" value ="' .$row2['id'] .' ">';
	echo '<td>'.$row2['street'].'</td>';
	echo '<td>'.$row2['city'].'</td>';
	echo '<td>'.$row2['zip'].'</td>';
	echo '<td>'.$row2['state'].'</td>';
	echo '<td>'.$row2['country'].'</td>';

}
	  echo '</tr>';

echo '<input type="submit" value="Confirm Order">';
echo '</form>';
?>
</tbody>
</table>
</div>
 </div>


<?php require_once('footer.php');
Database::disconnect();
?>

</body>
</html>
