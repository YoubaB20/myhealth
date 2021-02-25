<?php
  session_start();
 
  $_SESSION = array();
  session_destroy();
  include('con_db.php');
 
  header('location: ../index.php');
  $bdd->close();
?>