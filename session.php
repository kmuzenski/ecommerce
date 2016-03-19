<?php


session_start();

$loggedin = false;
if (!empty($_SESSION['uid'])) {
	$loggedin = true;



}

?>
