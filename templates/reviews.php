<?php function drawReviews(array $reviews, Restaurant $restaurant) { ?>
  <h2>Reviews:</h2>
  <h3>Restaurant: <a href="../pages/restaurant.php?id=<?=$restaurant->id?>"><?=$restaurant->name?></a></h3>      
  <table id="menus">
    <tr><th scope="col">#</th><th scope="col">Customer</th><th scope="col">Rating</th><th scope="col">Comment</th></tr>
    <?php foreach ($reviews as $i => $review) { ?>
      <tr><td><?=$i+1?></td><td><?=$review->customer?></td><td><?=$review->rating?></td><td><?=$review->comment?></td></tr>
    <?php } ?>
  </table>
<?php } ?>

<?php function drawOwnerReviews(array $reviews, Restaurant $restaurant) { ?>
  <h2>Reviews:</h2>
  <h3>Restaurant: <a href="../pages/restaurant.php?id=<?=$restaurant->id?>"><?=$restaurant->name?></a></h3>      
  <table id="menus">
    <tr><th scope="col">#</th><th scope="col">Customer</th><th scope="col">Rating</th><th scope="col">Comment</th></tr>
    <?php foreach ($reviews as $i => $review) { ?>
      <tr><td><?=$i+1?></td><td><?=$review->customer?></td><td><?=$review->rating?></td><td><?=$review->comment?></td>
      <td><a href="../pages/review.php?id=<?=$restaurant->id?>&id2=answer&id3=<?=$review->id?>">Reply</a></td></tr>
    <?php } ?>
  </table>
<?php } ?>


