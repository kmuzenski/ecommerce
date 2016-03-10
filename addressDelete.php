<?php
  require_once('database.php');
  require_once('session.php');
  require_once('crud.php');
 
  if ( !empty($_POST['id']) && isset($_POST['id'])) {
    $address = new UserAddress($_SESSION['id']);
    $response = $address->delete($_POST['id']);
    if($response){
    //  echo "success";
	header("location: update.php");
    } else {
      echo "failure";
    }
  } else {
    // redirect
    echo "didn't get param";
  }
