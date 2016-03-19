<?php require_once('database.php');
	require_once('session.php');
	require_once('crud.php');


$order = new Cart($_SESSION['uid']);
$order->checkout();


header("Location: confirmedOrder.php");


