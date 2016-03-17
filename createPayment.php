<?php
require_once('session.php');
error_reporting(E_ALL);
require_once('database.php');
require_once('crud.php');

    if ( !empty($_POST)) {
         
        // keep track post values
      $name = $_POST['name'];
      $number = $_POST['number'];
      $expiration = $_POST['expiration'];
      $securitycode = $_POST['securitycode'];
      $type = $_POST['type'];
      $address_FK = $_POST['address_FK'];
	
      $createCredit = new UserCredit($_SESSION['uid']);
     $response = $createCredit->create($name,$number,$expiration,$securitycode,$type,$address_FK);
  
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
          <h3>Please fill out all fields to create a credit card payment method</h3>
        </div>
        <form class="form-horizontal" action="createPayment.php" method="post">

          <div class="control-group <?php echo !empty($nameError)?'error':'';?>">
            <label class="control-label">Name</label>
            <div class="controls">
              <input name="name" type="text" placeholder="name" value="<?php echo !empty($name)?$name:'';?>">
              <?php if (!empty($nameError)): ?>
                <span class="help-inline"><?php echo $nameError;?></span>
              <?php endif;?>
            </div>
          </div>


          <div class="control-group <?php echo !empty($numberError)?'error':'';?>">
            <label class="control-label">number</label>
            <div class="controls">
              <input name="number" type="text" placeholder="number" value="<?php echo !empty($number)?$number:'';?>">
              <?php if (!empty($numberError)): ?>
                <span class="help-inline"><?php echo $numberError;?></span>
              <?php endif;?>
            </div>
          </div>

          <div class="control-group <?php echo !empty($expirationError)?'error':'';?>">
            <label class="control-label">expiration</label>
            <div class="controls">
              <input name="expiration" type="text" placeholder="expiration" value="<?php echo !empty($expiration)?$expiration:'';?>">
              <?php if (!empty($expirationError)): ?>
                <span class="help-inline"><?php echo $expirationError;?></span>
              <?php endif;?>
            </div>
          </div>

          <div class="control-group <?php echo !empty($securitycodeError)?'error':'';?>">
            <label class="control-label">security code</label>
            <div class="controls">
              <input name="securitycode" type="text" placeholder="securitycode" value="<?php echo !empty($securitycode)?$securitycode:'';?>">
              <?php if (!empty($securitycodeError)): ?>
                <span class="help-inline"><?php echo $securitycodeError;?></span>
              <?php endif;?>
            </div>
          </div>

          <div class="control-group <?php echo !empty($typeError)?'error':'';?>">
            <label class="control-label">type</label>
            <div class="controls">
              <input name="type" type="text" placeholder="type" value="<?php echo !empty($type)?$type:'';?>">
              <?php if (!empty($typeError)): ?>
                <span class="help-inline"><?php echo $typeError;?></span>
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
            <button type="submit" class="btn btn-success">Add Payment Method</button>
          </div>
        </form>
      </div>
    </div>

    <?php require_once('footer.php');?>

  <script src="assets/js/jquery.min.js"></script>
  <script src="assets/js/bootstrap.min.js"></script>

 </body>
</html>
