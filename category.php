<?php require_once('session.php'); ?>
<!DOCTYPE html>
<html>
<?php require_once('header.php'); ?>

<body>
<?php require_once('nav.php'); ?>
<br><br><br><br><br><br>



<div class="container">
<div class="row">
        
        <table class="table table-striped table-bordered">
          <thead>
            <tr>
              <th>Image</th>
              <th>Name</th>
              <th>Price</th>

	            <th>Action</th>
              <th>Action</th>
            </tr>
          </thead>
           <tbody>
    
              <?php 
              $category_id = $_GET['id'];
              $pdo = Database::connect();
              $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
              $sql = 'SELECT * FROM product WHERE category_FK = ?';
              $q = $pdo->prepare($sql);
              $q->execute(array($category_id));
              $products = $q->fetchAll();
              foreach ($products as $row) {
                echo '<tr>';
                echo '<form method="GET" action="products.php">'; 
                echo '<input type="hidden" name="id" value="' . $row['id'] . '">';
                echo '<td><img src="'.$row['image'].'" width="500"><br></td>';
                echo '<td>'.$row['name'].'</td>'; 
                echo '<td>'.$row['price'].'</td>';
	  	          echo '<td><input type="submit" value="view product"></td>';
 		            echo '</form>';
                echo '<form method="POST" action="addToCart.php">';
                echo '<input type="hidden" name="id" value="' . $row['id'] . '">';
                echo '<td><input type="submit" value="Add to Cart"></td>';
                echo '</form>';
                echo '</tr>';
              }
              ?>
           </tbody>
        </table>
      </div>
      <br>
      <br>
      <br>
      <br>
    </div><!-- /.container -->









<br><br>


<?php require_once('footer.php'); ?>
</body>
</html>
