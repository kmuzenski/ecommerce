<?php require_once('session.php'); 
?>


<!DOCTYPE html>

<head>


<title>Update</title>
<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
</head>

<body>

<?php require_once('nav.php');
	require_once('database.php');  ?>
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
              $username = $_SESSION['username'];
              $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
              $sql = 'SELECT * FROM users WHERE username = ?';
              $q = $pdo->prepare($sql);
              $q->execute(array($username));
              $query = $q->fetch(PDO::FETCH_ASSOC);
                echo '<tr>';
                echo '<form method="POST" action="updateUser.php">';
                echo '<input type="hidden" name="id" value="' . $query['id'] . '">';
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
              //print_r($query);
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
          if($loggedin) {
              $pdo = Database::connect();
              $id = $_SESSION['uid'];
              $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
              $sql = 'SELECT * FROM address WHERE id IN (SELECT address_FK FROM user_address WHERE user_FK = ?)';
              $q = $pdo->prepare($sql);
              $q->execute(array($id));
              $query = $q->fetchAll(PDO::FETCH_ASSOC);
                

	foreach ($query as $row) {


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
	}

          Database::disconnect();
              
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
            <th>Action</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php
          if($loggedin) {
              $pdo = Database::connect();
              $id = $_SESSION['uid'];
              $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
              $sql = 'SELECT * FROM creditcard WHERE id IN (SELECT credit_FK FROM user_creditcard WHERE user_FK = ?)';
              $q = $pdo->prepare($sql);
              $q->execute(array($id));
              $query = $q->fetchAll(PDO::FETCH_ASSOC);


        foreach ($query as $row) {


                echo '<tr>';
                echo '<form method="POST" action="updatePayment.php">';
                echo '<input type="hidden" name="id" value="' . $row['id'] . '">';
               echo '<td><input type="text" name="name" value="'.$row['name'].'"></td>';
            echo '<td><input type="text" name="number" value="'.$row['number'].'"></td>';
                echo '<td><input type="text" name="expiration" value="'.$row['expiration'].'"></td>';
                echo '<td><input type="text" name="securitycode" value="'.$row['securitycode'].'"></td>';
                echo '<td><input type="text" name="type" value="'.$row['type'].'"></td>';
                echo '<td><input type="submit" value="Update"></td>';
                echo '</form>';
                echo '<form method="POST" action="deletePayment.php">';
                echo '<input type="hidden" name="id" value="' . $row['id'] . '">';
                echo '<td><input type="submit" value="Delete"></td>';
                echo '</form>';
                echo '</tr>';
          }
        }
        Database::disconnect();

   ?>

        </tbody>
      </table>
    </div>
   </div>




</body>

</html>

