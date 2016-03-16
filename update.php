<?php require_once('session.php');
      require_once('database.php');
	require_once('crud.php'); 
	Database::connect();
?>


<!DOCTYPE html>
<html>

<?php require_once('header.php'); ?>
<body>

<?php require_once('nav.php');
?>
<br><br><br><br><br><br>

<center>
      <h1>Update User Information</h1>
</center>
<br><br><br>

<div class="container">
    <div class="row">
      <table class="table table-striped table-bordered">
        <thead>
          <tr>
            <th>username</th>
            <th>email</th>
            <th>password</th>
            <th>Action</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php
               $user = new UserCrud($_SESSION['uid']);
                
 		foreach ($user->read() as $row) {
		echo '<tr>';
                echo '<form method="POST" action="updateUser.php">';
                echo '<input type="hidden" name="id" value="'.$row['id'].'">';
               echo '<td><input type="text" name="username" value="'.$row['username'].'"></td>'; 
                echo '<td><input type="text" name="email" value="'.$row['email'].'"></td>';
                echo '<td><input type="text" name="password" value="'.$row['password'].'"></td>';
                echo '<td><input type="submit" value="Update"></td>';
                echo '</form>';
                echo '<form method="POST" action="userDelete.php">';
                echo '<input type="hidden" name="id" value="' . $row['id'] . '">';
                echo '<td><input type="submit" value="Delete"></td>';
                echo '</form>';
                echo '</tr>';
             }
		?>
        </tbody>
      </table>
    </div>
</div>



<div class="container">
    <div class="row">
      <h3>Address</h3>
   	<p><a href="createAddress.php">Add an Address</a></p>
	 </div>



    <div class="row">
      <table class="table table-striped table-bordered">
        <thead>
          <tr>
            <th>street</th>
            <th>city</th>
            <th>zip</th>
	    <th>state</th>
  	    <th>country</th>
	    <th>Action</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php
               
		$address = new UserAddress($_SESSION['uid']);

		foreach ($address->read() as $row) {


		echo '<tr>';
                echo '<form method="POST" action="addressUpdate.php">';
		echo '<input type="hidden" name="id" value="' . $row['id'] . '">';
                echo '<td><input type="text" name="street" value="'.$row['street'].'"></td>';
        	echo '<td><input type="text" name="city" value="'.$row['city'].'"></td>';
		echo '<td><input type="text" name="zip" value="'.$row['zip'].'"></td>';
		echo '<td><input type="text" name="state" value="'.$row['state'].'"></td>';
		echo '<td><input type="text" name="country" value="'.$row['country'].'"></td>';
		 echo '<td><input type="submit" value="Update"></td>';
                echo '</form>';
		 echo '<form method="POST" action="addressDelete.php">';
                echo '<input type="hidden" name="id" value="' . $row['id'] . '">';
		 echo '<td><input type="submit" value="Delete"></td>';
		echo '</form>';
                echo '</tr>';
          }

              
   ?>

        </tbody>
      </table>
    </div>
   </div>






<p><a href="createPayment.php">create a payment method</a></p>
<div class="container">
    <div class="row">
      <h3>Credit Cards</h3>
    </div>



    <div class="row">
      <table class="table table-striped table-bordered">
        <thead>
          <tr>
            <th>name</th>
            <th>number</th>
            <th>expiration</th>
            <th>securitycode</th>
            <th>type</th>
	    <th>address_FK</th>
            <th>Action</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php
		$creditcard = new UserCredit($_SESSION['uid']);

        	foreach ($creditcard->read() as $row) {


                echo '<tr>';
                echo '<form method="POST" action="updatePayment.php">';
                echo '<input type="hidden" name="id" value="' . $row['id'] . '">';
               echo '<td><input type="text" name="name" value="'.$row['name'].'"></td>';
               echo'<td><input type="text" name="number" value="'.$row['number'].'"></td>';
                echo '<td><input type="text" name="expiration" value="'.$row['expiration'].'"></td>';
                echo '<td><input type="text" name="securitycode" value="'.$row['securitycode'].'"></td>';
                echo '<td><input type="text" name="type" value="'.$row['type'].'"></td>';
                echo '<td><input type="text" name="address_FK" value="'.$row['address_FK'].'"> </td>';

		 echo '<td><input type="submit" value="Update"></td>';
                echo '</form>';
                echo '<form method="POST" action="deletePayment.php">';
                echo '<input type="hidden" name="id" value="' . $row['id'] . '">';
                echo '<td><input type="submit" value="Delete"></td>';
                echo '</form>';
                echo '</tr>';
          }
        

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

