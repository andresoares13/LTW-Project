<?php
  declare(strict_types = 1);

  session_start();

  if (!isset($_SESSION['id'])) die(header('Location: /'));
  if ($_SESSION['usertype']!='Customer'){
    die(header('Location: /'));
  }

  require_once('../database/connection.php');
  require_once('../database/menu_item.class.php');

  require_once('../templates/common.php');
  require_once('../templates/carts.php');


  $db = getDatabaseConnection();

  $itemsByMenu=Menu_Item::getItemsByMenu($db,(int)$_GET['id']);
  
  
  drawHeader();
  drawCart($itemsByMenu);
  drawFooter();
?>