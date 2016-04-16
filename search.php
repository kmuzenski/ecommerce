<?php

require_once('database.php');
require_once('session.php');

	$key = $_GET['key'];
	$array = array();
	$pdo = Database::connect();
	$query = "SELECT * FROM product WHERE <name> LIKE '%{key}%' ";

	while ($row = mysql_fetch_assoc($query)) {
		$array[] = $row['title'];
	}

	echo json_encode($array);

	?>