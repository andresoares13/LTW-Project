<?php
  declare(strict_types = 1);

  require_once('database/connection.php');
  require_once('database/restaurant.db.php');

  require_once('templates/common.php');
  require_once('templates/restaurants.php');

  $db = getDatabaseConnection();

  $restaurant = getRestaurant($db, intval($_GET['id']));
  

  drawHeader();
  drawRestaurant($restaurant['name'], $restaurant['menus']);
  drawFooter();
?>