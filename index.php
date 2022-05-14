<?php
  
  if(!isset($_SESSION['username'])){
    header("Location:pages/login.php");
  } else {
  	header("Location:pages/main.php");
  }
?>