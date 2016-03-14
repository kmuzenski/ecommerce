<?php

  require_once('database.php');
  require_once('session.php');
  require_once('crud.php');
error_reporting(E_ALL);

if ( !empty($_POST)) {
      // keep track post values
      $id = $_POST['id'];
      $name = $_POST['name'];
      $address_FK = $_POST['address_FK'];
      
      $shipment = new ShipmentCenter($_SESSION['uid']);
      $response = $shipment->update($name,$address_FK,$id);
      if ($response) {
       // header('Location: admin.php');
	echo $response;
      } else {
       // header('Location: admin.php');
        echo "didnt work";
	}
    }
