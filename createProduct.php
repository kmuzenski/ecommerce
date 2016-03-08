<?php
require_once('session.php');
error_reporting(E_ALL);
require_once('database.php');

    if ( !empty($_POST)) {
        // keep track validation errors
      $nameError = null;
      $descriptionError = null;
      $priceError = null;
      

        // keep track post values
      $name = $_POST['name'];
      $description = $_POST['description'];
      $price = $_POST['price'];
	

        // validate input
      $valid = true;

      if (empty($name)) {
        $nameError = 'Please enter name';
        $valid = false;
      }
      if (empty($description)) {
        $descriptionError = 'Please enter description';
        $valid = false;
      }
      if (empty($price)) {
        $priceError = 'Please enter price';
        $valid = false;
      }


      // insert data
      if ($valid) {
        try {
          $pdo = Database::connect();
          $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $sql = "INSERT INTO product (name,description,price) values(?, ?, ?)";
          $q = $pdo->prepare($sql);
          $q->execute(array($name,$description,$price));

	 $productID = $pdo->lastInsertId();
	 
	 $sql = "INSERT INTO product_bin (product_FK,bin_FK) values(?, ?)";
	 $q = $pdo->prepare($sql);
	 $q->execute(array($productID,$bin_FK));
          Database::disconnect();
         header("Location: admin.php");
        }
         catch (PDOException $e) {
          echo $e->getMessage();
        }
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



			<label class="control-label">Bin ID</label>
                      
                        <select name="id">
                            <?php
                                $pdo = Database::connect();
                                $sql = 'SELECT * FROM bin ORDER BY id DESC';                         
                                   foreach ($pdo->query($sql) as $row) {
                                            echo '<option name="id" value="' . $row["id"] . '">' . $row["id"] . '</option>';
                                  }
                                   Database::disconnect();
                                  ?>
                        </select>
			<br><br>

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

