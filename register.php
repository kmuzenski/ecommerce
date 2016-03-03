<?php require_once('session.php'); ?>


<?php

         require 'database.php';

    if ( !empty($_POST)) {
        // keep track validation errors
        $usernameError = null;
        $emailError = null;
	$passwordError = null;

        // keep track post values
        $username = $_POST['username'];
        $email = $_POST['email'];
	$password = $_POST['password'];

        // validate input
        $valid = true;
        if (empty($username)) {
            $usernameError = 'Please enter Name';
            $valid = false;
        }

        if (empty($email)) {
            $emailError = 'Please enter Email Address';
            $valid = false;
        } else if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {
            $emailError = 'Please enter a valid Email Address';
            $valid = false;
        }


	if (empty($password)) {
		$passwordError = 'please enter password';
		$valid = false;
	}


        if ($valid) {
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO users (username,email,password) values(?, ?, ?)";
            $q = $pdo->prepare($sql);

           $q->execute(array($username,$email,$password));

            Database::disconnect();
            header("Location: registersuccess.php");
       }

  }

?>



<!DOCTYPE html>
<html lang="en">
<head>

   <meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">

</head>


<body>

<?php require_once('nav.php'); ?>
<br><br><br><br><br><br>

    <div class="container">

                <div class="span10 offset1">
                    <div class="row">
                        <h3>Register</h3>
                    </div>


     <form class="form-horizontal" action="register.php" method="post">

        <div class="control-group <?php echo !empty($usernameError)?'error':'';?>">                         <label class="control-label">Username</label>
         <div class="controls">
 <input name="username" type="text"  placeholder="username" value="<?php echo !empty($username)?$username:'';?>">

          <?php if (!empty($usernameError)): ?>
          <span class="help-inline"><?php echo $usernameError;?></span>
          <?php endif; ?>
          </div>
          </div>




        <div class="control-group <?php echo !empty($emailError)?'error':'';?>">
        <label class="control-label">Email Address</label>
        <div class="controls">
       <input name="email" type="text" placeholder="Email Address" value="<?php echo !empty($email)?$email:'';?>">

       <?php if (!empty($emailError)): ?>
        <span class="help-inline"><?php echo $emailError;?></span>
        <?php endif;?>
       </div>
       </div>



  <div class="control-group <?php echo !empty($passwordError)?'error':'';?>">
        <label class="control-label">password</label>
        <div class="controls">
       <input name="password" type="text" placeholder="password" value="<?php echo !empty($password)?$password:'';?>">

       <?php if (!empty($passwordError)): ?>
        <span class="help-inline"><?php echo $passwordError;?></span>
        <?php endif;?>
       </div>
       </div>



      <div class="form-actions">
      <button type="submit" class="btn btn-success">Create</button>
      <a class="btn" href="index.php">Back</a>
       </div>
       </form>

         </div>
         </div> <!-- /container -->
<br><br><br><br><br><br>

<br><br><br>
<?php require_once('footer.php'); ?>

 </body>
</html>
