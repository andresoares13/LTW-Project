<?php function drawReviews(array $reviews, Restaurant $restaurant) { ?>
  <h2>Reviews:</h2>
  <h3>Restaurant: <a href="../pages/restaurant.php?id=<?=$restaurant->id?>"><?=$restaurant->name?></a></h3>
  <p><a href="../pages/review.php?id=<?=$restaurant->id?>&id2=review">Review this restaurant</a> <br> <br></p>      
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


<?php function drawReviewForm(Restaurant $restaurant) { ?>
  <h2>Review this restaurant: <?=$restaurant->name?></h2>
  <form action="../action/action_add_review.php" method="post" class="review">

  <label class="rating">
  <label>
    <input type="radio" name="stars" value="1" />
    <span class="icon">★</span>
  </label>
  <label>
    <input type="radio" name="stars" value="2" />
    <span class="icon">★</span>
    <span class="icon">★</span>
  </label>
  <label>
    <input type="radio" name="stars" value="3" />
    <span class="icon">★</span>
    <span class="icon">★</span>
    <span class="icon">★</span>   
  </label>
  <label>
    <input type="radio" name="stars" value="4" />
    <span class="icon">★</span>
    <span class="icon">★</span>
    <span class="icon">★</span>
    <span class="icon">★</span>
  </label>
  <label>
    <input type="radio" name="stars" value="5" />
    <span class="icon">★</span>
    <span class="icon">★</span>
    <span class="icon">★</span>
    <span class="icon">★</span>
    <span class="icon">★</span>
  </label>
  </label>  

  <textarea type="text" class="input" placeholder="Write a comment" v-model="newItem" name="comment"></textarea>
  
    <input id="id" type="hidden" name="id" value="<?=$restaurant->id?>" required="required">

    <button type="submit">Post</button>

    <p id="error_messages" style="color: black">
      <?php if(isset($_SESSION['ERROR'])) echo htmlentities($_SESSION['ERROR']); unset($_SESSION['ERROR'])?>
    </p>
  </form>
<?php } ?>


