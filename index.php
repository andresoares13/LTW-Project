<?php
  declare(strict_types = 1);

  require_once('templates/common.php');
  require_once('templates/restaurants.php');

  $restaurants = array(
    array('id' => 1, 'name' => 'Taskinha'),
    array('id' => 2, 'name' => 'Viriato')
  );

  drawHeader();
  drawRestaurants($restaurants);
  drawFooter();
?>