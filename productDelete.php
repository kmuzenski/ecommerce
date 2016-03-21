<?php
  require_once('database.php');
  require_once('session.php');
  require_once('crud.php');
error_reporting(E_ALL);
 
  if ( !empty($_POST['id']) && isset($_POST['id'])) {
//  echo $_POST['id'];
//die();

    $product = new ProductCrud($_SESSION['uid']);
    $response = $product->delete($_POST['id']);

if ($response) { 
// header('Location: admin.php');
echo "worked";
	} else  {
		echo "fail";
}
}
  
