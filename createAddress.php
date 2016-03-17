<?php
error_reporting(E_ALL);
require_once 'database.php';
require_once 'crud.php';
require_once 'session.php';
 
    if ( !empty($_POST)) {
         
        // keep track post values
      $street = $_POST['street'];
      $city = $_POST['city'];
      $zip = $_POST['zip'];
      $state = $_POST['state'];
      $country = $_POST['country'];
	
      $address = new UserAddress($_SESSION['uid']);

	$response = $address->create($street,$city,$zip,$state,$country);
  
if ($response) {
    header("Location: update.php");
  } else {
    header("Location: update.php");
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
