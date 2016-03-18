<?php
require_once('session.php');
require_once('database.php');
require_once('crud.php');
error_reporting(E_ALL);
 
    if ( !empty($_POST)) {
        // keep track post values
      $product_FK = $_POST['id'];
      
	$addProduct = new Cart($_SESSION['uid']);
	$addProduct->addToCart($_SESSION['cart_id'],$product_FK);
      
        header('Location: shoppingcart.php');
      } else {
	echo "error";
}

