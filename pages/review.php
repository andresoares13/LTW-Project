<?php
  declare(strict_types = 1);

  session_start();
  
  if (!isset($_SESSION['id'])) die(header('Location: /'));

  require_once('../database/connection.php');

  require_once('../database/review.class.php');
  require_once('../database/restaurant.class.php');

  require_once('../templates/common.php');
  require_once('../templates/reviews.php');


  $db = getDatabaseConnection();

  $restaurant = Restaurant::getRestaurant($db, intval($_GET['id']));
  $reviews = Review::getRestaurantReviews($db,$restaurant->id);
  
  

  drawHeader();
  if (Restaurant::isOwnerOfRestaurant($db,(int)$_GET['id'],$_SESSION['id'])&&$_GET['id2']=="answer"){
    $review=Review::getReview($db,(int) $_GET['id3']);
    drawReplyForm($review,$restaurant);
  }
  else if (Restaurant::isOwnerOfRestaurant($db,(int)$_GET['id'],$_SESSION['id'])){
    drawOwnerReviews($reviews,$restaurant);
  }
  else{
    if ($_GET['id2']=="review"){
      drawReviewForm($restaurant);
    }
    else{
      drawReviews($reviews,$restaurant);
    }
  }
  drawFooter();
?>