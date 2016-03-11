<?php 
 
  require_once('database.php');
  require_once('session.php');
  require_once('crud.php');
error_reporting(E_ALL);
 
    if ( !empty($_POST)) {
      // keep track post values
      $id = $_POST['id'];
      $street = $_POST['street'];
      $city = $_POST['city'];
      $zip = $_POST['zip'];
      $state = $_POST['state'];
      $country = $_POST['country'];

      $address = new UserAddress($_SESSION['uid']);
      $response = $address->update($street,$city,$zip,$state,$country,$id);
      if ($response) {
        header('Location: update.php');
      } else {
        header('Location: update.php');
      }
    }
