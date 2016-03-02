<?php
    require_once('database.php');
    require_once('session.php');
      
	 $id = $_SESSION['id'];
  
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
            $usernameError = 'Please enter username';
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


        // update data
        if ($valid) {
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
             $sql = "UPDATE users  set username = ?, email = ?, password = ? WHERE id = ?";
	    $q = $pdo->prepare($sql);
            $q->execute(array($username,$email,$password,$id));
           
	    Database::disconnect();
            header("Location: index.php");
        }
    }

	 else {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM users WHERE id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        $username = $data['username'];
        $email = $data['email'];
        $password = $data['password'];
        Database::disconnect();
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
</head>

<body>
    <div class="container">

                <div class="span10 offset1">
                    <div class="row">
                        <h3>Info</h3>
                    </div>
                    <form class="form-horizontal" action="update.php?id=<?php echo $id?>" method="post">
                      <div class="control-group <?php echo !empty($usernameError)?'error':'';?>">
                        <label class="control-label">username</label>
                        <div class="controls">
                            <input name="username" type="text"  placeholder="username" value="<?php echo !empty($username)?$username:'';?>">
                            <?php if (!empty($usernameError)): ?>
                                <span class="help-inline"><?php echo $usernameError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>

                      <div class="control-group <?php echo !empty($emailError)?'error':'';?>">
                        <label class="control-label">email</label>
                        <div class="controls">
                            <input name="email" type="text" placeholder="email" value="<?php echo !empty($email)?$email:'';?>">
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
                          <button type="submit" class="btn btn-success">Update</button>
                          <a class="btn" href="index.php">Back</a>
                        </div>
                    </form>
                </div>

    </div> <!-- /container -->
  </body>
</html>
