<?php
  require_once('database.php');
  require_once('session.php');
  require_once('crud.php');
error_reporting(E_ALL);
 
    if ( !empty($_POST)) {
      // keep track post values
      $id = $_POST['id'];
      $name = $_POST['name'];
      
      $category = new CategoryCrud($_SESSION['uid']);
      $response = $category->update($name,$id);
      if ($response) {
        header('Location: admin.php');
      } else {
        header('Location: admin.php');
      }
    }
