<?php
 error_reporting(E_ALL);
    require_once('database.php');
    require_once('session.php');
    require_once('crud.php');


    if ( !empty($_POST)) {
      // keep track post values
      
      $id = $_POST['id'];
      $name = $_POST['name'];
      $number = $_POST['number'];
      $expiration = $_POST['expiration'];
      $securitycode = $_POST['securitycode'];
      $type = $_POST['type'];
      $address_FK = $_POST['address_FK'];
      
	$creditcard = new UserCredit($_SESSION['uid']);
      $response = $creditcard->update($name,$number,$expiration,$securitycode,$type,$address_FK,$id);
  
	
    
/*	if ($response) {
        header("Location: update.php");
     // echo "it worked";
	} else {
       // header("Location: update.php");
	echo "it didnt work";

      }
*/
    }






