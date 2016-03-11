<?php require_once('session.php');
      require_once('database.php');
	require_once('crud.php'); 

?>


<!DOCTYPE html>

<head>


<title>Update</title>
<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
</head>

<body>

<?php require_once('nav.php');
?>
<br><br><br><br><br><br>


<div class="container">
    <div class="row">
      <h3>Update User Info</h3>
    </div>
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
          if($loggedin) {
		$pdo = Database::connect();
              $id = $_SESSION['uid'];
              $sql = 'SELECT * FROM users WHERE id = ?';
              $q = $pdo->prepare($sql);
              $q->execute(array($id));
              $query = $q->fetch(PDO::FETCH_ASSOC);
                echo '<tr>';
                echo '<form method="POST" action="updateUser.php">';
                echo '<input type="hidden" name="id" value="'.$query['id'].'">';
               echo '<td><input type="text" name="username" value="'.$query['username'].'"></td>'; 
                echo '<td><input type="text" name="email" value="'.$query['email'].'"></td>';
                echo '<td><input type="text" name="password" value="'.$query['password'].'"></td>';
                echo '<td><input type="submit" value="Update"></td>';
                echo '</form>';
                echo '<form method="POST" action="userDelete.php">';
                echo '<input type="hidden" name="id" value="' . $query['id'] . '">';
                echo '<td><input type="submit" value="Delete"></td>';
                echo '</form>';
                echo '</tr>';
          }
                Database::disconnect();
          ?>
        </tbody>
      </table>
    </div>
</div>



 <p><a href="createAddress.php">create an address</a></p>
<div class="container">
    <div class="row">
      <h3>Address</h3>
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
            echo '<td><input type="text" name="number" value="'.$row['number'].'"></td>';
                echo '<td><input type="text" name="expiration" value="'.$row['expiration'].'"></td>';
                echo '<td><input type="text" name="securitycode" value="'.$row['securitycode'].'"></td>';
                echo '<td><input type="text" name="type" value="'.$row['type'].'"></td>';
               
		 echo '<td>';
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $sql = "SELECT `address`.`id`, `address`.`street` FROM `address` ORDER BY `street` ASC";
                $address = $pdo->query($sql);
                echo "<select name='address_FK'>";
                foreach ($address as $row1) {
                  echo "<option value='" . $row1['id'] . "'";
                  if($row1['id']==$row['address_FK']){
                    echo " selected ";
                  }
                  echo ">" . $row1['street'] . "</option>";
                }
                echo "</select>";
                echo "</td>";

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




</body>

</html>
<?php Database::disconnect(); ?>
