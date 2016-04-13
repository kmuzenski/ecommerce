<?php

  require_once('database.php');
  require_once('session.php');
  require_once('crud.php');
 
  if ( !empty($_POST['id']) && isset($_POST['id'])) {
    $bin = new BinCrud();
    $response = $bin->delete($_POST['id']);
    if($response){
   	header("Location: admin.php");
    } else {
      echo "failure";
    }
  } else {
    // redirect
    echo "didn't get param";
  }
