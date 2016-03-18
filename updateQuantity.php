<?php
 error_reporting(E_ALL);
    require_once('database.php');
    require_once('crud.php');
    require_once('session.php');
 
    if ( !empty($_POST)) {
      // keep track post values
      $quantity = $_POST['quantity'];
      $productTransactionID = $_POST['id'];
      $updateQuantity = new Cart($_SESSION['uid']);
      $update = $updateQuantity->updateQ($quantity,$productTransactionID);
        header('Location: shoppingcart.php');
      }
