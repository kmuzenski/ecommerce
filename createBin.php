<?php

require_once('session.php');
error_reporting(E_ALL);
require_once('database.php');
require_once('crud.php');
 

   if ( !empty($_POST)) {
         
        // keep track post values
      $name = $_POST['name'];
      $location = $_POST['location'];
      $shipmentcenter_FK = $_POST['shipmentcenter_FK'];
	
      $createBin = new BinCrud($_SESSION['uid']);
     $response = $createBin->create($name,$location,$shipmentcenter_FK);
  
if ($response) {
    header("Location: admin.php");
  } else {
    header("Location: admin.php");
  }
}





	
?>



<!DOCTYPE html>
<html lang="en">
 <?php require_once('header.php'); ?>

 
  <body>

<?php require_once('nav.php'); ?>
<br><br><br><br><br><br>

    <div class="container">
      <div class="span10 offset1">
        <div class="row">
          <h3>Please fill out all fields to create a bin</h3>
        </div>           
        <form class="form-horizontal" action="createBin.php" method="post"> 

          <div class="control-group <?php echo !empty($nameError)?'error':'';?>">
            <label class="control-label">name</label>
            <div class="controls">
              <input name="name" type="text" placeholder="name" value="<?php echo !empty($name)?$name:'';?>">
              <?php if (!empty($nameError)): ?>
                <span class="help-inline"><?php echo $nameError;?></span>
              <?php endif;?>
            </div>
          </div>


          <div class="control-group <?php echo !empty($locationError)?'error':'';?>">
            <label class="control-label">location</label>
            <div class="controls">
              <input name="location" type="text" placeholder="location" value="<?php echo !empty($location)?$location:'';?>">
              <?php if (!empty($locationError)): ?>
                <span class="help-inline"><?php echo $locationError;?></span>
              <?php endif;?>
            </div>
          </div>
	



<br><br><br>

	<?php
            try {
              $pdo = Database::connect();
              $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
              $sql = "SELECT `shipmentcenter`.`id`, `shipmentcenter`.`name` FROM `shipmentcenter` ORDER BY `name` ASC";
	     $bin = $pdo->query($sql);
              echo "<select name='shipmentcenter_FK'>";
              foreach ($bin as $row) {
                echo "<option value='" . $row['id'] . "'>" . $row['name'] . "</option>";
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
            <button type="submit" class="btn btn-success">Add Bin</button>
          </div>
        </form>
      </div>
    </div>

    <?php require_once('footer.php');?>

  <script src="assets/js/jquery.min.js"></script>
  <script src="assets/js/bootstrap.min.js"></script>

 </body>
</html>
