<?php


session_start();

$loggedin = false;
if (!empty($_SESSION['username'])) {
	$loggedin = true;
}
?>
