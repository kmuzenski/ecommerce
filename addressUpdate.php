<?php
 error_reporting(E_ALL);
    require_once 'database.php';
 
    if ( !empty($_POST)) {
      // keep track post values
      $id = $_POST['id'];
     $street = $_POST['street'];
      $city = $_POST['city'];
      $zip = $_POST['zip'];
      $state = $_POST['state'];
      $country = $_POST['country'];
         
      function valid($varname){
        return ( !empty($varname) && isset($varname) );
      }
      if (!valid($street) || !valid($city) || !valid($zip) || !valid($state) || !valid($country)) {
        header("Location: update.php");
      }
      $pdo = Database::connect();
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $sql = "UPDATE address SET street = ?, city = ?, zip = ?, state = ?, country = ? WHERE id = ?";
       $q = $pdo->prepare($sql);
       $q->execute(array($street,$city,$zip,$state,$country,$id));
    echo "id is $id";
	//print_r($q); 
	// Database::disconnect();
    
      // header("Location: update.php");


    }
