<?php
  include 'session.php';  
  include 'connection.php';

    if(isset($_GET['id']) && !empty($_GET['id'])){
      $id = intval($_GET['id']);

      $sql = "DELETE FROM dataset_features WHERE id = $id";

      if ($dbhandle->query($sql) === TRUE) {
          echo "<script> alert('Record deleted successfully'); window.location='features.php';</script>";
        } else {
          echo "<script> alert('Error deleting user'); window.location='features.php';</script>";
        }
    }else {
      echo "<script>alert('Invalid Request!'); window.location='features.php';</script>";
    }
?>
