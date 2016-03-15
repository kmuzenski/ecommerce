<?php
require_once('session.php');
require_once('database.php');
require_once('crud.php');
Database::connect();
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type"text/css" href="assets/css/styles.css">
<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
</head>
<body>
<?php require_once('nav.php'); 	?>
<br><br><br><br><br><br>

<div id="profile">
<b id="welcome">Welcome : <i><?php echo $_SESSION['username']; ?></i></b>
<b id="logout"><a href="logout.php">Log Out</a></b><br><br>
<a href="update.php">update admin profile</a>
</div>
<br><br><br>


<p><a href="createCategory.php">Create a category</a></p>
<br><br>
<div class="container">
    <div class="row">
      <h3>Update Category info</h3>
    </div>
    <div class="row">
      <table class="table table-striped table-bordered">
        <thead>
          <tr>
            <th>name</th>
            <th>Action</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
	<?php
            $category = new CategoryCrud($_SESSION['uid']);
                
                foreach ($category->read() as $row) {
                 echo '<tr>';
                echo '<form method="POST" action="updateCategory.php">';
                echo '<input type="hidden" name="id" value="' . $row['id'] . '">';
                echo '<td><input type="text" name="name" value="'.$row['name'].'"></td>';
		
		
                echo '<td><input type="submit" value="Update"></td>';
                echo '</form>';
                echo '<form method="POST" action="categoryDelete.php">';
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
	    <th>category</th>
            <th>Action</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
	<?php
            $product = new ProductCrud($_SESSION['uid']);
                
                foreach ($product->read() as $row) {
                 echo '<tr>';
                echo '<form method="POST" action="updateProduct.php">';
                echo '<input type="hidden" name="id" value="' . $row['id'] . '">';
                echo '<td><input type="text" name="name" value="'.$row['name'].'"></td>';
                echo '<td><input type="text" name="description" value="'.$row['description'].'"></td>';
                echo '<td><input type="text" name="price" value="'.$row['price'].'"></td>';
                echo '<td>';
		$pdo = Database::connect();
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $sql = "SELECT * FROM  `bin` ORDER BY `name` ASC";
                $bin = $pdo->query($sql);
		Database::disconnect();
                echo "<select name='bin_FK'>";
                foreach ($bin as $row2) {
                  echo "<option value='" . $row2['id'] . "'";
                  if($row2['id']==$row['bin_FK']){
                        echo " selected ";
                  }
                  echo ">" . $row2['name'] . "</option>";
                
		}
		
                echo "</select>";
                echo "</td>";   
		
		 echo '<td>';
                $pdo = Database::connect();
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $sql = "SELECT * FROM  `category` ORDER BY `name` ASC";
                $cat = $pdo->query($sql);
                Database::disconnect();
                echo "<select name='category_FK'>";
                foreach ($cat as $row3) {
                  echo "<option value='" . $row3['id'] . "'";
                  if($row3['id']==$row['category_FK']){
                        echo " selected ";
                  }
                  echo ">" . $row3['name'] . "</option>";

                }

                echo "</select>";
                echo "</td>";




                echo '<td><input type="submit" value="Update"></td>';
                echo '</form>';
                echo '<form method="POST" action="productDelete.php">';
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








<p><a href="createBin.php">create a bin</a></p>
<div class="container">
    <div class="row">
      <h3>bin</h3>
    </div>



    <div class="row">
      <table class="table table-striped table-bordered">
        <thead>
          <tr>
	    <th>name</th>
            <th>location</th>
            <th>shipmentcenter_FK</th>
	    <th>Action</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php
		$bin = new BinCrud($_SESSION['uid']);
		
		foreach ($bin->read() as $row) {
		echo '<tr>';
                echo '<form method="POST" action="binUpdate.php">';
		echo '<input type="hidden" name="id" value="' . $row['id'] . '">';
		echo '<td><input type="text" name="name" value="' . $row['name'] . '"></td>';
               echo '<td><input type="text" name="location" value="'.$row['location'].'"></td>';
               echo '<td><input type="text" name="shipmentcenter_FK" value="'.$row['shipmentcenter_FK'].'"></td>';
                echo '<td><input type="submit" value="Update"></td>';
                echo '</form>';
                echo '<form method="POST" action="binDelete.php">';
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



<p><a href="createShipmentCenter.php">Create a shipment center</a></p>
<br><br>
<div class="container">
    <div class="row">
      <h3>Update shipment center</h3>
    </div>
    <div class="row">
      <table class="table table-striped table-bordered">
        <thead>
          <tr>
            <th>name</th>
	   <th>address_FK</th>
            <th>Action</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php
              $shipment = new ShipmentCenter($_SESSION['uid']); 
		
		foreach ($shipment->read() as $row) {
	 	 echo '<tr>';
                echo '<form method="POST" action="updateShipmentCenter.php">';
                echo '<input type="hidden" name="id" value="' . $row['id'] . '">';
                echo '<td><input type="text" name="name" value="'.$row['name'].'"></td>';
                echo '<td><input type="text" name="address_FK" value="'.$row['address_FK'].'"></td>';
		echo '<td><input type="submit" value="Update"></td>';
                echo '</form>';
                echo '<form method="POST" action="deleteShipmentCenter.php">';
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



<?php require_once('footer.php');
Database::disconnect();
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
</body>
</html>
