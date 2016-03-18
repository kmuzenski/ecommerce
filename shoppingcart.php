<?php require_once('database.php');
      require_once('session.php');
      require_once('crud.php');

error_reporting(E_ALL);
?>



<!DOCTYPE html>
<html>
<?php require_once('header.php'); ?>

<body>

<?php require_once('nav.php'); ?>
<br><br><br><br><br><br>

<div class="container">
<div class="row">
<h1>Your Shopping Cart</h1>
</div>

<div class="row">
<table class ="table table-striped table-bordered">
<thead>
<tr>
<th>Name</th>
<th>Price</th>
<th>Quantity</th>
<th>Action</th>
<th>Action</th>
</tr>
</thead>

<tbody>

<?php
	if($loggedin) {
		$shoppingBag = new Cart($_SESSION['uid']);
		 $bag = $shoppingBag->getCart($_SESSION['cart_id']);
	foreach ($bag as $row) {
		echo '<tr>';
		echo '<form method="POST" action="updateQuantity.php">';
		echo '<input type="hidden" name="id" value="' . $row['id'] . '">';
		echo '<td>' . $row['name'] . '</td>';
		echo '<td>' . $row['price'] . '</td>';
		echo '<td><input type="text" name="quantity" value="' . $row['quantity'] . '"></td>';
		echo '<td><input type="submit" value="Update Quantity"></td>';
		echo '</form>';
		echo '<form method="POST" action="deleteFromCart.php">';
		echo '<input type="hidden" name="id" value="' . $row['id'] . '">';
		echo '<td><input type="submit" value="Remove Item"></td>';
		echo '</form>';
		echo '</tr>';
		}

	}

?>

</tbody>
</table>
</div>
</div>

<h5>Proceed To <a href="checkout.php">Checkout</a></h5>

<?php require_once('footer.php'); ?>

</body>
</html>

