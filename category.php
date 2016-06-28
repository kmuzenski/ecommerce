<?php require_once('session.php'); ?>
<!DOCTYPE html>
<html>
<?php require_once('header.php'); ?>

<body>
<?php require_once('nav.php'); ?>
<br><br><br><br><br><br>



<div class="container">
<div class="row">

<div class="col-xs-3">
</div>

<div class="col-xs-4">
    
              <?php 
              $category_id = $_GET['id'];
              $pdo = Database::connect();
              $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
              $sql = 'SELECT * FROM product WHERE category_FK = ?';
              $q = $pdo->prepare($sql);
              $q->execute(array($category_id));
              $products = $q->fetchAll();
              foreach ($products as $row) {
                echo '<table class="table table-striped table-bordered">';
                echo '<th><strong>'.$row['name'].'</th>'; 
                echo '<form method="GET" action="products.php">'; 

                echo '<input type="hidden" name="id" value="' . $row['id'] . '">';

                echo '<tbody>';

                echo '<tr><td><img src="'.$row['image'].'" width="200" height="200"><br></td></tr>';
                
                echo '<tr><td><p>Price:</p>'.$row['price'].'</td></tr>';
	  	          echo '<tr><td><input type="submit" value="view product"></td></tr>';
 		            echo '</form>';
                if ($loggedin) {
                echo '<form method="POST" action="addToCart.php">';
                echo '<input type="hidden" name="id" value="' . $row['id'] . '">';
                
                echo '<td><input type="submit" value="Add to Cart"></td>';
              }
                echo '</form>';
                echo '</tbody>';
                echo '</table>';
              }
              ?>
       



</div>

<div class="col-xs-3">
</div>

</div>
</div><!-- /.container -->









<br><br>


<?php require_once('footer.php'); ?>
</body>
</html>
