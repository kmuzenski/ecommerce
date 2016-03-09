<?php
require_once('session.php');
error_reporting(E_ALL);
require_once('database.php');
    if ( !empty($_POST)) {
        // keep track validation errors
      $nameError = null;
      
        // keep track post values
    	$id = $_POST['id'];
	  $name = $_POST['name'];
	$address_FK = $_POST['address_FK'];
        // validate input
      $valid = true;
      if (empty($name)) {
        $nameError = 'Please enter name';
        $valid = false;
      }
      // insert data
      if ($valid) {
        try {
          $pdo = Database::connect();
          $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $sql = "INSERT INTO shipmentcenter (name,address_FK) values(?,?)";
          $q = $pdo->prepare($sql);
          $q->execute(array($name,$address_FK));
	 
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


    <title> create shipmentcenter</title>
 </head>

  <body>
<br><br><br><br><br><br>

    <div class="container">
      <div class="span10 offset1">
        <div class="row">
          <h3>Please fill out all fields to create a shipment center</h3>
        </div>
        <form class="form-horizontal" action="createShipmentCenter.php" method="post">

          <div class="control-group <?php echo !empty($nameError)?'error':'';?>">
            <label class="control-label">name</label>
            <div class="controls">
              <input name="name" type="text" placeholder="name" value="<?php echo !empty($name)?$name:'';?>">
              <?php if (!empty($nameError)): ?>
                <span class="help-inline"><?php echo $nameError;?></span>
              <?php endif;?>
            </div>
          </div>



	<br><br><br>

	<?php
            try {
              $pdo = Database::connect();
              $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
              $sql = "SELECT `address`.`id`, `address`.`street` FROM `address` LEFT JOIN `user_address` ON `address`.`id`=`user_address`.`address_FK` WHERE (`user_address`.`user_FK` = ". $_SESSION['uid'] . ")";
              $address = $pdo->query($sql);
              echo "<select name='address_FK'>";
              foreach ($address as $row) {
                echo "<option value='" . $row['id'] . "'>" . $row['street'] . "</option>";
              }
              echo "</select>";
              Database::disconnect();
            } catch (PDOException $e) {
              echo $e->getMessage();
              Database::disconnect();
            }
          ?>

<br><br><br>






          <div class="form-actions">
            <button type="submit" class="btn btn-success">Add shipment center</button>
          </div>
        </form>
      </div>
    </div>

    <?php require_once('footer.php');?>

  <script src="assets/js/jquery.min.js"></script>
  <script src="assets/js/bootstrap.min.js"></script>

 </body>
</html>
