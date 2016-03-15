<?php
require_once('session.php');
error_reporting(E_ALL);
require_once('database.php');
require_once('crud.php');
    if ( !empty($_POST)) {
         
        // keep track post values
      $name = $_POST['name'];
      $description = $_POST['description'];
      $price = $_POST['price'];
      $bin_FK = $_POST['bin_FK'];
	
      $createProduct = new ProductCrud($_SESSION['uid']);
     $response = $createProduct->create($name,$description,$price,$bin_FK);
  
if($response) {
    header("Location: admin.php");
  
  } else {
    header("Location: admin.php");
  }
}
?>

<!DOCTYPE html>
<html lang="en">
 <head>


    <title>create product</title>
 </head>

  <body>
<br><br><br><br><br><br>

    <div class="container">
      <div class="span10 offset1">
        <div class="row">
          <h3>Please fill out all fields to create a product</h3>
        </div>
        <form class="form-horizontal" action="createProduct.php" method="post">

          <div class="control-group <?php echo !empty($nameError)?'error':'';?>">
            <label class="control-label">name</label>
            <div class="controls">
              <input name="name" type="text" placeholder="name" value="<?php echo !empty($name)?$name:'';?>">
              <?php if (!empty($nameError)): ?>
                <span class="help-inline"><?php echo $nameError;?></span>
              <?php endif;?>
            </div>
          </div>


          <div class="control-group <?php echo !empty($descriptionError)?'error':'';?>">
            <label class="control-label">description</label>
            <div class="controls">
              <input name="description" type="text" placeholder="description" value="<?php echo !empty($description)?$description:'';?>">
              <?php if (!empty($descriptionError)): ?>
                <span class="help-inline"><?php echo $descriptionError;?></span>
              <?php endif;?>
            </div>
          </div>

          <div class="control-group <?php echo !empty($priceError)?'error':'';?>">
            <label class="control-label">price</label>
            <div class="controls">
              <input name="price" type="text" placeholder="price" value="<?php echo !empty($price)?$price:'';?>">
              <?php if (!empty($priceError)): ?>
                <span class="help-inline"><?php echo $priceError;?></span>
              <?php endif;?>
            </div>
            </div>
		<br><br><br>
		
		<?php
            try {
              $pdo = Database::connect();
              $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
              $sql = "SELECT `bin`.`id`, `bin`.`name` FROM `bin`";
              $bin = $pdo->query($sql);
              echo "<select name='bin_FK'>";
              foreach ($bin as $row) {
                echo "<option value='" . $row['id'] . "'>" . $row['name'] . "</option>";
              }
              echo "</select>";
	//	Database::disconnect();
            } catch (PDOException $e) {
              echo $e->getMessage();
             Database::disconnect(); 
            }
          ?>



		<br><br><br>
          <div class="form-actions">
            <button type="submit" class="btn btn-success">Add Product</button>
          </div>
        </form>
      </div>
    </div>

    <?php require_once('footer.php');?>

  <script src="assets/js/jquery.min.js"></script>
  <script src="assets/js/bootstrap.min.js"></script>

 </body>
</html>

