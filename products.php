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
 

<?php
/*try  {	$pdo = Database::connect();
	$imgID = $_GET['id'];
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = 'SELECT * FROM images WHERE product_FK = ?';
	$q = $pdo->prepare($sql);
	$q->execute(array($imgID);
	$query = $q->fetchAll(PDO::FETCH_ASSOC);

	foreach ($query as $image) {
	echo '<img src="' . $image['img_link'] . '">';
}	} catch (PDOException $e) {
	echo $e->getMessage();
}
Database::disconnect();
*/
?>

 
<div class="container">
<div class="row">

 
        <table class="table table-striped table-bordered">
          <thead>
            <tr>
              <th></th>
              <th>Name</th>
              <th>Description</th>
              <th>Price</th>
		          <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
           
                $pdo = Database::connect();
                $id = $_GET['id'];
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $sql = 'SELECT * FROM product WHERE id = ?';
                $q = $pdo->prepare($sql);
                $q->execute(array($id));
                $query = $q->fetchAll(PDO::FETCH_ASSOC);
              foreach ($query as $row) {
                  echo '<tr>';
                  echo '<form method="POST" action="addToCart.php">';
                  echo '<input type="hidden" name="id" value="' . $row['id'] . '">';
                  echo '<td><img src="'.$row['image'].'"><br></td>';
                  echo '<td>'.$row['name'].'</td>'; 
                  echo '<td>'.$row['description'].'</td>'; 
                  echo '<td>'.$row['price'].'</td>';

                  echo '<td><input type="submit" value="Add to Cart"></td>';
                  echo '</form>';
                  echo '</tr>';
                }
            
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














 <?php require_once('footer.php'); ?>
</body>
</html>
