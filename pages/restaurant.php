<?php
  declare(strict_types = 1);

  session_start();
  
  if (!isset($_SESSION['id'])) die(header('Location: /'));

  require_once('../database/connection.php');

  require_once('../database/restaurant.class.php');
  require_once('../database/menu.class.php');

  require_once('../templates/common.php');
  require_once('../templates/restaurants.php');

  $db = getDatabaseConnection();

  $restaurant = Restaurant::getRestaurant($db, intval($_GET['id']));
  $menus = Menu::getRestaurantMenus($db, intval($_GET['id'])); 

  drawHeader();
  if ($_GET['id2']=='edit'&&Restaurant::isOwnerOfRestaurant($db,(int)$_GET['id'],$_SESSION['id'])){
    drawRestaurantInfoForm($restaurant);
  }
  else{
    if (Restaurant::isOwnerOfRestaurant($db,(int)$_GET['id'],$_SESSION['id'])){
      drawRestaurantOwner($restaurant,$menus);
    }
    else{
      drawRestaurant($restaurant, $menus);
    }
  }
  drawFooter();
?>