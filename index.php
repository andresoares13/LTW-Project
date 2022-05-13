<?php
  declare(strict_types = 1);

  session_start();

  require_once('database/connection.php');
  require_once('database/restaurant.class.php');

  require_once('templates/common.php');
  require_once('templates/restaurants.php');

  $db = getDatabaseConnection();

  $restaurants = Restaurant::getRestaurants($db, 3);
  
  
  drawHeader();
  drawRestaurants($restaurants);
  drawFooter();
?>