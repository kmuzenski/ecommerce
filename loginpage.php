<?php
include('login.php'); // Includes Login Script

if(isset($_SESSION['login_user'])){
header("location: profile.php");
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Login Form</title>
<link href="assets/css/bootstrap.css" rel="stylesheet" type="text/css">
</head>
<body>
<?php require_once('nav.php'); ?>
<br><br><br><br><br><br>
<div id="main">
<h1>Welcome</h1>
<div id="login">
<h2>Login Form</h2>
<form action="" method="post">
<label>UserName :</label>
<input id="name" name="username" placeholder="username" type="text">
<label>Password :</label>
<input id="password" name="password" placeholder="**********" type="password">
<input name="submit" type="submit" value=" Login ">
<span><?php echo $error; ?></span>
</form>


<br><br><br>

<p><a href="index.php">back</a></p>



</div>
</div>
</body>
</html>
