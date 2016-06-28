<?php require_once('session.php'); ?>
<!DOCTYPE html>
<html>
<?php require_once('header.php'); ?>

<body>
<?php require_once('nav.php'); ?>
<br><br><br><br><br><br>



<div class="container">
<div class="row">

<div class="col-md-2">
</div>

<div class="col-md-6">
    
              <?php 
              $category_id = $_GET['id'];
              $pdo = Database::connect();
              $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
              $sql = 'SELECT * FROM product WHERE category_FK = ?';
              $q = $pdo->prepare($sql);
              $q->execute(array($category_id));
              $products = $q->fetchAll();
              foreach ($products as $row) {
                echo '<table>';
                echo '<tr><th><strong><td>'.$row['name'].'</td></th></tr>'; 
                echo '<form method="GET" action="products.php">'; 

                echo '<input type="hidden" name="id" value="' . $row['id'] . '">';

                echo '<tr><td><img src="'.$row['image'].'" width="200" height="200"><br></td></tr>';
                
                echo '<tr><td>'.$row['price'].'</td></tr>';
	  	          echo '<tr><td><input type="submit" value="view product"></td></tr>';
 		            echo '</form>';
                if ($loggedin) {
                echo '<form method="POST" action="addToCart.php">';
                echo '<input type="hidden" name="id" value="' . $row['id'] . '">';
                
                echo '<td><input type="submit" value="Add to Cart"></td>';
              }
                echo '</form>';
                
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
