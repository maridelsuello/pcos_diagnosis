<?php
   session_start();
   if(!isset($_SESSION['id']) || trim($_SESSION['id']) == ''){
      header("Location:login.php");
      exit();
   }
?>