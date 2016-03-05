<?php
 error_reporting(E_ALL);
    require_once 'database.php';
 
    if ( !empty($_POST)) {
      // keep track post values
      $id = $_POST['id'];
      $username = $_POST['username'];
      $email = $_POST['email'];
      $password = $_POST['password'];
         
      function valid($varname){
        return ( !empty($varname) && isset($varname) );
      }
      if (!valid($username) || !valid($email) || !valid($password)) {
        header("Location: update.php");
      } else if (!valid($email)) {
        header("Location: update.php");
      } else if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {
        header("Location: update.php");
      }
      $pdo = Database::connect();
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "UPDATE users SET username = ?, email = ?, password = ? WHERE id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($username,$email,$password,$id));
      Database::disconnect();
      header("Location: update.php");
    }
