<?php
  declare(strict_types = 1);

  session_start();

  if (!isset($_SESSION['id'])) die(header('Location: /'));

  require_once('../database/connection.php');

  require_once('../database/restaurant.class.php');
  require_once('../database/menu.class.php');
  require_once('../database/menu_item.class.php');

  require_once('../templates/common.php');
  require_once('../templates/menus.php');

  $db = getDatabaseConnection();
  $menu = Menu::getMenu($db, intval($_GET['id']));
  $restaurant = Restaurant::getRestaurant($db, $menu->restaurant);
  $menu_items = Menu_Item::getMenuItems($db, intval($_GET['id']));

  
  drawHeader();
  if ($_GET['id2']=='edit'&&Restaurant::isOwnerOfRestaurant($db,$restaurant->id,$_SESSION['id'])){
    drawMenuInfoForm($restaurant);
  }
  else if($_GET['id2']=='edit2'&&Restaurant::isOwnerOfRestaurant($db,$restaurant->id,$_SESSION['id'])){
    drawNewMenuItemForm($menu);
  }
  else if($_GET['id2']=='photo'&&Restaurant::isOwnerOfRestaurant($db,$restaurant->id,$_SESSION['id'])){
    $menu_item = Menu_Item::getMenuItem($db,intval($_GET['id3']));
    $_SESSION['iteminfo']['Photo']=$menu_item->photo;
    drawPictureForm($menu_item);
  }
  else{
    if (Restaurant::isOwnerOfRestaurant($db,$restaurant->id,$_SESSION['id'])){
      drawMenuOwner($menu,$restaurant,$menu_items);
    }
    else{
      drawMenu($menu,$restaurant,$menu_items);
    }
  }
  drawFooter();
?>