<?php
 error_reporting(E_ALL);
    require_once 'database.php';

    if ( !empty($_POST)) {
      // keep track post values
      $id = $_POST['id'];
      $name = $_POST['name'];
      $number = $_POST['number'];
      $expiration = $_POST['expiration'];
      $securitycode = $_POST['securitycode'];
      $type = $_POST['type'];



      function valid($varname){
        return ( !empty($varname) && isset($varname) );
      }
      if (!valid($name) || !valid($number) || !valid($expiration) || !valid($securitycode) || !valid($type)) {
        header("Location: update.php");
      }
      $pdo = Database::connect();
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $sql = "UPDATE creditcard SET name = ?, number = ?, expiration = ?, securitycode = ?, type = ? WHERE id = ?";
       $q = $pdo->prepare($sql);
       $q->execute(array($name,$number,$expiration,$securitycode,$type,$id));


         Database::disconnect();

       header("Location: update.php");


    }
