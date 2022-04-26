<?php
  declare(strict_types = 1);

  require_once('templates/common.php');
  require_once('templates/restaurants.php');

  $menus = array(
    array('id' => 1, 'name' => 'Menu 1', 'category' => 'carne'),
    array('id' => 2, 'name' => 'Menu 2', 'category' => 'peixe'),
    array('id' => 3, 'name' => 'Menu 3', 'category' => 'pizza'),
    array('id' => 4, 'name' => 'Menu 4', 'category' => 'sushi')
  );

  drawHeader();
  drawRestaurant('Menu name', $menus);
  drawFooter();
?>