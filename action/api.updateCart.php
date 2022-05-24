<?php
  declare(strict_types = 1);

  session_start();

  if (!isset($_SESSION['id'])) die(header('Location: /'));

  if ($_SESSION['cart'][$_POST['id']]){
      $_SESSION['cart'][$_POST['id']]['quantity']=(int)$_SESSION['cart'][$_POST['id']]['quantity'] + (int)$_POST['quantity'];
  }
  else{
      $_SESSION['cart'][$_POST['id']]['quantity']=(int)$_POST['quantity'];
      $_SESSION['cart'][$_POST['id']]['price']=(int)$_POST['price'];

  }
  

  header("Location:".$_SERVER['HTTP_REFERER']."");

    
?>
