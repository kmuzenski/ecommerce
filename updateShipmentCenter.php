<?php
 error_reporting(E_ALL);
    require_once 'database.php';
    if ( !empty($_POST)) {
      // keep track post values
      $id = $_POST['id'];
      $name = $_POST['name'];
      $address_FK = $_POST['address_FK'];
      function valid($varname){
        return ( !empty($varname) && isset($varname) );
      }
      if (!valid($name) || !valid($address_FK)) {
        header("Location: update.php");
      }
      $pdo = Database::connect();
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $sql = "UPDATE shipmentcenter SET name = ?, address_FK = ?  WHERE id = ?";
       $q = $pdo->prepare($sql);
       $q->execute(array($name,$address_FK,$id));
         Database::disconnect();
       header("Location: admin.php");
    }
