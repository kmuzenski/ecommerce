<?php
require_once('database.php');


	if(!empty($_POST['username']) && isset ($_POST['username'])) {
		if(!empty($_POST['password']) && isset($_POST['password'])) {

		$pdo = Database::connect();



	// Define $username and $password
	$username=$_POST['username'];
	$password=$_POST['password'];


	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "SELECT * FROM users WHERE username = ? AND password = ?";
	$q = $pdo->prepare($sql);
	$q->execute(array($username,$password));
	$query = $q->fetch(PDO::FETCH_ASSOC);
	Database::disconnect();


	$username = $query['username'];
	$permission = $query['permission'];
	$uid = $query['uid'];

	session_start();
	$_SESSION['username'] = $username;
	$_SESSION['permission'] = $permission;
	$_SESSION['uid'] = $uid

	header('Location: profile.php');
	
}

}	
?>
