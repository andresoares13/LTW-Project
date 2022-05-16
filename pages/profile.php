<?php
  declare(strict_types = 1);

  session_start();

  if (!isset($_SESSION['id'])) die(header('Location: /'));

  require_once('../database/connection.php');
  require_once('../database/user.class.php');
  require_once('../database/restaurant.class.php');

  require_once('../templates/common.php');
  require_once('../templates/users.php');
  require_once('../templates/restaurants.php');

  $db = getDatabaseConnection();
  
  $user = User::getUser($db, $_SESSION['id']);

  drawHeader();
  if($_GET['id']=='account'){
    drawAccountInfoForm();
  }
  else if ($_GET['id']=='profile'){
    drawProfileInfoForm($user);
  }
  else if ($_GET['id']=='owner'&&$_SESSION['usertype']=='Restaurant Owner'){
    $restaurants = Restaurant::getRestaurantsWithOwner($db, $_SESSION['id']);
    if($restaurants!=null){
      drawRestaurants($restaurants);
    }
    else{
      
      drawOwnerNoRestaurants();
    }
  }
  else{
    if ($_SESSION['usertype']=='Restaurant Owner'){
      drawProfileOwner($user);
    }
    else{
      drawProfileCustomer($user);
    }
  }
  drawFooter();
?>