<?php
  require_once('database.php');
  require_once('session.php');
  require_once('crud.php');
 
  if ( !empty($_POST['id']) && isset($_POST['id'])) {
    $category = new CategoryCrud($_SESSION['uid']);
    $response = $category->delete($_POST['id']);
    if($response){
    //  echo "success";
	header("Location: admin.php");
    } else {
      echo "failure";
    }
  } else {
	echo "didnt get param";
} 
