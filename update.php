<?php require_once('session.php'); ?>
<?php require_once('database.php'); ?>

<!DOCTYPE html>
<html lang ="en">

<head>


<title>Update</title>

</head>

<body>

<?php require_once('navbar.php'); ?>




<div class="container">
<div class="row">
<h3> Update User Info</h3>
</div>

<div class="row">
<table class="table table-striped table-bordered">
<thead>
<tr>
<th>username</th>
<th>email</th>
<th>password</th>
<th>Action</th>
<th>Action</th>
</thead>
<tbody>



<?php
    /*    if($loggedin) {
	$pdo = Database::connect();
	$username = $_SESSION['username'];
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = 'SELECT * FROM users WHERE username = ?';
	$q = $pdo->prepare($sql);
	$q->execute(array($username));
	$query = $q->fetch(PDO::FETCH_ASSOC);
	

	   	echo '<tr>';
                echo '<form method="POST" action="userUpdate.php">';
                echo '<input type="hidden" name="id" value="' . $query['id'] . '">';
                echo '<td><input type="text" name="username" value="'.$query['username'].'"></td>'; 
                echo '<td><input type="text" name="email" value="'.$query['email'].'"></td>';
                echo '<td><input type="text" name="password" value"'.$query['password'].'"></td>';
                echo '<td><input type="submit" value="Update"></td>';
                echo '</form>';
                echo '<form method="POST" action="userDelete.php">';
                echo '<input type="hidden" name="id" value="' . $query['id'] . '">';
                echo '<td><input type="submit" value="Delete"></td>';
                echo '</form>';
                echo '</tr>';
	}

	Database::disconnect();
*/

echo "fml";
?>
</tbody>
</table>
</div>

<br><br>

</body>
</html>

