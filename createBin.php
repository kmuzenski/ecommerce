<?php
require_once('session.php');
error_reporting(E_ALL);
require_once('database.php');
 
    if ( !empty($_POST)) {
        // keep track validation errors
      $nameError = null;
      $locationError = null;
         
        // keep track post values
	$name = $_POST['name'];
        $location = $_POST['location'];
	$shipmentcenter_FK = $_POST['shipmentcenter_FK'];
         
        // validate input
      $valid = true;
        
      if (empty($name)) {
        $nameError = 'Please enter name';
        $valid = false;
      }
      if (empty($location)) {
        $locationError = 'Please enter location of the bin';
        $valid = false;
      }
         
        // insert data
      if ($valid) {
        try {
          $pdo = Database::connect();
          $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $sql = "INSERT INTO bin (name,location) values(?, ?)";
          $q = $pdo->prepare($sql);
          $q->execute(array($name,$location));
	 
	  $binID = $pdo->lastInsertId();
          $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $sql = "INSERT INTO bin_shipment (bin_FK,shipmentcenter_FK) values(?,?)";
          $q = $pdo->prepare($sql);
          $q->execute(array($binID,$shipmentcenter_FK));
          Database::disconnect();
	 header("Location: update.php");
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


    <title>create bin</title>
 </head>
  
  <body>
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
	
	<label class ="control-label">Shipment Center ID </label>
	<select name ="id">
	<?php
		$pdo = Database::connect();
		$sql = 'SELECT * FROM shipmentcenter ORDER BY id DESC';
			foreach ($pdo->query($sql) as $row) {
			 echo '<option name="id" value="' . $row["id"] . '">' . $row["id"] . '</option>';
                                  }
                                   Database::disconnect();
                                  ?>
                        </select>
			<br><br>




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
