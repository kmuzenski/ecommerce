<?php
require_once('session.php');
require_once('database.php');
?>

<!DOCTYPE html>
<html>
<?php require_once('header.php'); ?>
  <body>

    <?php require_once('nav.php')?>
    <br><br><br><br><br><br>

    <div class="container">
      <div class="row">
        <h1>Search Results</h1>
      </div>
      <hr>
      <div class="row">
        <h3>Products</h3>
        <table class="table table-striped table-bordered">
          <thead>
            <tr>
              <th>Name</th>
             
              <th>Price</th>
              <th>Action</th>
              <th>Action</th>
            </tr>
          </thead>
           <tbody>
    
            <?php
              $search = $_POST['srch-term'];
              //$sqlSearch = '%' . $search . '%';
            try {
              $pdo = Database::connect();
              $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
              $sql = "SELECT * FROM product WHERE name LIKE :search";
              $q = $pdo->prepare($sql);
           
              $q->execute();
              $matches = $q->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $error) {
              echo $error->getMessage();
            
            }
              foreach ($matches as $row) {
                echo '<tr>';
                echo '<form method="GET" action="products.php">';
                echo '<input type="hidden" name="id" value="' . $row['id'] . '">';
                echo '<td>'.$row['name'].'</td>'; 
              
              
                echo '<td>'.$row['price'].'</td>';
                echo '<td><input type="submit" value="product page"></td>';
                echo '</form>';
                echo '<form method="POST" action="addToCart.php">';
                echo '<input type="hidden" name="id" value="' . $row['id'] . '">';
                echo '<td><input type="submit" value="Add to Cart"></td>';
                echo '</form>';
                echo '</tr>';
              }
              Database::disconnect();
              ?>
           </tbody>
        </table>
        <hr>
        
      </div>
      <div>
    
    </div><!-- /.container -->

    <?php require_once('footer.php');?>



   <script src="assets/js/jquery.min.js"></script>
   <script src="assets/js/bootstrap.min.js"></script>
  </body>
</html>