<?php 
 
  require_once('database.php');
  require_once('session.php');
  require_once('crud.php');
error_reporting(E_ALL);
 
    if ( !empty($_POST)) {
      // keep track post values
      $id = $_POST['id'];
      $name = $_POST['name'];
      $description = $_POST['description'];
      $price = $_POST['price'];
      $bin_FK = $_POST['bin_FK'];
      
      $product = new ProductCrud($_SESSION['uid']);
      $response = $product->update($name,$description,$price,$bin_FK,$id);
      if ($response) {
        header('Location: admin.php');
      } else {
        header('Location: admin.php');
      }
    }
