<?php 
require_once('session.php');
require_once('database.php');
require_once('crud.php');
 error_reporting(E_ALL);
?>
<!DOCTYPE html>
<html lang="en">
<?php require_once('header.php'); ?>
 <body>
<?php  require_once('nav.php'); ?>
<br><br><br><br><br><br>
 
 
<div class="container">
<div class="row">

 
            <?php
           
                $pdo = Database::connect();
                $id = $_GET['id'];
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $sql = 'SELECT * FROM product WHERE id = ?';
                $q = $pdo->prepare($sql);
                $q->execute(array($id));
                $query = $q->fetchAll(PDO::FETCH_ASSOC);
              foreach ($query as $row) {
                  echo '<table class="table table-striped table-bordered">';

                  echo '<form method="POST" action="addToCart.php">';
                  echo '<input type="hidden" name="id" value="' . $row['id'] . '">';

                  echo '<th>'.$row['name'].'</th>';
                  echo '<tbody>';
                  echo '<tr><td><img src="'.$row['image'].'" width="200" height="200"><br></td></tr>';
                 
                  echo '<tr><td>'.$row['description'].'</td></tr>'; 
                  echo '<tr><td><p>Price:</p>'.$row['price'].'</td></td>';
                  if ($loggedin) {
                  echo '<tr><td><input type="submit" value="Add to Cart"></td></tr>';
                  echo '</form>';
                  echo '</tbody></table>';
                  }
               
                }
            
            Database::disconnect();
            ?>
       
      </div>

      <br>
      <br>
      <br>
      <br>
    </div> <!-- /container -->




<br>
<br>
 <br>
<br>









<?php require_once('footer.php'); ?>
</body>
</html>
