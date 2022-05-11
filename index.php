<?php
  declare(strict_types = 1);

  require_once('database/connection.php');
  require_once('database/restaurant.db.php');

  require_once('templates/common.php');
  require_once('templates/restaurants.php');

  $db = getDatabaseConnection();

  $restaurants = getRestaurants($db, 3);
  

  drawHeader();
  drawRestaurants($restaurants);
  drawFooter();
?>