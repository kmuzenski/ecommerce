<?php
require_once('session.php');
error_reporting(E_ALL);
require_once('database.php');
 
    if ( !empty($_POST)) {
        // keep track validation errors
      $streetError = null;
      $cityError = null;
      $zipError = null;
      $stateError = null;
      $countryError = null;
         
        // keep track post values
      $street = $_POST['street'];
      $city = $_POST['city'];
      $zip = $_POST['zip'];
      $state = $_POST['state'];
      $country = $_POST['country'];
         
        // validate input
      $valid = true;
        
      if (empty($street)) {
        $streetError = 'Please enter Street';
        $valid = false;
      }
      if (empty($city)) {
        $cityError = 'Please enter City';
        $valid = false;
      }
      if (empty($zip)) {
        $zipError = 'Please enter zip';
        $valid = false;
      }
      if (empty($state)) {
        $stateError = 'Please enter state';
        $valid = false;
      }
      if (empty($country)) {
        $countryError = 'Please enter Country';
        $valid = false;
      }
         
        // insert data
      if ($valid) {
        try {
          $pdo = Database::connect();
          $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $sql = "INSERT INTO address (street,city,zip,state,country) values(?, ?, ?, ?, ?)";
          $q = $pdo->prepare($sql);
          $q->execute(array($street,$city,$zip,$state,$country));
	 
	  $addressID = $pdo->lastInsertId();
          $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $sql = "INSERT INTO user_address (address_FK,user_FK) values(?,?)";
          $q = $pdo->prepare($sql);
          $q->execute(array($addressID, $_SESSION['uid']));
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


    <title>create address</title>
 </head>
  
  <body>
<br><br><br><br><br><br>

    <div class="container">
      <div class="span10 offset1">
        <div class="row">
          <h3>Please fill out all fields to create an address.</h3>
        </div>           
        <form class="form-horizontal" action="createAddress.php" method="post"> 

          <div class="control-group <?php echo !empty($streetError)?'error':'';?>">
            <label class="control-label">Street Number</label>
            <div class="controls">
              <input name="street" type="text" placeholder="Street" value="<?php echo !empty($street)?$street:'';?>">
              <?php if (!empty($streetError)): ?>
                <span class="help-inline"><?php echo $streetError;?></span>
              <?php endif;?>
            </div>
          </div>


          <div class="control-group <?php echo !empty($cityError)?'error':'';?>">
            <label class="control-label">City</label>
            <div class="controls">
              <input name="city" type="text" placeholder="City" value="<?php echo !empty($city)?$city:'';?>">
              <?php if (!empty($cityError)): ?>
                <span class="help-inline"><?php echo $cityError;?></span>
              <?php endif;?>
            </div>
          </div>

          <div class="control-group <?php echo !empty($zipError)?'error':'';?>">
            <label class="control-label">zip</label>
            <div class="controls">
              <input name="zip" type="text" placeholder="zip" value="<?php echo !empty($zip)?$zip:'';?>">
              <?php if (!empty($zipError)): ?>
                <span class="help-inline"><?php echo $zipError;?></span>
              <?php endif;?>
            </div>
          </div>

          <div class="control-group <?php echo !empty($stateError)?'error':'';?>">
            <label class="control-label">state</label>
            <div class="controls">
              <input name="state" type="text" placeholder="state" value="<?php echo !empty($state)?$state:'';?>">
              <?php if (!empty($stateError)): ?>
                <span class="help-inline"><?php echo $stateError;?></span>
              <?php endif;?>
            </div>
          </div>

          <div class="control-group <?php echo !empty($countryError)?'error':'';?>">
            <label class="control-label">Country</label>
            <div class="controls">
              <input name="country" type="text" placeholder="Country" value="<?php echo !empty($country)?$country:'';?>">
              <?php if (!empty($countryError)): ?>
                <span class="help-inline"><?php echo $countryError;?></span>
              <?php endif;?>
            </div>
          </div>
                        
          <div class="form-actions">
            <button type="submit" class="btn btn-success">Add Address</button>
          </div>
        </form>
      </div>
    </div>

    <?php require_once('footer.php');?>

  <script src="assets/js/jquery.min.js"></script>
  <script src="assets/js/bootstrap.min.js"></script>

 </body>
</html>
