<?php


  require_once('database.php');
  require_once('session.php');
  require_once('crud.php');
error_reporting(E_ALL);
 
    if ( !empty($_POST)) {
      // keep track post values
      $id = $_POST['id'];
      $name = $_POST['name'];
      $location = $_POST['location'];
      $shipmentcenter_FK = $_POST['shipmentcenter_FK'];
      
      $binUpdate = new BinCrud($_SESSION['uid']);
      $response = $binUpdate->update($name,$location,$shipmentcenter_FK,$id);
      if ($response) {
        header('Location: admin.php');
      } else {
        header('Location: admin.php');
      }
    }
