<?php
  declare(strict_types = 1);

  require_once('database/connection.php');
  require_once('database/restaurant.db.php');
  require_once('database/menu.db.php');

  require_once('templates/common.php');
  require_once('templates/menus.php');

  $db = getDatabaseConnection();
  $menu = getMenu($db, intval($_GET['id']));
  $restaurant = getRestaurant($db, $menu['restaurant']);
  

  drawHeader();
  drawMenu($menu['id'],$menu['name'],$restaurant['id'],$restaurant['name'], $menu['dishes'] );
  drawFooter();
?>