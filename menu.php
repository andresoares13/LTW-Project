<?php
  declare(strict_types = 1);

  require_once('database/connection.php');

  require_once('database/restaurant.class.php');
  require_once('database/menu.class.php');
  require_once('database/menu_item.class.php');

  require_once('templates/common.php');
  require_once('templates/menus.php');

  $db = getDatabaseConnection();
  $menu = Menu::getMenu($db, intval($_GET['id']));
  $restaurant = Restaurant::getRestaurant($db, $menu->restaurant);
  $menu_items = Menu_Item::getMenuItems($db, intval($_GET['id']));
  
  drawHeader();
  drawMenu($menu,$restaurant,$menu_items);
  drawFooter();
?>