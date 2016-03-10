<?php 
 
  require_once('database.php');
  if ( !empty($_POST)) {
    // keep track post values
    $add_id = $_POST['add_id'];
    $street = $_POST['street'];
    $city = $_POST['city'];
    $zip = $_POST['zip'];
    $state = $_POST['state'];
    $country = $_POST['country'];
    
    
    function valid($uservar){
      return ( !empty($uservar) && isset($uservar) );
    }
    if ( !valid($street) || !valid($city) || !valid($zip) || !valid($state) || !valid($country) {
      header("Location: update.php");
    }
    try {
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $sql = "UPDATE address SET street = ?, city = ?, zip = ?, state = ?, country = ? WHERE id = ?";
      $q = $pdo->prepare($sql);
      $q->execute(array($street,$city,$zip,$state,$country,$add_id));
      header("Location: update.php");
    } catch (PDOException $error){
      echo "Error: " . $error->getMessage();
      die();
    }
  } else {
    header("Location: update.php");
  }
