<?php



  require_once('database.php');
  require_once('session.php');
  require_once('crud.php');
 
  if ( !empty($_POST['id']) && isset($_POST['id'])) {
    $creditcard = new UserCredit($_SESSION['uid']);
    $response = $creditcard->delete($_POST['id']);
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
