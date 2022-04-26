<?php
  declare(strict_types = 1);

  require_once('templates/common.php');
  require_once('templates/menus.php');

  $dishes = array(
    array('id' => 1, 'title' => 'Dish 1', 'type' => 'protein'),
    array('id' => 2, 'title' => 'Dish 2', 'type' => 'carbs'),
    array('id' => 3, 'title' => 'Dish 3', 'type' => 'fats'),
    array('id' => 4, 'title' => 'Dish 4', 'type' => 'protein')
  );

  drawHeader();
  drawMenu(1, 'Restaurant Name', 1, 'Menu Name', $dishes);
  drawFooter();
?>