<?php 
require_once('session.php');
require_once('database.php');
 error_reporting(E_ALL);
?>
<!DOCTYPE html>
<html lang="en">
 <head>
	  <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
	  <title> Products</title>
 </head>

 <body>
<?php  require_once('nav.php'); ?>
<br><br><br><br><br><br>
    <div class="container">
	    <div class="row">
	      <h3>List of all Products</h3>
	    </div>
	    <div class="row">
	      <table class="table table-striped table-bordered">
	        <thead>
	          <tr>
	            <th>Name</th>
	            <th>Description</th>
	            <th>Price</th>
	            <th>Action</th>
	          </tr>
	        </thead>
	         <tbody>
	          <?php
	         // if($loggedin) {
	          	  $pdo = Database::connect();
	              $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	              $sql = 'SELECT * FROM product ORDER BY id';
	              $q = $pdo->prepare($sql);
	              $q->execute(array());
	              $query = $q->fetchAll(PDO::FETCH_ASSOC);
	            foreach ($query as $row) {
	                echo '<tr>';
	               
	                echo '<input type="hidden" name="id" value="' . $row['id'] . '">';
	                echo '<td><input type="text" name="name" value="'.$row['name'].'"></td>';
			echo '<td><input type="text" name="description" value="'.$row['description'].'"></td>'; 
	                echo '<td><input type="text" name="price" value="'.$row['price'].'"></td>';
	               
	               
	                echo '<form method="POST" action="addToCart.php">';
	                echo '<input type="hidden" name="id" value="' . $row['id'] . '">';
	                echo '<td><input type="submit" value="Add to Cart"></td>';
	                echo '</form>';
	                echo '</tr>';
	            }
	         // } 
	          Database::disconnect();
	          ?>
	         </tbody>
	      </table>
	    </div>

        <br>
        <br>
        <br>
        <br>
    </div> <!-- /container -->

  <?php 
   require_once('footer.php');
  ?>
  </body>
</html>
