<?php

require_once('database.php');


	try {
	$pdo = Database::connect();
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	$query = "SELECT * FROM product WHERE name LIKE '%{key}%' ";
	$q = $pdo->prepare($query);
	$q->execute();
	$results = $q->fetch(PDO:FETCH_ASSOC);

	echo $results;


	} catch (PDOException $e) {
		echo $e->getMessage();
	}

	?>