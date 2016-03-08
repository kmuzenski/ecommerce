<?php
require_once('session.php');
?>
<!DOCTYPE html>
<html>
<head>
<title>Your Admin Page</title>
<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
</head>
<body>
<?php require_once('nav.php'); 
	require_once('database.php');?>
<br><br><br><br><br><br>

<div id="profile">
<b id="welcome">Welcome : <i><?php echo $_SESSION['username']; ?></i></b>
<b id="logout"><a href="logout.php">Log Out</a></b><br><br>
<a href="update.php">update admin profile</a>
</div>
<br><br><br>

<p><a href="createProduct.php">Create a product</a></p>
<br><br>
<div class="container">
    <div class="row">
      <h3>Update Product info</h3>
    </div>
    <div class="row">
      <table class="table table-striped table-bordered">
        <thead>
          <tr>
            <th>name</th>
            <th>description</th>
            <th>price</th>
	    <th>bin</th>
            <th>Action</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php
          if($loggedin) {
              $pdo = Database::connect();
              $id = $_SESSION['id'];
              $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
              $sql = 'SELECT * FROM product WHERE id = ?';
              $q = $pdo->prepare($sql);
              $q->execute(array($id));
              $query = $q->fetchALL(PDO::FETCH_ASSOC);
               
		foreach ($query as $row) {


	 	 echo '<tr>';
                echo '<form method="POST" action="updateProduct.php">';
                echo '<input type="hidden" name="id" value="' . $row['id'] . '">';
                echo '<td><input type="text" name="name" value="'.$row['name'].'"></td>';
	        echo '<td><input type="text" name="description" value="'.$row['description'].'"></td>';
		echo '<td><input type="text" name="price" value="'.$row['price'].'"></td>';
                echo '<td><input type="text" name="bin" value="'.$row['bin'].'"></td>';
		echo '<td><input type="submit" value="Update"></td>';
                echo '</form>';
                echo '<form method="POST" action="productDelete.php">';
                echo '<input type="hidden" name="id" value="' . $row['id'] . '">';
                echo '<td><input type="submit" value="Delete"></td>';
                echo '</form>';
                echo '</tr>';
          	}
	    }

          Database::disconnect();
              //print_r($query);
          ?>
        </tbody>
      </table>
    </div>
</div>



</body>
</html>