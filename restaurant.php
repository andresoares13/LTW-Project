<?php
  declare(strict_types = 1);

  session_start();

  require_once('database/connection.php');

  require_once('database/restaurant.class.php');
  require_once('database/menu.class.php');

  require_once('templates/common.php');
  require_once('templates/restaurants.php');

  $db = getDatabaseConnection();

  $restaurant = Restaurant::getRestaurant($db, intval($_GET['id']));
  $menus = Menu::getRestaurantMenus($db, intval($_GET['id'])); 

  drawHeader();
  drawRestaurant($restaurant, $menus);
  drawFooter();
?>