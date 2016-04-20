<?php

require_once('database.php');

$search = $_POST['results'];


	try {
	$pdo = Database::connect();
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$$sql = "SELECT * FROM product WHERE name LIKE :search";
	$q = $pdo->prepare($sql);

	$q->execute();
	$matches = $q->fetchAll(PDO::FETCH_ASSOC);
	$json = json_encode($matches);

	echo $json;


	} catch (PDOException $e) {
		echo $e->getMessage();
	}

	?>