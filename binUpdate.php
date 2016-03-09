<?php
 error_reporting(E_ALL);
    require_once 'database.php';

    if ( !empty($_POST)) {
      // keep track post values
      $id = $_POST['id'];
      $name = $_POST['name'];
      $location = $_POST['location'];
      $shipmentcenter_FK = $_POST['shipmentcenter_FK'];

      function valid($varname){
        return ( !empty($varname) && isset($varname) );
      }
      if (!valid($name) || !valid($location) || !valid($shipmentcenter_FK)) {
        header("Location: update.php");
      }
      $pdo = Database::connect();
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $sql = "UPDATE bin SET name = ?, location = ?, shipmentcenter_FK = ?  WHERE id = ?";
       $q = $pdo->prepare($sql);
       $q->execute(array($name,$location,$shipmentcenter_FK,$id));
         Database::disconnect();
       header("Location: admin.php");
    }
