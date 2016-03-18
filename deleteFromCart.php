<?php
    require_once('session.php');
    require_once('database.php');
    require_once('crud.php');
 
    if ( !empty($_POST['id']) && isset($_POST['id'])) {
      $productTransactionID = $_POST['id'];
      $deleteFromCart = new Cart($_SESSION['uid']);
      $deleteFromCart->deleteFromCart($productTransactionID);
        header('Location: shoppingcart.php');
    }
