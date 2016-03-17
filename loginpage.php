<?php require_once('session.php'); ?> 



<!DOCTYPE html>
<html>


<?php require_once('header.php'); ?>

<body>
	<?php require_once('nav.php'); ?>
	<br><br><br><br><br><br>

<center>
	<div class "container">

	<div id="login">
	<h1>Login</h1>
<br><br>

	<form action="login.php" method="post">

		<label>UserName :</label>
		<input id="name" name="username" placeholder="username" type="text">
		<br><br>
		<label>Password :</label>
		<input id="password" name="password" placeholder="**********" type="password">
		<br><br>
		<input name="submit" type="submit" value=" Login ">
		</form>
	<br><br><br>

	<p><a href="index.php">back</a></p>


	</div>
	</div>

	<br><br><br><br><br>
	<?php require_once('footer.php'); ?>
</center>
</body>
</html>
