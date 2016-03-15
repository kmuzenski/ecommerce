<?php
require_once('session.php');
error_reporting(E_ALL);
require_once('database.php');
require_once('crud.php');
    if ( !empty($_POST)) {
         
        // keep track post values
      $name = $_POST['name'];
	
      $createCategory = new CategoryCrud($_SESSION['uid']);
     $response = $createCategory->create($name);
  
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


    <title>create category</title>
 </head>

  <body>
<br><br><br><br><br><br>

    <div class="container">
      <div class="span10 offset1">
        <div class="row">
          <h3>Please fill out all fields to create a category</h3>
        </div>
        <form class="form-horizontal" action="createCategory.php" method="post">

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
          <div class="form-actions">
            <button type="submit" class="btn btn-success">Add Category</button>
          </div>
        </form>
      </div>
    </div>

    <?php require_once('footer.php');?>

  <script src="assets/js/jquery.min.js"></script>
  <script src="assets/js/bootstrap.min.js"></script>

 </body>
</html>
